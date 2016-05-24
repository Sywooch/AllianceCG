<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\admin\models\User;
use app\modules\user\models\User as UserName;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="user-form center-block"> -->
<div>

    <div class="input-group center-block" style="width: 60%;">
        
    <?php $form = ActiveForm::begin(); ?>

    <h1><?php $model->isNewRecord ? Yii::t('app', '{icon} STATUS_CREATE_RN', ['icon' => FA::icon('car')]) : Yii::t('app', 'STATUS_UPDATE_RN', ['icon' => FA::icon('car')]) . ' ' . $model->regnumber; ?></h1>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'regnumber', ['template'=>' {label}<div class="input-group"><span class="input-group-addon">'. FA::icon('car') . '</span>{input}</div>{error}'] )->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'a999aa/99[9][ RUS]',]) ?>       
    
    <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'from',
            'options' => ['placeholder' => $model->getAttributeLabel( 'from' )],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true
            ]
        ]);
    ?>

<br/>

    <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'to',
            'options' => ['placeholder' => $model->getAttributeLabel( 'to' )],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true
            ]
        ]);
    ?>

    <div class="form-group" style="text-align: right; margin-top: 15px;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} STATUS_CREATE', ['icon' => FA::icon('floppy-o')]) : Yii::t('app', '{icon} STATUS_UPDATE', ['icon' => FA::icon('edit')]), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} BUTTON_CANCEL', ['icon' => FA::icon('remove')]), ['/skoda/statusmonitor/calendar'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
</div>    