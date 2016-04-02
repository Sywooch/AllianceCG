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
      
//$mcexist = !empty($wcs->responsible) ? '1' : '0';
if(!empty($wcs->responsible)){
    $mcexist = '1';
    $label = "label label-pill label-success";
    $icon = 'user-secret';
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
                'label' => Module::t('module', 'SERVICESHEDULER') . ' <span style="text-align: right;" class="' . $label. '">' . FA::icon('' . $icon . '') . '</span>',
                'url' => '/skoda/servicesheduler/calendar',
            ],
            [
                'label' => Module::t('module', 'STATUS_TITLE') . ' <span style="text-align: right;" class="label label-pill label-success">' . FA::icon('calculator') . ' ' . $count . '</span>',
                'url' => '/skoda/statusmonitor/',
            ],
        ]),
                    'activateParents' => true
    ]);
?>