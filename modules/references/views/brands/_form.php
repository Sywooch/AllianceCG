<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput(); ?>

    <?php 
    	if(isset($model->brand_logo) && !empty($model->brand_logo) && file_exists($model->brand_logo)) {
    		echo Html::img('@web/'.$model->brand_logo,["width"=>"50"]);
    		echo "<br/><br/>";
    	}
    ?>

    <?php // echo $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-car"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'brand' )]) ?>

    <?php // $form->field($model, 'brand_logo')->textInput() ?>


    <?php // echo $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-file-text"></i> </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
