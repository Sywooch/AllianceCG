<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

?>

<div style="min-width: 100%">

<?php

    echo Yii::$app->user->can('skodaIsVisible') ?
     Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => Yii::t('app', '{icon} NAV_SKODA', ['icon' => FA::icon('wrench')]), 'url' => ['/skoda/'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => Yii::t('app', '{icon} NAV_SKODA_SERVICESHEDULER', ['icon' => FA::icon('male')]), 'url' => ['/skoda/servicesheduler/calendar'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => Yii::t('app', '{icon} NAV_SKODA_STATUSMONITOR', ['icon' => FA::icon('television')]), 'url' => ['/skoda/statusmonitor/calendar'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => Yii::t('app', '{icon} NAV_SKODA_CLIENTS', ['icon' => '<i class="fa fa-users"></i>']), 'url' => ['/skoda/clients/index'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
        ]),
                // 'visible' => Yii::$app->user->can('skodaIsVisible')
    ])
    : false;  

?>

</div>    