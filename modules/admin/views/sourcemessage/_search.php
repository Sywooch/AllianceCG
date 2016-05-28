<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SourceMessageSearch */
/* @var $form yii\widgets\ActiveForm */


$toggleSearch = file_get_contents('js/modules/admin/sourcemessage/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="source-message-search">

    <div class="form-group buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => FA::icon('file-excel-o')]), ['class' => 'btn-link btn-sm', 'id' => 'advancedOperations']) ?>
    </div>

    <div class="col-sm-12 bs-callout bs-callout-info" id="advanced">
 
    <div class="col-sm-6">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>


        <?= $form->field($model, 'globalSearch', [
                'template' => '<div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}<span class="input-group-btn">'.
                    Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary']).'</span></div>',
            ]); 
        ?> 

        <?php ActiveForm::end(); ?>

    </div>
    <div class="col-sm-6">
        <?= Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('upload')]), ['upload'], ['class' => 'btn btn-link btn-sm']) ?>
        <?php // echo Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['import'], ['class' => 'btn btn-link btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-link btn-sm']) ?>
    </div>
    </div>






</div>



<?php
// echo Progress::widget([
//     'percent' => 65,
//     'barOptions' => ['class' => 'progress-bar-danger']
// ]);
?>