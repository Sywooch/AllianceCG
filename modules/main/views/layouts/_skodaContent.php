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
                'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda/'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => FA::icon('male') . ' ' . Yii::t('app', 'NAV_SKODA_SERVICESHEDULER'), 'url' => ['/skoda/servicesheduler/calendar'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
            [
                'label' => FA::icon('television') . ' ' . Yii::t('app', 'NAV_SKODA_STATUSMONITOR'), 'url' => ['/skoda/statusmonitor/calendar'],
                'visible' => Yii::$app->user->can('skodaIsVisible')
            ],
        ]),
                // 'visible' => Yii::$app->user->can('skodaIsVisible')
    ])
    : false;  

?>

</div>    