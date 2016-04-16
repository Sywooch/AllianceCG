<?php
use yii\helpers\Html;
use app\modules\alliance\models\Creditcalendar;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // print_r($model->getWeekDaysArray()); ?>

    <?= $form->field($model, 'week')->checkBoxList($model->getWeekdaysArray()); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create', ['class' => 'btn btn-primary'])) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php
    $weekdays = [
        '0' => 'пн',
        '1' => 'вт',
        '2' => 'ср',
        '3' => 'чт',
        '4' => 'пт',
        '5' => 'сб',
        '6' => 'вс',
    ];
    $comma_separated = implode(",", array_keys($weekdays));
    echo '[' . $comma_separated . ']';

?>