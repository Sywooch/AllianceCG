<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\LoginForm */

$this->title = Module::t('module', 'TITLE_LOGIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">

    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">

            <h1><?= Html::encode($this->title) ?></h1>

            
            <p><?= Module::t('module', 'PLEASE_FILL_FOR_LOGIN') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'username' )]) ?>
            <?php
            // $form->field($model, 'username')
            ?>
            <?= $form->field($model, 'password', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'password' )]) ?>
            <?php
            // $form->field($model, 'password')->passwordInput() 
            ?>
            
            <div class="alert alert-danger">
                <?= Module::t('module', 'LOGIN_INFO') ?>
            </div>            
            
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0;text-align: right;">
                <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'LINK_PASSWORD_RESET'), ['password-reset-request']) ?>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <?= Html::submitButton('<span class="glyphicon glyphicon-play-circle"></span>  ' . Module::t('module', 'USER_BUTTON_LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>