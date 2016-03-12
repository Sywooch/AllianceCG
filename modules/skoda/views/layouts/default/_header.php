<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/skoda_logo.png', ['width'=>'48','height'=>'48']),
        'brandUrl' => Url::toRoute('/skoda'),
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-skoda',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-skoda'],
        'encodeLabels' => false,
        'items' => array_filter([
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']] :
            false,
        Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda/']] :
            false,
        // !Yii::$app->user->isGuest ?
        //     ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SKODA'), 'items' => [
        //         ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda/']],
        //         ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_SHEDULER'), 'url' => ['/skoda/servicesheduler/calendar']],
        //         ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_STATUS'), 'url' => ['/skoda/statusmonitor/index']],
        //     ]] :
        //     false,
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