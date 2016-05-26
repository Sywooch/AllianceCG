<?php

use yii\bootstrap\Nav;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\helpers\Url;

echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
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

    ?>