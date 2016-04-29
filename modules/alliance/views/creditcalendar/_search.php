<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\alliance\models\Creditcalendar;
use yii\jui\AutoComplete;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;

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



    <?php
        $statusItems = Creditcalendar::getStatusesArray();
        $statusParams = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'status' ) . ' --',
        ];
        $priorityItems = Creditcalendar::getPrioritiesArray();
        $priorityParams = [
            'prompt' => '-- ' . $model->getAttributeLabel('priority') . ' --',
        ];
    ?>
        <div class="col-md-3">
            <?= $form->field($model, 'priority', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('balance-scale') . ' </span>{input}</div>{error}'])->dropDownList($priorityItems, $priorityParams) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('check') . ' </span>{input}</div>{error}'])->dropDownList($statusItems, $statusParams) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'title', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('bookmark') . ' </span>{input}</div>{error}'])->widget(
                    AutoComplete::className(), [
                    'clientOptions' => [
                        'source' => $model->titleautocomplete(),
                    ],
                    'options'=>[
                        'class'=>'form-control',
                        'placeholder' => $model->getAttributeLabel('title'),
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'author', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'author' )]) ?>
        </div>

    <?php // echo $form->field($model, 'location', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->dropDownList($items,$params); ?>

    <?php // $form->field($model, 'globalSearch') ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'title') ?>

    <?php // $form->field($model, 'date_from') ?>

    <?php // $form->field($model, 'time_from') ?>

    <?php // $form->field($model, 'date_to') ?>

    <?php // echo $form->field($model, 'time_to') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'allday') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'private') ?>

    <?php // echo $form->field($model, 'calendar_type') ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?php // Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>