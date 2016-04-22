<?php

use yii\helpers\Html;
use app\modules\alliance\Module;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$upd = file_get_contents('js/modules/alliance/creditcalendar/gridViewMultipleDelete.js');
$this->registerJs($upd, View::POS_END);

?>
    
<p style="text-align: right">
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>

        <?php // Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_EVENT'), ['create?is_task=0'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        <?php
            // if(Yii::$app->user->can('creditcalendarSetResponsibles'))
            // {
            //     echo Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_TASK'), ['create?is_task=1'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']);
            // }
        ?>
        <?php 
            if(Yii::$app->controller->action->id == 'index')
            {
                echo Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']);
            }
            elseif(Yii::$app->controller->action->id == 'calendar')
            {
                echo Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['calendar'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']);
            }
            elseif(Yii::$app->controller->action->id == 'graph')
            {
                echo Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['graph'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']);
            }
        ?> 
        <?php 
            if(Yii::$app->controller->action->id == 'index')
            {
                echo Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
            }
        ?>  
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
</p> 