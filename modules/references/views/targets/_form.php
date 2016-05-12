<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\references\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Targets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="targets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('diamond') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'target' )]) ?>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ?  FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
