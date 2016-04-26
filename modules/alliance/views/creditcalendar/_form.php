<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use janisto\timepicker\TimePicker;
use app\modules\alliance\Module;
use yii\jui\DatePicker;
use app\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditcalendar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'date_from')->textInput() ?>

    <?php // $form->field($model, 'time_from')->textInput() ?>

    <?php // $form->field($model, 'date_to')->textInput() ?>

    <?php // $form->field($model, 'time_to')->textInput() ?>

<div class="col-sm-6">
        
    <div class="col-sm-7">
        
        <?=  TimePicker::widget([
                'model' => $model,
                'attribute' => 'date_from',
                'template' => '{input}',
                'language' => 'ru',
                'mode' => 'date',
                'clientOptions'=>[
                    'dateFormat' => 'yy-mm-dd',
                    'showSecond' => false,                
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel( 'date_from' ),
                ],
            ]);
        ?>
        
    </div>
    
    <div class="col-sm-5">
        
        <?=  TimePicker::widget([
                'model' => $model,
                'attribute' => 'time_from',
                'template' => '{input}',
                'language' => 'ru',
                'mode' => 'time',
                'clientOptions'=>[
                    'timeFormat' => 'HH:mm:ss',
                    'showSecond' => false,    
                    'timeInput' => true,
                    'controlType' => 'select',
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel( 'time_from' ),
                ],
            ]);
        ?>
        
    </div>

    </div>
    
    <div class="col-sm-6">

    <div class="col-sm-5">
        
        <?=  TimePicker::widget([
                'model' => $model,
                'attribute' => 'time_to',
                'template' => '{input}',
                'language' => 'ru',
                'mode' => 'time',
                'clientOptions'=>[
                    'timeFormat' => 'HH:mm:ss',
                    'showSecond' => false,     
                    'timeInput' => true,                  
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel( 'time_to' ),
                ],
            ]);
        ?>
        
    </div>
    
    <div class="col-sm-7">
        
        <?=  TimePicker::widget([
                'model' => $model,
                'attribute' => 'date_to',
                'template' => '{input}',
                'language' => 'ru',
                'mode' => 'date',
                'clientOptions'=>[
                    'dateFormat' => 'yy-mm-dd',
                    'showSecond' => false,                    
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel( 'date_to' ),
                ],
            ]);
        ?>
        
    </div>

    </div>
    
    <br/><br/><br/>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'useridArray')->checkboxList(User::find()->select(['full_name', 'id'])->where(['position' => 'Кредитный специалист'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'allday')->textInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?php // $form->field($model, 'private')->textInput() ?>

    <?php // $form->field($model, 'calendar_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
