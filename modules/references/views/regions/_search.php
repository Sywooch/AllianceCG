<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\RegionsSearch */
/* @var $form yii\widgets\ActiveForm */


$deleteRestore = file_get_contents('js/modules/references/regions/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

$toggleSearch = file_get_contents('js/modules/references/regions/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="regions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>

    </div>

    <div class="form-group col-md-9">
        <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
            if(Yii::$app->user->can('admin')){
                echo Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']);
                echo '&nbsp';
                echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
                echo '&nbsp';
                echo Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']);
            }
        ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::button(Yii::t('app', '{icon} EXCEL_OPERATIONS', ['icon' => FA::icon('file-excel-o')]), ['class' => 'btn-link btn-sm', 'id' => 'excelOperations']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="col-sm-12 bs-callout bs-callout-info" id="excel" style="display: none">
 
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
            <?= Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('upload')]), ['upload'], ['class' => 'btn btn-link btn-sm']) ?>
            <?php // echo Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['import'], ['class' => 'btn btn-link btn-sm']) ?>
            <?= Html::a(Yii::t('app', '{icon} EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-link btn-sm']) ?>
        </div>
    </div>

</div>
