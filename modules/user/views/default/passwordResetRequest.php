<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\PasswordResetRequestForm */

$this->registerCssFile('@web/css/landing_login.css', ['depends' => ['app\assets\AppAsset']]);  

$this->title = Yii::t('app', '{icon} TITLE_PASSWORD_RESET', ['icon' => FA::icon('refresh')]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-password-reset-request passwordReset-form">

    <div class="row">
        <div class="col-lg-6  col-lg-offset-2">
        <h1><?= $this->title ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'password-reset-request-form']); ?>

            <p><?= Yii::t('app', '{icon} PLEASE_FILL_FOR_RESET_REQUEST', ['icon' => FA::icon('send')]) ?></p>

            <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('envelope') .'</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>
            <div class="form-group" style="text-align: right">
                <?= Html::a(Yii::t('app', '{icon} GO_BACK', ['icon' => FA::icon('refresh')]), ['login'], ['class' => 'btn-resetpwd']) ?>
                <?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
                <?= Html::submitButton(Yii::t('app', '{icon} BUTTON_SEND', ['icon' => FA::icon('send')]), ['class' => 'btn btn-primary btn-passwdReset', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>