<?php

    use yii\bootstrap\Nav;
    use rmrevin\yii\fontawesome\FA;
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
                'label' => Yii::t('app', '{icon} STATUSMONITOR_CALENDAR', ['icon' => FA::icon('calendar')]),
                'url' => '/skoda/statusmonitor/calendar',
            ],
            [
                'label' => Yii::t('app', '{icon} STATUSMONITOR_TABLE', ['icon' => FA::icon('table')]),
                'url' => '/skoda/statusmonitor',
            ],
            [
                'label' => Yii::t('app', '{icon} STATUS_SHOW_MONITOR', ['icon' => FA::icon('bar-chart')]),
                'url' => '/skoda/statusmonitor/monitor',
            ],
           [
               'label' => FA::icon('list') . ' ' . Yii::t('app', '{icon} SERVICESHEDULER_GRAPH', ['icon' => FA::icon('chart')]),
               'url' => '/skoda/statusmonitor/graph',
           ],
        ]),
    ]);