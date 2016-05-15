<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\models\Companies;
use app\modules\admin\models\Positions;
use app\modules\admin\models\Departments;
use app\modules\references\models\Brands;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // echo $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?php // echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?php // echo $form->field($model, 'patronimyc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronimyc', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronimyc' )]) ?>

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
            'prompt' => '-- ' . $model->getAttributeLabel( 'company_id' ) . ' --',
        ];
        echo $form->field($model, 'company_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('building') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 

    <?php
        $brands = Brands::find()->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            // 'options' => [$_GET['id'] => ['Selected'=>'selected']],
            'prompt' => '-- ' . $model->getAttributeLabel( 'brand_id' ) . ' --',
        ];
        echo $form->field($model, 'brand_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
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
        echo $form->field($model, 'department_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('bar-chart-o') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     

    <?php // echo $form->field($model, 'position_id')->textInput() ?>


    <?php // echo $form->field($model, 'position_id', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position_id' )]) ?>

    <?php
        $positions = Positions::find()->all();
    
        $items = ArrayHelper::map($positions,'id','position');
        $params = [
            // 'options' => [$_GET['id'] => ['Selected'=>'selected']],
            'prompt' => '-- ' . $model->getAttributeLabel( 'position_id' ) . ' --',
        ];
        echo $form->field($model, 'position_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>     

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>