<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use rmrevin\yii\fontawesome\FA;

$this->title = Yii::t('app', 'TITLE_CONTACT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            <?= Yii::t('app', 'CONTACT_THANKS') ?>
        </div>

    <?php // endif; ?>

    <?php else: ?>

        <div class="row">
            <!-- <div class="col-lg-6 col-lg-offset-3"> -->

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <div class="alert alert-info">

                    <p><?= Yii::t('app', 'CONTACT_INFO'); ?></p>

                </div>

                    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>
                    
                    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

                    <?= $form->field($model, 'subject', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'subject' )]) ?>

                    <?= $form->field($model, 'body', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>{input}</div>{error}'])->textArea(['placeholder' => $model->getAttributeLabel( 'body' ), 'rows' => 6]) ?>

                <!-- <div class="col-md-8"> -->
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'captchaAction' => '/main/contact/captcha',
                        'options' => [
                            'class' => 'form-control input-lg',
                            'placeholder' => $model->getAttributeLabel( 'verifyCode' ),
                            'label' => false,
                        ],                        

                        // 'template' => 
                        //     '<div class="row">
                        //         <div class="col-lg-">{image}</div>
                        //         <div class="col-lg-6">{input}</div>
                        //     </div>',
                        // 'template' => '<div class="row" style="text-align: left"><div class="col-lg-3">{image}</div><div class="col-lg-5"> <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-warning-sign"></span></span>{input}</div></div></div>',
                    ]) ?>
                <!-- </div> -->

                <!-- <div class="col-md-4"> -->
                    <div class="form-group" style="text-align: right">
                        <?= Html::submitButton(Yii::t('app', '{icon} BUTTON_SUBMIT', ['icon' => FA::icon('mail-reply-all')]), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>                    
                <!-- </div> -->
                    

                <?php ActiveForm::end(); ?>

            <!-- </div> -->
        </div>

    <?php endif; ?>
</div>
