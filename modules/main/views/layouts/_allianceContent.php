<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

?>

<div style="min-width: 100%">

<?php

    echo Yii::$app->user->can('creditcalendarIsVisible') ?
     Nav::widget([
        // 'options' => ['class' => 'nav nav-stacked'],
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('building') . ' ' . Module::t('module', 'NAV_ALLIANCE'),
                'url' => ['/alliance/'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_CREDITCALENDAR'), 'url' => ['/alliance/creditcalendar/calendar'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
            [
                'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_CLIENTCIRCULATION'), 'url' => ['/alliance/clientcirculation'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
        ]),
    ])
    : false;

?>

</div>    