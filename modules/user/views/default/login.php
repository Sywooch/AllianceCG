<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\LoginForm */

$this->title = Module::t('module', 'TITLE_LOGIN');
$this->params['breadcrumbs'][] = $this->title;

   $this->registerCssFile('@web/css/landing_login.css', ['depends' => ['app\assets\AppAsset']]);  

   // $this->registerCssFile('@web/css/counters.css', ['depends' => ['app\assets\AppAsset']]);    
   // $this->registerCssFile('@web/css/animations/slideDown.css', ['depends' => ['app\assets\AppAsset']]);
   // $this->registerJsFile(Yii::getAlias('@web/js/modules/main/default/counters.js'), ['depends' => [
   //     'yii\web\YiiAsset',
   //     'yii\bootstrap\BootstrapAsset'],
   // ]);      
     
    // $this->registerJsFile(Yii::getAlias('@web/js/modules/main/login/placeholder.js'), ['depends' => [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset'],
    // ]); 

?>
    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->

<div class="user-default-login">

    <div class="row">
        <!-- <div class="col-lg-5 col-lg-offset-3" id="slick-login"> -->
        <div class="col-md-9">

<!--             <div class="counters" id="counters">    
                <div class="counterscontainer" id="counterscontainer">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4" id="centerFA">
                                <?= FA::icon('pencil')->size(FA::SIZE_5X) ?>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <?= FA::icon('clock-o')->size(FA::SIZE_5X) ?>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <?= FA::icon('coffee')->size(FA::SIZE_5X) ?>                    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="codeStringsCounter"></div>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <div id="dateCounter"></div>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <div id="coffeeCounter"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="codeStringsText"></div>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <div id="dateText"></div>
                            </div>
                            <div class="col-md-4" id="centerFA">
                                <div id="coffeeText"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>

        <div class="col-md-3 login-form">
            <h1><?= Html::encode($this->title) ?></h1>
            
            <!-- <p> -->
                <?php// Module::t('module', 'PLEASE_FILL_FOR_LOGIN') ?>
            <!-- </p> -->

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('user') . '</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'username' )]) ?>

            <?= $form->field($model, 'password', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('briefcase') . '</span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'password' )]) ?>
            
            <?php Module::t('module', 'LOGIN_INFO') ?>
            
                <div class="col-md-4 rememberCheckbox" style="text-align: left">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
            <div class="login-buttons">
                <div class="col-md-5 passwordReset" style="padding-top: 8px;">
                    <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'LINK_PASSWORD_RESET'), ['password-reset-request'], ['class' => 'btn-resetpwd']) ?>
                </div>
                <div class="col-md-3">
                    <?= Html::submitButton(FA::icon('sign-in') . ' ' . Module::t('module', 'USER_BUTTON_LOGIN'), ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
                </div>
            </div>



            
            <div style="color:#999;margin:1em 0;text-align: right;">

                &nbsp&nbsp&nbsp&nbsp            
                
                &nbsp&nbsp&nbsp&nbsp
            </div>
            

            <?php ActiveForm::end(); ?>
        </div>
        <!-- </div> -->
    </div>
</div>