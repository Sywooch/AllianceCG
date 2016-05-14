<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Bodytypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bodytypes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'body_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_type', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('diamond') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'body_type' )]) ?>

    <?php // echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('file-text') . ' </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>


    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
