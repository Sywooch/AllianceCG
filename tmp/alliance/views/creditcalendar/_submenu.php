<?php

    use yii\bootstrap\Nav;
    use rmrevin\yii\fontawesome\FA;
    use app\modules\alliance\Module;

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
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'CREDITCALENDAR_CALENDAR'),
                'url' => '/alliance/creditcalendar/calendar',
            ],
            [
                'label' => FA::icon('table') . ' ' . Module::t('module', 'CREDITCALENDAR_TABLE'),
                'url' => '/alliance/creditcalendar',
            ],
            [
                'label' => FA::icon('pie-chart') . ' ' . Module::t('module', 'CREDITCALENDAR_GRAPH'),
                'url' => '/alliance/creditcalendar/graph',
            ],
        ]),
    ]);