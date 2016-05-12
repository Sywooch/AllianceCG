<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'brand_logo')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput(); ?>

    <?php 
    	if(isset($model->brand_logo) && !empty($model->brand_logo) && file_exists($model->brand_logo)) {
    		echo Html::img('@web/'.$model->brand_logo,["width"=>"50"]);
    		echo "<br/>";
    	}
    ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton($model->isNewRecord ? Module::t('module', 'CREATE') : Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
