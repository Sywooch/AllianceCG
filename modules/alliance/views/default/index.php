<?php

/**
 * [$this->title description]
 * @var [type]
 */
$this->title = Yii::t('app', 'NAV_ALLIANCE');
$this->params['breadcrumbs'][] = $this->title; 


/**
 * 
 */
$this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/default/counters.js'), ['depends' => [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset'],
]); 

$this->registerJsFile(Yii::getAlias('@web/js/libs/highcharts/highcharts.js'), ['depends' => [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset'],
]); 
$this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/default/creditlastcount.js'), ['depends' => [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset'],
]);   

/** 
 * 
 */
echo $this->render('_creditDepartment', [
    'model' => $model,
]); 

?>
