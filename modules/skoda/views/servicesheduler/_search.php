<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\ServiceshedulerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicesheduler-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
        'options' => [
            'class' => 'servicesheduler-search-form'
        ],        
    ]); ?>

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'SERVICESHEDULER_SEARCH_TITLE') ?> </h1>       


    <?php 
        echo $form->field($dataProvider, 'responsible') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'SERVICESHEDULER_SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'SERVICESHEDULER_RESET'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

