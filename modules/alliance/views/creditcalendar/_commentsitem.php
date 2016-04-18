<?php

use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="panel panel-default">
    
    <div class="panel-heading panel-info">
        <?= $model->comment_author . ', ' . \Yii::t('app', '{0, date}', $model->created_at); ?>
    </div>
    
    <div class="panel-body">
        
            <?= $model->comment_text; ?>
        
    </div>
</div>   