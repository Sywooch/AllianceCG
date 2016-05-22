<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\LoginForm */

$this->title = Yii::t('app', '{icon} TITLE_LOGIN', ['icon' => FA::icon('sign-in')]);
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
            <h1>
                <?php // echo Html::encode($this->title) ?>
            </h1>

            <h1>
                <?= $this->title; ?>
            </h1>
            

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('user') . '</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'username' )]) ?>

            <?= $form->field($model, 'password', ['template'=>' <div class="input-group"><span class="input-group-addon">'. FA::icon('briefcase') . '</span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'password' )]) ?>
            
            <?php Yii::t('app', 'LOGIN_INFO') ?>
            
                <div class="col-md-4 rememberCheckbox" style="text-align: left">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
            <div class="login-buttons">
                <div class="col-md-5 passwordReset" style="padding-top: 8px;">
                    <?= Html::a(Yii::t('app', '{icon} LINK_PASSWORD_RESET', ['icon' => FA::icon('refresh')]), ['password-reset-request'], ['class' => 'btn-resetpwd']) ?>
                </div>
                <div class="col-md-3">
                    <?= Html::submitButton(Yii::t('app', '{icon} USER_BUTTON_LOGIN', ['icon' => FA::icon('sign-in')]), ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
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