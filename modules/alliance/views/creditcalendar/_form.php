<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use yii\jui\DatePicker;
use app\modules\admin\models\Companies;
use app\modules\alliance\models\Creditcalendar;
use app\modules\admin\models\User;
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
    
    <?= $form->field($model, 'allday')->checkbox(['label' => Module::t('module', 'CREDITCALENDAR_ALLDAY_CHECKBOX'),
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false,
            ]);
    ?>

    <?php
        echo '<br/>';

        $cm = User::findAll([
                'position' => 'Кредитный специалист',
                ]            
            );

        foreach ($cm as $key => $value) {
            $cmname = $value->name . ' ' . $value->surname;
            $value->allname = $cmname;
        }
    
        $items = ArrayHelper::map($cm,'allname','allname');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
            'disabled' => $model->getScenario() != 'createTask', 
            'inline' => false,
        ];

        echo $form->field($model, 'responsible', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->dropDownList($items,$params,['class' => 'form-control input-sm radio', 'itemOptions' => ['class' => 'radio']])
    ?> 
    
    <?php // $form->field($model, 'responsible', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['disabled' => $model->getScenario() != 'createTask', 'placeholder' => $model->getAttributeLabel( 'responsible' )]); ?>

    <?php // $form->field($model, 'dow')->checkBoxList(ArrayHelper::map(\app\modules\alliance\models\Weekdays::find()->all(), 'daynumber', 'dayname')); ?>

<!--ArrayHelper::map(Sprachen::find()->all(), 'name', 'name')-->
    
    <?= $form->field($model, 'title', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('flag') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'title' )]) ?>
    
    <?= $form->field($model, 'description', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('flag') . ' </span>{input}</div>{error}'])->textArea(['rows' => 4, 'placeholder' => $model->getAttributeLabel( 'description' )]) ?>
    
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
    
    <?= $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('check-circle-o') . ' </span>{input}</div>{error}'])->dropDownList($model->getStatusesArray()) ?>

    <?php
        if(!$model->isNewRecord){
//            echo $form->field($model, 'comment_text')->textArea(['rows' => 4, 'placeholder' => $model->getAttributeLabel( 'comment_text' )]); 
            echo $form->field($model, 'comment_text', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('comment') . ' </span>{input}</div>{error}'])->textArea(['rows' => 4, 'placeholder' => $model->getAttributeLabel( 'comment_text' )]);
        }
     ?>

    <?php ActiveForm::end(); ?>

</div>
