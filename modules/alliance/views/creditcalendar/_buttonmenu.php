<?php

use yii\helpers\Html;
use app\modules\alliance\Module;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    
<p style="text-align: right">
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_EVENT'), ['create?is_task=0'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_TASK'), ['create?is_task=1'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['calendar'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
</p> 