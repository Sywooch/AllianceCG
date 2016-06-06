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
                'label' => Yii::t('app', '{icon} SERVICESHEDULER_CALENDAR', ['icon' => '<i class="fa fa-calendar"></i>']),
                'url' => '/skoda/servicesheduler/calendar',
            ],
            [
                'label' => Yii::t('app', '{icon} SERVICESHEDULER_TABLE', ['icon' => '<i class="fa fa-table"></i>']),
                'url' => '/skoda/servicesheduler',
            ],
        ]),
    ]);