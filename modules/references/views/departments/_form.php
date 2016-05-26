<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form center-block">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'department_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('users') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'department_name' )]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('floppy-o')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>

        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
