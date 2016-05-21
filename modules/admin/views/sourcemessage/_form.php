<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput(['readonly' => !$model->isNewRecord, 'maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['readonly' => !$model->isNewRecord, 'rows' => 6]) ?>

    <?= $form->field($model, 'language')->textInput(['readonly' => !$model->isNewRecord, 'maxlength' => true]) ?>

    <?= $form->field($model, 'translation')->textarea(['rows' => 6]) ?>

    <div class="form-group buttonpane">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} Create', ['icon' => FA::icon('plus')]) : Yii::t('app', '{icon} Update', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
