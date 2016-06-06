<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
// use yii\jui\DatePicker;
use kartik\date\DatePicker;
use app\modules\references\models\Employees;
use app\modules\skoda\models\Servicesheduler;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'id' => 'Skoda_calendar',
             ]
        ]); 
    ?>

    <h1>
        <?php // echo $model->isNewRecord ? Yii::t('app', '{icon} STATUS_CREATE', ['icon' => FA::icon('bed')]) : Yii::t('app', '{icon} STATUS_UPDATE_RN', ['icon' => FA::icon)('bed')]) . ' ' . $model->date; ?>
    </h1>

    <div class="alert alert-danger">
        <?= Yii::t('app', 'ADD_SERVICESHEDULER_INFO'); ?>
    </div>

    <?= $form->errorSummary($model); ?>

    <?php // $form->field($model,'date', ['template' => '{input}{error}'])->widget(DatePicker::className(),['options' => ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel( 'date' )]]) ?>

    <?php
        echo $form->field($model, 'date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter birth date ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd',
            ]
        ]);
    ?>

    <?php

        $responsible = Employees::find()
            ->joinWith(['position', 'brand'])
            ->where([
                    '<>', '{{%employees}}.state', Employees::STATUS_BLOCKED,
                ])
            ->andwhere([
                    '{{%positions}}.position' => Employees::MASTER_CONSULTANT,
                ])
            ->andwhere([
                    '{{%brands}}.brand' => Servicesheduler::CURRENT_BRAND,
                ])
            ->all();   
    
        foreach ($responsible as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->name = $mcname;
        }


        $items = ArrayHelper::map($responsible,'id','name');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
        ];
        echo $form->field($model, 'responsible', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} STATUS_CREATE', ['icon' => '<i class="fa fa-save"></i>']) : Yii::t('app', '{icon} STATUS_UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success animlinkColor' : 'btn btn-primary animlinkColor']) ?>
        <?= Html::a(Yii::t('app', '{icon} BUTTON_CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['/skoda/servicesheduler/calendar'], ['class' => 'btn btn-danger animlinkColor btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>