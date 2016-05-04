<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\alliance\models\Creditcalendar;
use app\modules\admin\models\User;
use yii\jui\AutoComplete;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use janisto\timepicker\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditcalendar-search">
    <div class="bs-callout bs-callout-info">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <!-- <div class="col-md-3"> -->
            <?php // $form->field($model, 'author', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'author' )]) ?>
        <!-- </div> -->


        <div class="col-md-3">
            <?= $form->field($model, 'date_from', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
            'language' => 'ru',
            'mode' => 'date',
            'clientOptions' => [
                'dateFormat' => 'yy-mm-dd',
            ],
            'options' => [
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel( 'date_from' ),
            ],
        ]);
            ?>            
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'date_to', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                    'language' => 'ru',
                    'mode' => 'date',
                    'clientOptions' => [
                        'dateFormat' => 'yy-mm-dd',

                    ],
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => $model->getAttributeLabel( 'date_to' ),
                    ],
                ]);
            ?>            
        </div>

        <div class="col-md-3">
        
        </div>

        <div class="col-md-3">
            
        </div>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?php // Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>