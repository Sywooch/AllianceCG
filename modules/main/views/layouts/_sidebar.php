<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
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
            'label' => FA::icon('building') . ' ' . Module::t('module', 'NAV_ALLIANCE'),
            // 'content' => Html::a(Module::t('module', 'CREATE'), ['create'], ['class' => 'nav nav-pills']),
            'content' => $this->render('_allianceContent'),
            'visible' => Yii::$app->user->can('creditcalendarIsVisible'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'alliance' ? 'in' : false,
            ],
        ],
        [
            'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA'),
            // 'content' => Html::a(Module::t('module', 'CREATE'), ['create'], ['class' => 'nav nav-pills']),
            'content' => $this->render('_skodaContent'),
            'visible' => Yii::$app->user->can('creditcalendarIsVisible'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'skoda' ? 'in' : false,
            ],
        ],
        [
            'label' => FA::icon('book') . ' ' . Module::t('module', 'NAV_REFERENCES'),
            // 'content' => Html::a(Module::t('module', 'CREATE'), ['create'], ['class' => 'nav nav-pills']),
            'content' => $this->render('_referencesContent'),
            'visible' => Yii::$app->user->can('creditcalendarIsVisible'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'references' ? 'in' : false,
            ],
        ],
        [
            'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN'),
            // 'content' => Html::a(Module::t('module', 'CREATE'), ['create'], ['class' => 'nav nav-pills']),
            'content' => $this->render('_adminContent'),
            'visible' => Yii::$app->user->can('creditcalendarIsVisible'),
            'contentOptions' => [
                'class' => Yii::$app->controller->module->id == 'admin' ? 'in' : false,
            ],
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
    //             'label' => FA::icon('building') . ' ' . Module::t('module', 'NAV_ALLIANCE'),
    //             'url' => ['/alliance/'],
    //             'visible' => Yii::$app->user->can('creditcalendarIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_CREDITCALENDAR'), 'url' => ['/alliance/creditcalendar/calendar'],
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
    //             'label' => FA::icon('wrench') . ' ' . Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda/'],
    //             'visible' => Yii::$app->user->can('skodaIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('male') . ' ' . Module::t('module', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar'],
    //             'visible' => Yii::$app->user->can('skodaIsVisible')
    //         ],
    //         [
    //             'label' => FA::icon('television') . ' ' . Module::t('module', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor'],
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
    //             'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN'),
    //             'url' => '/admin',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('user') . ' ' . Module::t('module', 'ADMIN_USERS'),
    //             'url' => '/admin/users',
    //             // 'options' => ['class' => 'list-group-item'],

    //         ],
    //         [
    //             'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_USERROLES'),
    //             'url' => '/admin/userroles',
    //         ],
    //         [
    //             'label' => FA::icon('institution') . ' ' . Module::t('module', 'ADMIN_COMPANIES'),
    //             'url' => '/admin/companies',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('users') . ' ' . Module::t('module', 'ADMIN_DEPARTMENTS'),
    //             'url' => '/admin/departments',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('briefcase') . ' ' . Module::t('module', 'ADMIN_POSITIONS'),
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
    //             'label' => FA::icon('book') . ' ' . Module::t('module', 'NAV_REFERENCES'),
    //             'url' => '/references',
    //             // 'options' => ['class' => 'list-group-item'],
    //         ],
    //         [
    //             'label' => FA::icon('diamond') . ' ' . Module::t('module', 'REFERENCES_TARGETS'),
    //             'url' => '/references/targets',
    //             // 'options' => ['class' => 'list-group-item'],

    //         ],
    //         [
    //             'label' => FA::icon('car') . ' ' . Module::t('module', 'REFERENCES_BRANDS'),
    //             'url' => '/references/brands',
    //             // 'visible' => Yii::$app->user->can('admin'),
    //         ],
    //         [
    //             'label' => FA::icon('car') . ' ' . Module::t('module', 'REFERENCES_MODELS'),
    //             'url' => '/references/models    ',
    //             // 'visible' => Yii::$app->user->can('admin'),
    //         ],
    //     ]),
    // ]).'<hr/>'
    // : false;

    // echo ;

    

    ?>