<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
// use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Collapse;

 // <span class="label label-pill label-success navbar-right nav-label">' . FA::icon('area-chart') . '</span>'
 // $count = StatusmonitorSearch::find()
 // ->count();
 
// Yii::$app->controller->module->id;

echo Collapse::widget([
    'id' => 'sidebar',
    'options' => [
            'class' => 'collapse-test',
            'style' => 'margin-top: 0',
            ],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => FA::icon('building') . ' ' . Yii::t('app', 'NAV_ALLIANCE'),
            'content' => $this->render('_allianceContent'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'alliance' ? 'in' : false,
            ],
            'options' => ['style' => !Yii::$app->user->can('creditcalendarIsVisible') ? 'display: none;' : false,],
        ],
        [
            'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA'),
            'content' => $this->render('_skodaContent'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'skoda' ? 'in' : false,
            ],
            'options' => ['style' => !Yii::$app->user->can('skodaIsVisible') ? 'display: none;' : false,],
        ],
        [
            'label' => FA::icon('book') . ' ' . Yii::t('app', 'NAV_REFERENCES'),
            'content' => $this->render('_referencesContent'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'references' ? 'in' : false,
            ],
            'options' => ['style' => !Yii::$app->user->can('creditcalendarIsVisible') ? 'display: none;' : false,],
        ],
        [
            'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_ADMIN'),
            'content' => $this->render('_adminContent'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'admin' ? 'in' : false,
            ],
            'options' => ['style' => !Yii::$app->user->can('admin') ? 'display: none;' : false,],
        ],
    ]
]); 
    
    // echo Yii::$app->user->can('creditcalendarIsVisible') ?
    //  Nav::widget([
    //     // 'options' => ['class' => 'nav nav-stacked'],
    //     'options' => ['class' => 'nav nav-stacked'],
    //     'encodeLabels' => false,
    //     'items' => array_filter([
    //         [
    //             'label' => FA::icon('building') . ' ' . Yii::t('app', 'NAV_ALLIANCE'),
    //             'url' => ['/alliance/'],
    //             'visible' => Yii::$app->user->can('creditcalendarIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('calendar') . ' ' . Yii::t('app', 'NAV_ALLIANCE_CREDITCALENDAR'), 'url' => ['/alliance/creditcalendar/calendar'],
    //             'visible' => Yii::$app->user->can('creditcalendarIsVisible')
    //         ],
    //     ]),
    // ]).'<hr/>'
    // : false;
    
    // echo Yii::$app->user->can('skodaIsVisible') ?
    //  Nav::widget([
    //     'options' => ['class' => 'nav nav-stacked'],
    //     'encodeLabels' => false,
    //     'items' => array_filter([
    //         [
    //             'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda/'],
    //             'visible' => Yii::$app->user->can('skodaIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('male') . ' ' . Yii::t('app', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar'],
    //             'visible' => Yii::$app->user->can('skodaIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('television') . ' ' . Yii::t('app', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor'],
    //             'visible' => Yii::$app->user->can('skodaIsVisible')
    //         ],
    //     ]),
    //             // 'visible' => Yii::$app->user->can('skodaIsVisible')
    // ]).'<hr/>'
    // : false;   
    
    // echo Yii::$app->user->can('admin') ?
    // Nav::widget([
    //     'options' => ['class' => 'nav nav-stacked'],
    //     'encodeLabels' => false,
    //     'items' => array_filter([
    //         [
    //             'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_ADMIN'),
    //             'url' => '/admin',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('user') . ' ' . Yii::t('app', 'ADMIN_USERS'),
    //             'url' => '/admin/users',
    //             // 'options' => ['class' => 'list-group-item'],

    //         ],
    //         [
    //             'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_USERROLES'),
    //             'url' => '/admin/userroles',
    //         ],
    //         [
    //             'label' => FA::icon('institution') . ' ' . Yii::t('app', 'ADMIN_COMPANIES'),
    //             'url' => '/admin/companies',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('users') . ' ' . Yii::t('app', 'ADMIN_DEPARTMENTS'),
    //             'url' => '/admin/departments',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('briefcase') . ' ' . Yii::t('app', 'ADMIN_POSITIONS'),
    //             'url' => '/admin/positions',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //     ]),
    // ]).'<hr/>'
    // : false;


    // echo Yii::$app->user->can('accessCreditReferences') ?
    // Nav::widget([
    //     'options' => ['class' => 'nav nav-stacked'],
    //     'encodeLabels' => false,
    //     'items' => array_filter([
    //         [
    //             'label' => FA::icon('book') . ' ' . Yii::t('app', 'NAV_REFERENCES'),
    //             'url' => '/references',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('diamond') . ' ' . Yii::t('app', 'REFERENCES_TARGETS'),
    //             'url' => '/references/targets',
    //             // 'options' => ['class' => 'list-group-item'],

    //         ],
    //         [
    //             'label' => FA::icon('car') . ' ' . Yii::t('app', 'REFERENCES_BRANDS'),
    //             'url' => '/references/brands',
    //             // 'visible' => Yii::$app->user->can('admin'),
    //         ],
    //         [
    //             'label' => FA::icon('car') . ' ' . Yii::t('app', 'REFERENCES_MODELS'),
    //             'url' => '/references/models    ',
    //             // 'visible' => Yii::$app->user->can('admin'),
    //         ],
    //     ]),
    // ]).'<hr/>'
    // : false;

    // echo ;

    

    ?>