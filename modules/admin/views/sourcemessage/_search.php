<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SourceMessageSearch */
/* @var $form yii\widgets\ActiveForm */

$toggleSearch = file_get_contents('js/modules/admin/sourcemessage/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="source-message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-4">
        <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    </div>

    <div class="col-sm-8">

    <div class="form-group buttonpane">
        <?= Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::button(Yii::t('app', '{icon} EXCEL_OPERATIONS', ['icon' => FA::icon('file-excel-o')]), ['class' => 'btn-link btn-sm', 'id' => 'excelOperations']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    <div class="col-sm-12 bs-callout bs-callout-info" id="excel" style="display: true">
 
        <div class="col-sm-6">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['upload'],
                'options' => [
                        'enctype' => 'multipart/form-data']
                    ]) 
            ?>
            <div class="col-sm-6">
               <?= $form->field($model, 'xlsxFile', ['template' => '{input}{error}'])->fileInput(); ?>
            </div>
            <div class="col-sm-6">    
               <?php // echo Html::submitButton(Yii::t('app', '{icon} Upload', ['icon' => FA::icon('upload')]), ['class' => 'btn btn-primary btn-sm']) ?>
               <?= Html::submitButton(Yii::t('app', '{icon} Upload', ['icon' => FA::icon('upload')]), ['value' => Url::to(['upload']), 'class' => 'btn btn-primary btn-sm']);
               ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['import'], ['class' => 'btn btn-link btn-sm']) ?>
            <?= Html::a(Yii::t('app', '{icon} EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-link btn-sm']) ?>
        </div>
    </div>


    <div class="col-lg-12 alert alert-danger">
        <?= Yii::t('app', 'MESSAGE_TRANSLATION_INFO') ?>
    </div>
    