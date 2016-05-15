<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\PasswordResetForm */

$this->registerCssFile('@web/css/landing_login.css', ['depends' => ['app\assets\AppAsset']]);  

$this->title = Module::t('module', 'TITLE_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-password-reset pwdRst-form">

    <div class="row">
        <div class="col-lg-5  col-lg-offset-3">

            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= Module::t('module', 'PLEASE_FILL_FOR_RESET') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'password-reset-form']); ?>
            <?= $form->field($model, 'password', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('briefcase') .'</span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'password' )]) ?>
            <div class="form-group" style="text-align: right">
                <?= Html::submitButton(FA::icon('send') . Module::t('module', 'PASSWORD_RESET_SAVE'), ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>