<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PositionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="positions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'user-search-form'
        ],
    ]); ?>

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'ADMIN_POSITION_SEARCH_TITLE')?> </h1>

    <?php 
        $form->field($model, 'id') 
    ?>

    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-briefcase"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) . '</div>' ?>

    <div class="form-group">
        
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'ADMIN_POSITION_SEARCH'), ['class' => 'btn btn-primary']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'ADMIN_POSITION_RESET'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
