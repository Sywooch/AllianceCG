<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\references\models\ContactType;
use app\modules\references\models\Targets;
use app\modules\references\models\Employees;
use app\modules\references\models\Regions;
use app\modules\references\models\Models;
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/16
 * Time: 11:06 PM
 */
    // echo $model->getBrands();
?>

<div class="panel panel-default">
<div class="panel-body">

<?php 
	$form = ActiveForm::begin([
			'method' => 'post',
		]); 
?>

    <?= $form->errorSummary($commentModel); ?>

    <?php
        $contacttypes = ContactType::find()->where(['<>', 'state', ContactType::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($contacttypes,'id','contact_type');
        $params = [
            // 'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $commentModel->getAttributeLabel( 'contact_type' ) . ' --',
        ];
        echo $form->field($commentModel, 'contact_type', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-map"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    


    <?php
        $targets = Targets::find()->where(['<>', 'state', Targets::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($targets,'id','target');
        $params = [
            'prompt' => '-- ' . $commentModel->getAttributeLabel( 'target' ) . ' --',
        ];
        echo $form->field($commentModel, 'target', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-diamond"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     

    <?php
        if (!empty($model->getBrands()))
        {
            // echo $model->getBrands();
            $cars = Models::find()
                ->where(['<>', 'state', Models::STATUS_BLOCKED])
                ->andWhere(['brand_id' => Yii::$app->user->identity->userbrand])
                ->all();
        
            $items = ArrayHelper::map($cars,'id','fullmodelname');
            $params = [
                'prompt' => '-- ' . $commentModel->getAttributeLabel( 'car_model' ) . ' --',
            ];
            echo $form->field($commentModel, 'car_model', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-car"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);            
        }
        else 
        {
            echo $form->field($commentModel, 'car_model', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-car"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $commentModel->getAttributeLabel('car_model')]);    
        }
    ?> 

    
    <?= $form->field($commentModel, 'comment', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-users"></i> </span>{input}</div>{error}'])->textArea(['maxlength' => true, 'placeholder' => $commentModel->getAttributeLabel('comment')]) ?>

    <?php
        $sales = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and {{%employees}}.company_id = '".Yii::$app->user->identity->usercompany."' and ({{%positions}}.position = '".Employees::SALES_MANAGER."' or {{%positions}}.position = '".Employees::HEAD_OF_SALES_DEPARTMENT."')")
            ->all();

        $salesAdmin = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and ({{%positions}}.position = '".Employees::SALES_MANAGER."' or {{%positions}}.position = '".Employees::HEAD_OF_SALES_DEPARTMENT."')")
            ->all();            

        $salesResult = Yii::$app->user->can('admin') ? $salesAdmin : $sales;

        $items = ArrayHelper::map($salesResult,'id','fullName');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $commentModel->getAttributeLabel( 'sales_manager_id' ) . ' --',
        ];
        echo $form->field($commentModel, 'sales_manager_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-briefcase"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    


    <?php
        $credit = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and {{%employees}}.company_id = '".Yii::$app->user->identity->usercompany."' and ({{%positions}}.position = '".Employees::CREDIT_MANAGER."' or {{%positions}}.position = '".Employees::INSURANCE_MANAGER."')")
            ->all();

        $creditAdmin = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and ({{%positions}}.position = '".Employees::CREDIT_MANAGER."' or {{%positions}}.position = '".Employees::INSURANCE_MANAGER."')")
            ->all();            

        $creditResult = Yii::$app->user->can('admin') ? $creditAdmin : $credit;

        $items = ArrayHelper::map($creditResult,'id','fullName');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $commentModel->getAttributeLabel( 'credit_manager_id' ) . ' --',
        ];
        echo $form->field($commentModel, 'credit_manager_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-briefcase"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>        

</div> <!-- panelBody End -->

<div class="panel-footer">

    <div class="form-group buttonpane">
        <?= Html::submitButton(Yii::t('app', '{icon} ADD_EVENT', ['icon' => '<i class="fa fa-comment"></i>']), ['class' => 'btn btn-success btn-sm']) ?>
    </div> <!-- buttonpane End -->

</div> <!-- panelFooter End -->

<?php ActiveForm::end(); ?>

</div> <!-- panel End -->