<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */

$deleteRestore = file_get_contents('js/modules/references/companies/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

?>

<div class="companies-search" id="companies_search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'companies-search-form',
        ],
    ]); ?>

    <div class="col-sm-4">

    <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    
    </div>

    <div class="form-group col-sm-8" style="text-align: right">
        <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>

        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>

        <?php // echo Html::a(FA::icon('remove') . ' ' . Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('refresh')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?> 

        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']); ?>
        <?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']); ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>