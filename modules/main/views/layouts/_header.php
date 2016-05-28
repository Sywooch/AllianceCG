<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/alliance_logo.png', ['height'=>'55']),
        'brandUrl' => Yii::$app->homeUrl,
        'id' => 'navmenu',
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-primary',
            'data-spy' => "affix", 
            'data-offset-top' => "100",
        ],
    ]);

    // echo $this->render('@app/modules/main/views/layouts/_shared_header');
    
echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right nav-collapse'],
        'id' => 'navigation_menu',
        'activateItems' => false,
        'encodeLabels' => false,
        'items' => array_filter([
        Yii::$app->user->isGuest ?
            [
                'label' => Yii::t('app', '{icon} NAV_LOGIN', ['icon' => FA::icon('user')]),
                'url' => ['/user/default/login']
            ] : false,
        !Yii::$app->user->isGuest ?
            [
                'label' => Yii::t('app', '{icon} NAV_CONTACT', ['icon' => FA::icon('cog')]),
                'url' => ['/main/contact'],
                // 'visible' => Yii::$app->user->can('adminIsVisible')
            ] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => FA::icon('user') . ' ' . Yii::$app->user->identity->userfullname, 'items' => [
                ['label' => Yii::t('app', '{icon} NAV_PROFILE', ['icon' => FA::icon('user')]), 'url' => ['/user/profile']],
                ['label' => Yii::t('app', '{icon} NAV_LOGOUT', ['icon' => FA::icon('power-off')]),
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                ]
            ] :
            false,
        ]),
    ]);    

    NavBar::end();



    ?>