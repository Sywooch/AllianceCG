<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'region_name')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'region_code')->textInput() ?>


    <?= $form->field($model, 'region_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('asterisk') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'region_name' )]) ?>


    <?= $form->field($model, 'region_code', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('home') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'region_code' )]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
