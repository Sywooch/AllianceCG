<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Bodytypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bodytypes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'body_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_type', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-diamond"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'body_type' )]) ?>

    <?php // echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-file-text"></i> </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>


    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
