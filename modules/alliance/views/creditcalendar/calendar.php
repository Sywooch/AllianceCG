<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Yii::t('app', 'CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="creditcalendar-index">

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p class="buttonpane">
                <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
                <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['calendar'], ['class' => 'btn btn-link animlink']) ?>
                <button class='btn btn-link animlink' onclick="printPage()">
                  <?php echo Yii::t('app', '{icon} PRINT', ['icon' => '<i class="fa fa-print"></i>']) ?>
                </button>
                <select id="author_selector">
                  <option value="all">
                    Все записи
                  </a>
                  <option value=<?= Yii::$app->user->getId() ?>>
                    Мои записи
                  </a>
                </select> 
            </p>

            <!-- <br/><br/><br/> -->

            <?php  Pjax::begin(['id' => 'creditCalendar']); ?>
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
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/printCalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);    
               ?>

<br/>

          <!-- <button onclick="printPage()">Print this page</button> -->
          
          <div id='credit_calendar'></div>  


          <div id='datepicker'></div>

          <?php  Pjax::end(); ?>
    
</div>