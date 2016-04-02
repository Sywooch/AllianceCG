<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(
        [
            // 'action' => '/action',
//            'method'=>'get',
            'options' => [
                'id' => 'Skoda_calendar',
             ]
        ]); 
    ?>

    <h1><?= $model->isNewRecord ? FA::icon('bed') .' '. Module::t('module', 'STATUS_CREATE') : FA::icon('bed') .' '. Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->date; ?></h1>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'STATUS_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/servicesheduler/calendar'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model,'date', ['template' => '{input}{error}'])->widget(DatePicker::className(),['options' => ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel( 'date' )]]) ?>

    <?php
        echo '<br/>';

        $mc = User::findAll([
                'position' => 'Мастер-консультант',
                ]            
            );

        foreach ($mc as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->allname = $mcname;
        }
    
        $items = ArrayHelper::map($mc,'allname','allname');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
            'inline' => false,
        ];

        echo $form->field($model, 'responsible', ['template'=>' {input}{error}'])->dropDownList($items,$params,['class' => 'form-control input-sm radio', 'itemOptions' => ['class' => 'radio']])
    ?> 

    <?php ActiveForm::end(); ?>
    
</div>
<!-- </div> -->