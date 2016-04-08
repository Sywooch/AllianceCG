<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\Module;

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/alliance_logo.png', ['height'=>'55']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-primary',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_filter([
//        !Yii::$app->user->isGuest ?
//            ['label' => FA::icon('home') . ' ' . Module::t('module', 'NAV_HOME'), 'url' => ['/main/default/index']] :
//            false,
//        ['label' => FA::icon('at') . ' ' . Module::t('module', 'NAV_CONTACT'), 'url' => ['/main/contact/index']],
        Yii::$app->user->isGuest ?
            ['label' => FA::icon('user') . ' ' . Module::t('module', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA'), 'items' => [
                    ['label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_DASHBOARD'), 'url' => ['/skoda/']],
                    ['label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar']],
                    ['label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor']],
                
                ],
            ] :
//            ['label' => FA::icon('wrench') . Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda/']] :
            false,
        Yii::$app->user->can('admin') ?
            ['label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN'), 'items' => [
                    ['label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN_DASHBOARD'), 'url' => ['/admin/']],
                    ['label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_USERS'), 'url' => ['/admin/users/']],
                    ['label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_COMPANIES'), 'url' => ['/admin/companies/']],
                    ['label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_POSITIONS'), 'url' => ['/admin/positions/']],
                
                ],
            ] :
//            ['label' => FA::icon('cog') . Module::t('module', 'NAV_ADMIN'), 'url' => ['//admin/default/index']] :
            false,
//        !Yii::$app->user->isGuest ?
//            ['label' => FA::icon('user') . Module::t('module', 'NAV_PROFILE'), 'url' => ['/user/profile']] :
//            false,
//        !Yii::$app->user->isGuest ?
//            ['label' => FA::icon('power-off') . Module::t('module', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']] :
//            false,
        !Yii::$app->user->isGuest ?
            ['label' => FA::icon('user') . ' ' . Yii::$app->user->identity->userfullname, 'items' => [
                ['label' => FA::icon('user') . ' ' . Module::t('module', 'NAV_PROFILE'), 'url' => ['/user/profile']],
                ['label' => FA::icon('power-off') . ' ' . Module::t('module', 'NAV_LOGOUT'),
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                ]
            ] :
            false,
        ]),
    ]);
    NavBar::end();
    ?>