<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\SignupForm */

$this->title = Yii::t('app', 'TITLE_SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <p><?= Yii::t('app', 'PLEASE_FILL_FOR_SIGNUP') ?></p>
            
            <?= $form->field($model, 'username', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'username' )]) ?>

            <?php
            // $form->field($model, 'username')
            ?>

            <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

            <?php
            // $form->field($model, 'email')
            ?>

            <?= $form->field($model, 'password', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'password' )]) ?>

            <?php
            // $form->field($model, 'password')->passwordInput()
            ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/user/default/captcha',
                'options' => [
                    'class' => 'form-control input-lg',
                    'placeholder' => $model->getAttributeLabel( 'verifyCode' ),
                    'label' => false,
                ],  
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6"> <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-warning-sign"></span></span>{input}</div></div></div>',
            ]) ?>
            <div class="form-group" style="text-align: right">
                <?= Html::submitButton('<span class="glyphicon glyphicon-send"></span>  ' . Yii::t('app', 'BUTTON_SUBMIT'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>