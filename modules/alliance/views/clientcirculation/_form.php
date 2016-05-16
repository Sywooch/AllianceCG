<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use app\modules\alliance\Module;
use app\modules\references\models\Regions;
use app\modules\references\models\Employees;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-circulation-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('users') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?php // echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('phone') . ' </span>{input}</div>{error}'])->widget(MaskedInput::className(), [
        'mask' => '+7(999)999-99-99',
    ]) ?>

    <?= $form->field($model, 'email', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('inbox') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

    <?php // echo $form->field($model, 'region_id')->textInput() ?>


    <?php
        $regions = Regions::find()->where(['<>', 'state', Regions::STATUS_BLOCKED])->all();
        // $regions = Regions::find()->all();
    
        $items = ArrayHelper::map($regions,'id','region_name');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'region_id' ) . ' --',
        ];
        echo $form->field($model, 'region_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('map') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 


    <?php
        $employees = Employees::find()->where(['<>', 'state', Employees::STATUS_BLOCKED])->all();
        // $regions = Regions::find()->all();
        // 
        // foreach ($employees as $arr) {
        //     $arr->merge_employees = $arr->name . ' ' . $arr->surname;
        // }
    
        $items = ArrayHelper::map($employees,'id','surname');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'employee_id' ) . ' --',
        ];
        echo $form->field($model, 'employee_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('map') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     


    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
