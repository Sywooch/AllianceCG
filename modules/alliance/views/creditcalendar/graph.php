<?php

use app\modules\alliance\Module;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = Module::t('module', 'CREDITCALENDAR_GRAPH');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_submenu', [
    'model' => $model,
]) ?> 

<?= $this->render('_buttonmenu', [
    'model' => $model,
])?>

<?php 
  
    $this->registerJsFile(Yii::getAlias('@web/js/highcharts/highcharts.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);
    $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/creditCalendarGraph.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);
?>

<!--<script src='/js/highcharts/highcharts.js'></script>-->


<div class="col-lg-12" id="creditcalendar_graph"></div>