<?php

use yii\bootstrap\Nav;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



echo Nav::widget([
    'options' => ['class' => 'nav navbar-left nav-pills'],
    'encodeLabels' => false,
    'items' => array_filter([
        [
            'label' => Yii::t('app', '{icon} CREDITCALENDAR_CALENDAR', ['icon' => '<i class="fa fa-calendar"></i>']),
            'url' => '/alliance/creditcalendar/calendar',
        ],
        [
            'label' => Yii::t('app', '{icon} CREDITCALENDAR_TABLE', ['icon' => '<i class="fa fa-table"></i>']),
            'url' => '/alliance/creditcalendar',
            'visible' => !Yii::$app->user->can('privateCreditcalendarPost'),
        ],
        [
            'label' => Yii::t('app', '{icon} CREDITCALENDAR_TABLE', ['icon' => '<i class="fa fa-table"></i>']),
            'visible' => Yii::$app->user->can('privateCreditcalendarPost'),
            'items' => [
                    [
                        'label' => Yii::t('app', '{icon} CREDITCALENDAR_TABLE_ALL', ['icon' => '<i class="fa fa-table"></i>']),
                        'url' => ['/alliance/creditcalendar'],
                    ],
                    [
                        'label' => Yii::t('app', '{icon} CREDITCALENDAR_TABLE_PRIVATE', ['icon' => '<i class="fa fa-table"></i>']),
                        'url' => ['/alliance/creditcalendar/private'],
                        
                    ],                    
                ],
        ],
        [
            'label' => Yii::t('app', '{icon} CREDITCALENDAR_GRAPH', ['icon' => '<i class="fa fa-pie-chart"></i>']),
            'url' => '/alliance/creditcalendar/graph',
            'visible' => Yii::$app->user->can('root')
        ],
    ]),
]);