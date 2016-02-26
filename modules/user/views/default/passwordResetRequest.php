<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\PasswordResetRequestForm */

$this->title = Yii::t('app', 'TITLE_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-password-reset-request">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5  col-lg-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'password-reset-request-form']); ?>

            <p><?= Yii::t('app', 'PLEASE_FILL_FOR_RESET_REQUEST') ?></p>

            <?php
            // $form->field($model, 'email')
            ?>
            <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) . '</div>' ?>
            <div class="form-group" style="text-align: right">
                <?= Html::submitButton('<span class="glyphicon glyphicon-send"></span>  ' . Yii::t('app', 'BUTTON_SEND'), ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>