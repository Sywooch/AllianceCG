<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\modules\main\models\ContactForm;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
    use app\modules\skoda\Module;
?>
<!--Yii::$app->name--> 
<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <b>
                <!--&copy;--> 
            <?= Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36']) ?>
            <b>
            <?= 'СтрелаАвто' ?> 
        </b></p>

        <!--<p class="pull-right">-->
            <?php
//                echo Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36'])
            ?>
            <!--<b>-->
            <?php
//                echo Yii::$app->name 
            ?> 
        <!--</b></p>-->

<div class="pull-right">
    <?php $model = new ContactForm(); ?>

    <?php
        $form = ActiveForm::begin([
                'method' => 'post',
                'action' => Url::to(['//main/contact/index']),
        ]);
    ?>

<div class="col-lg-3" style="width: 50%;">
    <?= $form->field($model, 'name', ['template' => "{input}\n{hint}\n{error}"])->textInput(['placeholder' => $model->getAttributeLabel('name')]);  ?>
</div>

<div class="col-lg-3" style="width: 50%;">
    <?= $form->field($model, 'email', ['template' => "{input}\n{hint}\n{error}"])->textInput(['placeholder' => $model->getAttributeLabel('email')]);  ?>
</div>
<div class="col-lg-3" style="width: 100%;">
    <?php echo $form->field($model, 'subject')->textInput(['maxlength' => 255, 'id' => 'contact_form', 'placeholder' => $model->getAttributeLabel('subject')])->label(false) ?>
    <?= $form->field($model, 'body')->textArea(['rows' => 3, 'placeholder' => $model->getAttributeLabel('body')])->label(false) ?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'captchaAction' => '/main/contact/captcha',
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>                    
    <div class="form-group" style="float: right">
        <?= Html::submitButton(Module::t('module', 'BUTTON_SEND'), ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
    </div>    
    <?php ActiveForm::end(); ?>
</div>                
    </div>
</footer>