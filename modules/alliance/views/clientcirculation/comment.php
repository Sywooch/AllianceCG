<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use app\modules\references\models\ContactType;
use app\modules\references\models\Targets;
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/16
 * Time: 11:06 PM
 */

?>


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
        echo $form->field($commentModel, 'contact_type', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('map') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    

    <?php
        $targets = Targets::find()->where(['<>', 'state', Targets::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($targets,'id','target');
        $params = [
            'prompt' => '-- ' . $commentModel->getAttributeLabel( 'target' ) . ' --',
        ];
        echo $form->field($commentModel, 'target', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('diamond') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>          

    <?= $form->field($commentModel, 'car_model', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $commentModel->getAttributeLabel('car_model')]) ?>    
    
    <?= $form->field($commentModel, 'comment', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('users') . ' </span>{input}</div>{error}'])->textArea(['maxlength' => true, 'placeholder' => $commentModel->getAttributeLabel('comment')]) ?>


    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(Yii::t('app', '{icon} ADD_EVENT', ['icon' => FA::icon('addevent')]), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

<?php ActiveForm::end(); ?>
