<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;
use yii\helpers\Url;

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/alliance_logo.png', ['height'=>'55']),
        'brandUrl' => Yii::$app->homeUrl,
        'id' => 'navmenu',
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-primary',
        ],
    ]);

    // echo $this->render('@app/modules/main/views/layouts/_shared_header');
    
echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'id' => 'navigation_menu',
        'activateItems' => false,
        'encodeLabels' => false,
        'items' => array_filter([
        Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('user') . ' ' . Module::t('module', 'NAV_LOGIN'),
                'url' => ['/user/default/login']
            ] : false,
        !Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_CONTACT'),
                'url' => ['/main/contact'],
                // 'visible' => Yii::$app->user->can('adminIsVisible')
            ] :
            false,
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