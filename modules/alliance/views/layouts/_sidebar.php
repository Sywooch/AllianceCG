<?php

use yii\bootstrap\Nav;
use rmrevin\yii\fontawesome\FA;;
use app\modules\alliance\Module;
use yii\helpers\Html;
use yii\helpers\Url;

    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('pie-chart') . ' ' . Module::t('module', 'NAV_ALLIANCE'),
                'url' => '/alliance',    
//                'visible' => Yii::$app->user->can('admin')            
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'ALLIANCE_CREDITCALENDAR'),
                'url' => '/alliance/creditcalendar',    
                'visible' => Yii::$app->user->can('admin'),            
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'ALLIANCE_CREDITCALENDARCOMMENTS'),
                'url' => '/alliance/creditcalendarcomments',    
                'visible' => Yii::$app->user->can('admin'),            
            ],
            [
                'label' => FA::icon('phone') . ' ' . Module::t('module', 'NAV_ALLIANCE_PHONEBOOK'),
                'url' => '/alliance/phonebook',    
                'visible' => Yii::$app->user->can('root'),            
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_DUTY'),
                'url' => '/alliance/dutygraph/',    
                'visible' => Yii::$app->user->can('root'),            
            ],
        ]),
    ]);
    ?>