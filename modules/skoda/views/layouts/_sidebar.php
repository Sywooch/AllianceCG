<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\skoda\Module;
use rmrevin\yii\fontawesome\FA;
use app\modules\skoda\models\Servicesheduler;

$today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
$wcs = Servicesheduler::find()
    ->where(['date' => $today])
    ->one();
      
if(!empty($wcs->responsible)){
    $mcexist = '1';
    $label = "label label-pill label-success";
    $icon = 'user';
}
else{
    $mcexist = '1';
    $label = "label label-pill label-danger";
    $icon = 'user-times';    
}

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
                'label' => '<h5>' . Module::t('module', 'SERVICESHEDULER') . ' <span class="' . $label. ' navbar-right">' . FA::icon('' . $icon . '') . '</span></h5>',
                'url' => '/skoda/servicesheduler/calendar',
//                'options' => ['class' => 'navbar-nav navbar-right'],
            ],
            [
                'label' => Module::t('module', 'STATUS_TITLE') . ' <span class="label label-pill label-success navbar-right">' . FA::icon('calculator') . ' ' . $count . '</span>',
                'url' => '/skoda/statusmonitor/',
            ],
        ]),
                    'activateParents' => true
    ]);
?>