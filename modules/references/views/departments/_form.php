<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form center-block">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'department_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-users"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'department_name' )]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success animlinkColor' : 'btn btn-primary animlinkColor']) ?>

        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger  animlinkColor btn-sm']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
