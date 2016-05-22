<?php

use app\modules\alliance\Module;
use yii\widgets\Pjax;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Module::t('module', 'CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="creditcalendar-index">

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p style="text-align: right">
                <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['calendar'], ['class' => 'btn btn-info btn-sm']) ?>
            </p>

            <!-- <br/><br/><br/> -->

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
<!--           <select id="status_selector" name=<?php // $model->getAttributeLabel('status') ?>>
            <option value="all"><?php // Module::t('module', 'CREDITCALENDAR_TABLE_ALL') ?></a>
            <option value=<?php // $model::STATUS_ATWORK ?>><?php // $model->getStatusesArray()['0'] ?></a>
            <option value=<?php // $model::STATUS_CLARIFY?>><?php // $model->getStatusesArray()['1'] ?></a>
            <option value=<?php // $model::STATUS_FINISHED?>><?php // $model->getStatusesArray()['2'] ?></a>
          </select>   -->


          <select id="author_selector">
            <option value="all">Все записи</a>
            <option value=<?= Yii::$app->user->getId() ?>>Мои записи</a>
          </select> 

          <div id='credit_calendar'> </div>  

          <?php  Pjax::end(); ?>
    
</div>