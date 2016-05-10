<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

    echo Yii::$app->user->can('creditcalendarIsVisible') ?
     Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('building') . ' ' . Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance/'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_CREDITCALENDAR'), 'url' => ['/alliance/creditcalendar/calendar'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
        ]),
    ]).'<hr/>'
    : false;
    
    echo Yii::$app->user->can('skodaIsVisible') ?
     Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda/'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
        ]),
                // 'visible' => Yii::$app->user->can('skodaIsVisible')
    ]).'<hr/>'
    : false;   
    
    echo Yii::$app->user->can('admin') ?
    Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN'),
                'url' => '/admin',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('user') . ' ' . Module::t('module', 'ADMIN_USERS'),
                'url' => '/admin/users',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_USERROLES'),
                'url' => '/admin/userroles',
            ],
            [
                'label' => FA::icon('institution') . ' ' . Module::t('module', 'ADMIN_COMPANIES'),
                'url' => '/admin/companies',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('briefcase') . ' ' . Module::t('module', 'ADMIN_POSITIONS'),
                'url' => '/admin/positions',
                // 'options' => ['class' => 'list-group-item'],
            ],
        ]),
    ]).'<hr/>'
    : false;

    // echo ;

    

    ?>