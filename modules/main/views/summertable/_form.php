<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\Summertable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="summertable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}{error}'.'</div>',
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_color', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}{error}'.'</div>',
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}{error}'.'</div>',
        ])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'discount_percent', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-percent"></i></span>{input}{error}'.'</div>',
        ])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'price', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}{error}'.'</div>',
        ])->textInput(['type' => 'number']) ?>
    
    <?= $form->field($model, 'price_discount', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}{error}'.'</div>',
        ])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'payment', [
            'template' => '{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}{error}'.'</div>',
        ])->textInput(['type' => 'number']) ?>

    <div class="form-group buttonpane">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-plus"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger bnt-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
