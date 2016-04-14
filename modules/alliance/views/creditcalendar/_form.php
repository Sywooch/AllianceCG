<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use yii\jui\DatePicker;
use app\modules\admin\models\Companies;
use yii\helpers\ArrayHelper;
use janisto\timepicker\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditcalendar-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>
    
    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('save') . ' ' . Module::t('module', 'CREDITCALENDAR_CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'CREDITCALENDAR_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CREDITCALENDAR_CANCEL'), ['/alliance/creditcalendar/calendar'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>    
        
    <div class="col-sm-3">
        
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
    
    <div class="col-sm-2">
        
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
    
    <div class="col-sm-2">
        <div style="text-align: center">
            <?= '-'; ?>
        </div>
    </div>
    
    <div class="col-sm-2">
        
        <?=  TimePicker::widget([
                'model' => $model,
                'attribute' => 'time_to',
                'template' => '{input}',
                'language' => 'ru',
                'mode' => 'time',
                'clientOptions'=>[
                    'timeFormat' => 'HH:mm:ss',
                    'showSecond' => false,                    
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel( 'time_to' ),
                ],
            ]);
        ?>
        
    </div>
    
    <div class="col-sm-3">
        
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
    
    <br/><br/><br/>
    
    <?= $form->field($model, 'title', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('flag') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'title' )]) ?>

    <?php // $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'date_from')->textInput() ?>

    <?php // $form->field($model, 'time_from')->textInput() ?>

    <?php // $form->field($model, 'date_to')->textInput() ?>

    <?php // $form->field($model, 'time_to')->textInput() ?>

    <?php // $form->field($model, 'description')->textarea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'description', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('flag') . ' </span>{input}</div>{error}'])->textArea(['rows' => 4, 'placeholder' => $model->getAttributeLabel( 'description' )]) ?>

    <?php // $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
    
    <?php
        $companies = Companies::find()->all();

        foreach ($companies as $arr) {
            $arr->merge_companies = $arr->company_name . ' (' . $arr->company_brand . ')';
        }
    
        $items = ArrayHelper::map($companies,'company_name','merge_companies');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'location' ) . ' --',
        ];
        echo $form->field($model, 'location', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>        

    <?= $form->field($model, 'is_task')->textInput() ?>

    <?php // $form->field($model, 'is_repeat')->textInput() ?>

    <?php // $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <!--<div class="form-group">-->
        <?php // Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <!--</div>-->

    <?php ActiveForm::end(); ?>

</div>
