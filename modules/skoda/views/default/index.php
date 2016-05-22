<meta charset="UTF-8">

<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;

$this->title = Yii::t('app', 'ŠKODA');
$this->params['breadcrumbs'][] = $this->title;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
?>
<div class="admin-default-index center-block">
    <!--<h1>-->
        <?php // Html::encode($this->title) ?>
    <!--</h1>-->
    
    <p style="text-align: right">
        <?php 
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-right nav-pills'],
                'encodeLabels' => false,
                'items' => array_filter([
                    [
                        'label' => Yii::t('app', '{icon} SERVICESHEDULER', ['icon' => FA::icon('calendar')]),
                        'url' => '/skoda/servicesheduler/calendar',
                    ],
                    [
                        'label' => Yii::t('app', '{icon} STATUSMONITOR', ['icon' => FA::icon('wrench')]),
                        'url' => '/skoda/statusmonitor/',
                    ],
                ]),
            ]);
        ?>
    </p>    
    
</div>

<?php
    $this->registerJsFile(Yii::getAlias('@web/js/libs/highcharts/highcharts.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]); 
    $this->registerJsFile(Yii::getAlias('@web/js/modules/skoda/default/defaultPageGraph.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);         
?>

<div class="col-lg-12" id="skoda"></div>
