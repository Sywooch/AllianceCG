<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'TITLE_CONTACT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-5 col-lg-offset-3">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                
                <h1><?= Html::encode($this->title) ?></h1>

                    <p><?= Yii::t('app', 'CONTACT_INFO'); ?></p>

                    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>
                    
                    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

                    <?= $form->field($model, 'subject', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'subject' )]) ?>

                    <?= $form->field($model, 'body', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>{input}</div>{error}'])->textArea(['placeholder' => $model->getAttributeLabel( 'body' ), 'rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'captchaAction' => '/main/contact/captcha',
                        'options' => [
                            'class' => 'form-control input-lg',
                            'placeholder' => $model->getAttributeLabel( 'verifyCode' ),
                            'label' => false,
                        ],                        
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6"> <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-warning-sign"></span></span>{input}</div></div></div>',
                    ]) ?>
                    
                    <div class="form-group" style="text-align: right">
                        <?= Html::submitButton('<span class="glyphicon glyphicon-envelope"></span>  ' . Yii::t('app', 'BUTTON_SUBMIT'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
