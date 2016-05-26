<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\ContactType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'contact_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_type', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('users') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'contact_type' )]) ?>

    <?php //echo $form->field($model, 'state')->textInput() ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div class="form-group buttonpane">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} Create', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} Update', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary ']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
