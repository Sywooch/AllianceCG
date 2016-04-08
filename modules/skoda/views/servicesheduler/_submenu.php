<?php

    use yii\bootstrap\Nav;
    use rmrevin\yii\fontawesome\FA;
    use app\modules\skoda\Module;

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
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'SERVICESHEDULER_CALENDAR'),
                'url' => '/skoda/servicesheduler/calendar',
            ],
            [
                'label' => FA::icon('table') . ' ' . Module::t('module', 'SERVICESHEDULER_TABLE'),
                'url' => '/skoda/servicesheduler',
            ],
//            [
//                'label' => FA::icon('list') . ' ' . Module::t('module', 'SERVICESHEDULER_LIST'),
//                'url' => '/skoda/servicesheduler/list',
//            ],
        ]),
    ]);