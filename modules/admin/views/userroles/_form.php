<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Userroles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userroles-form" style="width: 70%; margin: auto;"><div class="creditcalendar-form" style="width: 70%; margin: auto;">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('bookmark') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('role')]) ?>


    <?php // echo $form->field($model, 'role_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'role_description', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('file-text') . ' </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('role_description')]) ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <?php // echo $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>