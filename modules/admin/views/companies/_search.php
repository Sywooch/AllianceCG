<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'companies-search-form'
        ],
    ]); ?>

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'ADMIN_SEARCH_TITLE') ?> </h1>

    <?= $form->field($model, 'company_name', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-tent"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_name' )]) . '</div>' ?>

    <?= $form->field($model, 'company_brand', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-tent"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_brand' )]) . '</div>' ?>    

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'ADMIN_POSITION_SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'ADMIN_POSITION_RESET'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
