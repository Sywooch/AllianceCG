<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\alliance\models\Creditcalendar;
use app\modules\admin\models\User;
// use yii\jui\AutoComplete;
use kartik\date\DatePicker;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarSearch */
/* @var $form yii\widgets\ActiveForm */

$ExportExcel = file_get_contents('js/modules/alliance/creditcalendar/gridViewExcelExport.js');
$this->registerJs($ExportExcel, View::POS_END);

?>

<div class="creditcalendar-search" id="creditcalendar-search">
    <div class="bs-callout bs-callout-info">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <div class="col-md-12" style="margin: 10px">

        <div class="col-md-6">

            <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_from',
                    'options' => ['placeholder' => $model->getAttributeLabel( 'date_from' )],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'todayHighlight' => true
                    ]
                ]);
            ?>

        </div>

        <div class="col-md-6">
            <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to',
                    'options' => ['placeholder' => $model->getAttributeLabel( 'date_to' )],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'todayHighlight' => true
                    ]
                ]);
            ?>                        
        </div>
        </div>

        <div class="col-md-12" style="margin: 10px">

        <div class="col-md-6">
            <?= $form->field($model, 'priority', ['template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-hashtag"></i> </span>{input}</span></div>{error}'])->dropDownList($model->getPrioritiesArray(), ['prompt' => '-- ' . $model->getAttributeLabel( 'priority' ) . ' --',]);
            ?>         
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'status', ['template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-flag"></i> </span>{input}</span></div>{error}'])->dropDownList($model->getStatusesArray(), ['prompt' => '-- ' . $model->getAttributeLabel( 'status' ) . ' --',]);
            ?>
        </div>

        </div>

        <div class="form-group buttonpane">
            <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary btn-sm animlink']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

</div>