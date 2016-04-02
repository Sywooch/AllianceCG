<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\skoda\Module;
use rmrevin\yii\fontawesome\FA;

$count = '1';

    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => 'ŠKODA',
                'url' => '/skoda',
            ],
            [
                'label' => Module::t('module', 'SERVICESHEDULER'),
                'url' => '/skoda/servicesheduler/calendar',
            ],
            [
                'label' => Module::t('module', 'STATUS_TITLE') . ' <span class="label label-pill label-success">' . FA::icon('calculator') . ' ' . $count . '</span>',
                'url' => '/skoda/statusmonitor/',
            ],
        ]),
                    'activateParents' => true
    ]);
?>