<?php

use app\modules\alliance\Module;
use yii\widgets\Pjax;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDARCAL');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_submenu', [
    'model' => $model,
]) 
?> 

<?= $this->render('_buttonmenu', [
    'model' => $model,
])
?>

<div class="creditcalendar-index">
    
    <?php  Pjax::begin(); ?>
        <?php 
           $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
           $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery.min.js'), ['depends' => [
               'yii\web\YiiAsset',
               'yii\bootstrap\BootstrapAsset'],
           ]);          
           $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/moment.min.js'), ['depends' => [
               'yii\web\YiiAsset',
               'yii\bootstrap\BootstrapAsset'],
           ]);
           $this->registerJsFile(Yii::getAlias('@web/js/jqfc/fullcalendar.js'), ['depends' => [
               'yii\web\YiiAsset',
               'yii\bootstrap\BootstrapAsset'],
           ]);
           $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lang/ru.js'), ['depends' => [
               'yii\web\YiiAsset',
               'yii\bootstrap\BootstrapAsset'],
           ]);  
           $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/creditcalendar.js'), ['depends' => [
               'yii\web\YiiAsset',
               'yii\bootstrap\BootstrapAsset'],
           ]);    
       ?>
     
<div id='credit_calendar'> </div>  

   <?php  Pjax::end(); ?>


</div>