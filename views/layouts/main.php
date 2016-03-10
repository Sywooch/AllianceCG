<?php


/* @var $this \yii\web\View */
/* @var $content string */
use app\components\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
 <?php

    function getNavbarCSS()
    {   
        $curmodule = Yii::$app->controller->module->id;    
        if($curmodule == 'skoda'){
            return 'navbar navbar-fixed-top navbar-skoda';
        }
        else{
            // return 'navbar-inverse navbar-fixed-top';
            return 'navbar navbar-fixed-top';
        }
    }

    function getNavbarBrandUrl()
    {   
        $curmodule = Yii::$app->controller->module->id;    
        if($curmodule == 'skoda'){
            return Url::toRoute('/skoda');
        }
        else{
            return Yii::$app->homeUrl;
        }
    }    

    function getNavbarLogo()
    {
        $curmodule = Yii::$app->controller->module->id;    
        if($curmodule == 'skoda'){
            return Html::img('@web/img/logo/skoda_logo.png', ['width'=>'48','height'=>'48']);
        }
        else{
            return Html::img('@web/img/logo/alliance_logo.png', ['height'=>'55']);
        }
    }

    NavBar::begin([
        'brandLabel' => getNavbarLogo(),
        'brandUrl' => getNavbarBrandUrl(),
        'options' => [
            'class' => getNavbarCSS(),
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_filter([
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']] :
            false,
        Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SKODA'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda/']],
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SHEDULER'), 'url' => ['/skoda/servicesheduler/index']],
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_STATUS'), 'url' => ['/skoda/statusmonitor/index']],
            ]] :
            false,
        Yii::$app->user->can('admin') ?
            ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_ADMIN'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index'], ],
                ['label' => '<span class="glyphicon glyphicon-briefcase"></span> ' . Yii::t('app', 'ADMIN_POSITIONS'), 'url' => ['/admin/positions/index']],
                ['label' => '<span class="glyphicon glyphicon-tent"></span> ' . Yii::t('app', 'ADMIN_COMPANIES'), 'url' => ['/admin/companies/index']],
            ]] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_PROFILE'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'NAV_PROFILE_VIEW'), 'url' => ['/user/profile']],
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_PROFILE_EDIT'), 'url' => ['/user/profile/update']],
                ['label' => '<span class="glyphicon glyphicon-asterisk"></span> ' . Yii::t('app', 'NAV_PROFILE_PASSWORD_RESET'), 'url' => ['/user/profile/password-change']],
                ['label' => '<span class="glyphicon glyphicon-off"></span> ' . Yii::t('app', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]] :
            false,
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>  
        <?= $content ?>
    </div>
</div>

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy;  -->
            <?php
                // Yii::$app->params['org'] . '' 
            ?>
            <?php
                // date('Y') 
            ?>
<!--         </b></p>

        <p class="pull-right"> -->
            <?php
                // Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36'])
            ?>
            <!-- <b> -->
            <?php
                // Yii::$app->name 
            ?> 
<!--         </b></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
