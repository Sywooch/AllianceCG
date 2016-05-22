<?php

use yii\bootstrap\Nav;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\helpers\Url;

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'id' => 'navigation_menu',
        'encodeLabels' => false,
        'items' => array_filter([
        Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('user') . ' ' . Yii::t('app', 'NAV_LOGIN'),
                'url' => ['/user/default/login']
            ] : false,
            ['label' => FA::icon('building') . ' ' . Yii::t('app', 'NAV_ALLIANCE'), 'items' => [
                    [
                        'label' => FA::icon('pie-chart') . ' ' . Yii::t('app', 'NAV_ALLIANCE_DASHBOARD'),
                        'url' => ['/alliance/'],
//                      'visible' => Yii::$app->user->can('root')
                    ],
                    [
                        'label' => FA::icon('calendar') . ' ' . Yii::t('app', 'NAV_ALLIANCE_CREDITCALENDAR'),
                        'url' => ['/alliance/creditcalendar/calendar'], 
                        'visible' => Yii::$app->user->can('creditcalendarIsVisible')
                    ],             
                ],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
        Yii::$app->user->can('skodaIsVisible') ?
            [
                'label' => FA::icon('wrench') . Yii::t('app', 'NAV_SKODA'),
                'items' => [
                    [
                        'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA_DASHBOARD'), 'url' => ['/skoda/'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
                    ],
                    [
                        'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar'],
                        'visible' => Yii::$app->user->can('skodaIsVisible')
                    ],
                    [
                        'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor'],
                        'visible' => Yii::$app->user->can('skodaIsVisible')
                    ],                                    
                ],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ] :
            false,
        !Yii::$app->user->isGuest ?
            [
                'label' => FA::icon('cog') . Yii::t('app', 'NAV_ADMIN'),
                'items' => [
                        [
                            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_ADMIN_DASHBOARD'), 'url' => ['/admin/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_USERS'), 'url' => ['/admin/users/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_USERROLES'), 'url' => ['/admin/userroles/']
                        ],     
                        [
                            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_COMPANIES'), 'url' => ['/admin/companies/']
                        ],
                        [
                            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_POSITIONS'), 'url' => ['/admin/positions/']
                        ],             
                    ],
                'visible' => Yii::$app->user->can('adminIsVisible')
            ] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => FA::icon('user') . ' ' . Yii::$app->user->identity->userfullname, 'items' => [
                ['label' => FA::icon('user') . ' ' . Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile']],
                ['label' => FA::icon('power-off') . ' ' . Yii::t('app', 'NAV_LOGOUT'),
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                ]
            ] :
            false,
        ]),
    ]);