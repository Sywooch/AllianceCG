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
//            [
//                'label' => FA::icon('list') . ' ' . Module::t('module', 'SERVICESHEDULER_LIST'),
//                'url' => '/skoda/servicesheduler/list',
//            ],
        ]),
    ]);