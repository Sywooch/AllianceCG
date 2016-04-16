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

    <?php print_r($model->getWeekDaysArray()); ?>

    <?= $form->field($model, 'week')->dropDownList($model->getWeekdaysArray()); ?>

<?php ActiveForm::end(); ?>