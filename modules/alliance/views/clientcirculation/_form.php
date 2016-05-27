<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use app\modules\alliance\Module;
use app\modules\references\models\Regions;
use app\modules\references\models\Employees;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-circulation-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('users') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?php // echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('phone') . ' </span>{input}</div>{error}'])->widget(MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99',
    ]) ?>

    <?= $form->field($model, 'email', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('inbox') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

    <?php // echo $form->field($model, 'region_id')->textInput() ?>


    <?php
        $regions = Regions::find()->where(['<>', 'state', Regions::STATUS_BLOCKED])->all();
        // $regions = Regions::find()->all();
    
        $items = ArrayHelper::map($regions,'id','region_name');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'region_id' ) . ' --',
        ];
        echo $form->field($model, 'region_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('map') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 


    <?php
        // $employees = Employees::find()
        //     ->joinWith(['position'])
        //     ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and {{%employees}}.company_id = '".Yii::$app->user->identity->usercompany."' and ({{%positions}}.position = '".Employees::SALES_MANAGER."' or {{%positions}}.position = '".Employees::HEAD_OF_SALES_DEPARTMENT."')")
        //     ->all();
    
        $employees = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and {{%employees}}.company_id = '".Yii::$app->user->identity->usercompany."' and ({{%positions}}.position = '".Employees::SALES_MANAGER."' or {{%positions}}.position = '".Employees::HEAD_OF_SALES_DEPARTMENT."')")
            ->all();

        $employeesAdmin = Employees::find()
            ->joinWith(['position'])
            ->where("{{%employees}}.state = ".Employees::STATUS_ACTIVE." and ({{%positions}}.position = '".Employees::SALES_MANAGER."' or {{%positions}}.position = '".Employees::HEAD_OF_SALES_DEPARTMENT."')")
            ->all();            

        $employeesResult = Yii::$app->user->can('admin') ? $employeesAdmin : $employees;

        $items = ArrayHelper::map($employeesResult,'id','fullName');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'employee_id' ) . ' --',
        ];
        echo $form->field($model, 'employee_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     


    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-sm btn-danger'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
