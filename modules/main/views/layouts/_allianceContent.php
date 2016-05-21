<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
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
                'label' => Yii::t('app', '{icon} NAV_ALLIANCE', ['icon' => FA::icon('building')]),
                'url' => ['/alliance/'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
            [
                'label' =>  Yii::t('app', '{icon} NAV_ALLIANCE_CREDITCALENDAR', ['icon' => FA::icon('calendar')]), 'url' => ['/alliance/creditcalendar/calendar'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
            [
                'label' => Yii::t('app', '{icon} NAV_ALLIANCE_CLIENTCIRCULATION', ['icon' => FA::icon('calendar')]), 'url' => ['/alliance/clientcirculation'],
                'visible' => Yii::$app->user->can('creditcalendarIsVisible')
            ],
        ]),
    ])
    : false;

?>

</div>    