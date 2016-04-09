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
            ],
            [
                'label' => FA::icon('phone') . ' ' . Module::t('module', 'NAV_ALLIANCE_PHONEBOOK'),
                'url' => '/alliance/phonebook',
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_DUTY'),
                'url' => '/alliance/dutygraph/',
            ],
        ]),
    ]);
    ?>