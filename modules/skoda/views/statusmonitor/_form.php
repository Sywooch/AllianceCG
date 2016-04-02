<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\admin\models\User;
use app\modules\user\models\User as UserName;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="user-form center-block"> -->
<div>

    <?php $form = ActiveForm::begin(); ?>

    <h1><span class="glyphicon glyphicon-piggy-bank" style='padding-right:10px;'></span><?= $model->isNewRecord ? Module::t('module', 'STATUS_CREATE_RN') : Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->regnumber; ?></h1>


    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'STATUS_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/statusmonitor'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?= $form->errorSummary($model); ?>


    <div class="input-group center-block" style="width: 60%;">
    

    <?= $form->field($model, 'regnumber')->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'a999aa/99[9][ RUS]',]) ?>       
    
    <br/><br/>

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
</div>    
<br/>

    <?php ActiveForm::end(); ?>

</div>
