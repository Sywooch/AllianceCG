<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\models\Companies;
use app\modules\references\models\Positions;
use app\modules\references\models\Departments;
use app\modules\references\models\Brands;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // echo $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon">  <i class="fa fa-user"></i>  </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?php // echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon">  <i class="fa fa-user"></i>  </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?php // echo $form->field($model, 'patronimyc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronimyc', ['template'=>' <div class="input-group"><span class="input-group-addon">  <i class="fa fa-user"></i>  </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronimyc' )]) ?>

    <?php // echo $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'photo', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('camera') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'photo' )]) ?>

    <?= $form->field($model, 'file')->fileInput(); ?>

    <?php 
        if(isset($model->photo) && !empty($model->photo) && file_exists($model->photo)) {
            echo Html::img('@web/'.$model->photo,["width"=>"50"]);
            echo "<br/><br/>";
        }
    ?>

    <?php // echo $form->field($model, 'company_id')->textInput() ?>

    <?php // echo $form->field($model, 'company_id', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('building') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_id' )]) ?>

    <?php
        $companies = Companies::find()->all();
    
        $items = ArrayHelper::map($companies,'id','company_name');
        $params = [
            // 'options' => [$_GET['id'] => ['Selected'=>'selected']],
            // 'options' => [
            //     isset($_GET['orgid']) => ['Selected'=>'selected'],                
            // ],
            'prompt' => '-- ' . $model->getAttributeLabel( 'company_id' ) . ' --',
        ];
        echo $form->field($model, 'company_id', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-building"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 

    <?php
        $brands = Brands::find()->where(['<>', 'state', Brands::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'brand_id' ) . ' --',
        ];
        echo $form->field($model, 'brand_id', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-car"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 


    <?php // echo $form->field($model, 'department_id')->textInput() ?>


    <?php // echo $form->field($model, 'department_id', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('bar-chart-o') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'department_id' )]) ?>

    <?php
        $departments = Departments::find()->all();
    
        $items = ArrayHelper::map($departments,'id','department_name');
        $params = [
            // 'options' => [$_GET['id'] => ['Selected'=>'selected']],
            'prompt' => '-- ' . $model->getAttributeLabel( 'department_id' ) . ' --',
        ];
        echo $form->field($model, 'department_id', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-bar-chart-o"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     

    <?php // echo $form->field($model, 'position_id')->textInput() ?>


    <?php // echo $form->field($model, 'position_id', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position_id' )]) ?>

    <?php
        $positions = Positions::find()->where(['<>', 'state', Positions::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($positions,'id','position');
        $params = [
            'options' => [
                isset($_GET['id']) => ['Selected'=>'selected'],                
            ],
            'prompt' => '-- ' . $model->getAttributeLabel( 'position_id' ) . ' --',
        ];
        echo $form->field($model, 'position_id', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-briefcase"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    

    <?php
        echo $form->field($model, 'duty_status')
            ->checkbox([
                // 'label' => 'Неактивный чекбокс',
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);
    ?> 

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success animlinkColor' : 'btn btn-primary animlinkColor']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger animlinkColor btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
