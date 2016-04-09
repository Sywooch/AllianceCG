<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$form = ActiveForm::begin([
        'method' => 'get',
        'options' => [
            // 'class' => ''
        ],        
    ]); ?>

    <?= $form->field($model, 'searchfield', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('th-large') . ' </span>{input}<span class="input-group-addon"> ' . Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SERVICESHEDULER_SEARCH'), ['class' => 'btn-link']) . ' </span></div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'searchfield' )])    ?>
    <?php $form->field($model, 'searchfield'); ?>

    <?php ActiveForm::end(); ?>