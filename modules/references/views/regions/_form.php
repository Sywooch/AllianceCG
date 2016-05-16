<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
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
        <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
