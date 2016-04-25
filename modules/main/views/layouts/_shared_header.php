<?php

use yii\bootstrap\Nav;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\Module;

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_filter([
        Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('user') . ' ' . Module::t('module', 'NAV_LOGIN'),
                'url' => ['/user/default/login']
            ] : false,
            ['label' => FA::icon('building') . ' ' . Module::t('module', 'NAV_ALLIANCE'), 'items' => [
                    [
                        'label' => FA::icon('pie-chart') . ' ' . Module::t('module', 'NAV_ALLIANCE_DASHBOARD'),
                        'url' => ['/alliance/'],
//                        'visible' => Yii::$app->user->can('root')
                    ],
                    [
                        'label' => FA::icon('phone') . ' ' . Module::t('module', 'NAV_ALLIANCE_PHONEBOOK'),
                        'url' => ['/alliance/phonebook'],
                        'visible' => Yii::$app->user->can('root')
                        
                    ],
                    [
                        'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_CREDITCALENDAR'),
                        'url' => ['/alliance/creditcalendar/calendar'], 
                        'visible' => Yii::$app->user->can('creditcalendarIsVisible')
                    ],
                    [
                        'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_DUTY'),
                        'url' => ['/alliance/'], 
                        'visible' => Yii::$app->user->can('root')
                    ],                
                ],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
        !Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('wrench') . Module::t('module', 'NAV_SKODA'),
                'items' => [
                    [
                        'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_DASHBOARD'), 'url' => ['/skoda/']
                    ],
                    [
                        'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar']
                    ],
                    [
                        'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor']
                    ],                                    
                ],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ] :
            false,
        !Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('cog') . Module::t('module', 'NAV_ADMIN'),
                'items' => [
                        [
                            'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN_DASHBOARD'), 'url' => ['/admin/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_USERS'), 'url' => ['/admin/users/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_COMPANIES'), 'url' => ['/admin/companies/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_POSITIONS'), 'url' => ['/admin/positions/']
                        ],                
                    ],
                'visible' => Yii::$app->user->can('adminIsVisible')
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