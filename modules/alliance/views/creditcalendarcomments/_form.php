<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarComments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditcalendar-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creditcalendar_id')->textInput() ?>

    <?= $form->field($model, 'comment_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
