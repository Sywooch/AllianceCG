<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-asterisk"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'region_name' )]) ?>


    <?= $form->field($model, 'region_code', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-home"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'region_code' )]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm animlinkColor' : 'btn btn-primary btn-sm animlinkColor']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger btn-sm animlinkColor']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
