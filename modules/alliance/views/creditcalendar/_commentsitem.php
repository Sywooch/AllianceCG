<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="col-lg-1">
    
</div>

<div class="col-lg-11">
    <div class="panel panel-default">

        <div class="panel-heading panel-info">
            <?= FA::icon('comment') . ' ' . $model->getDisplayUser() . ', ' . \Yii::t('app', '{0, date}', $model->created_at); ?>
        </div>

        <div class="panel-body">

                <?= $model->comment_text; ?>

        </div>
    </div>   
</div>