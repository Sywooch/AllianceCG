<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput(); ?>

    <?php 
    	if(isset($model->brand_logo) && !empty($model->brand_logo) && file_exists($model->brand_logo)) {
    		echo Html::img('@web/'.$model->brand_logo,["width"=>"50"]);
    		echo "<br/><br/>";
    	}
    ?>

    <?php // echo $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'brand' )]) ?>

    <?php // $form->field($model, 'brand_logo')->textInput() ?>


    <?php // echo $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('file-text') . ' </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
