<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\alliance\models\Creditcalendar;
use app\modules\admin\models\User;
// use yii\jui\AutoComplete;
// use kartik\date\DatePicker;
use yii\jui\DatePicker;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarSearch */
/* @var $form yii\widgets\ActiveForm */

$ExportExcel = file_get_contents('js/modules/alliance/creditcalendar/gridViewExcelExport.js');
$this->registerJs($ExportExcel, View::POS_END);

?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

            <div class="col-md-12" style="margin: 10px">

            <div class="col-md-5">

                <?php 
                    echo $form->field($model, 'date_from', ['template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>{input}</span></div>{error}'])->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd', 'options'=>['placeholder' => $model->getAttributeLabel('date_from'), 'class'=>'form-control'], 'clientOptions' => ['changeYear' => true, 'yearRange' => '-2:+2', 'changeMonth' => true, 'showButtonPanel' => true]]) 
                ?>
            </div> <!-- col-md-5 -->

            <div class="col-md-5">

                <?php 
                    echo $form->field($model, 'date_to', ['template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>{input}</span></div>{error}'])->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd','options'=>['placeholder' => $model->getAttributeLabel('date_to'), 'class'=>'form-control'], 'clientOptions' => ['changeYear' => true, 'yearRange' => '-2:+2', 'changeMonth' => true, 'showButtonPanel' => true]]) 
                ?>

            </div> <!-- col-md-5 -->

        <div class="form-group buttonpane col-md-2">
            <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary btn-sm animlink']) ?>
        </div> <!-- col-md-2 -->
        
        </div> <!-- col-md-12 -->

    <?php ActiveForm::end(); ?>