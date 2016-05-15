<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\PasswordResetRequestForm */

$this->registerCssFile('@web/css/landing_login.css', ['depends' => ['app\assets\AppAsset']]);  

$this->title = Module::t('module', 'TITLE_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-password-reset-request passwordReset-form">

    <div class="row">
        <div class="col-lg-5  col-lg-offset-3">
        <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'password-reset-request-form']); ?>

            <p><?= Module::t('module', 'PLEASE_FILL_FOR_RESET_REQUEST') ?></p>

            <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('envelope') .'</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>
            <div class="form-group" style="text-align: right">
                <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'GO_BACK'), ['login'], ['class' => 'btn-resetpwd']) ?>
                <?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
                <?= Html::submitButton(FA::icon('send') . ' ' . Module::t('module', 'BUTTON_SEND'), ['class' => 'btn btn-primary btn-passwdReset', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>