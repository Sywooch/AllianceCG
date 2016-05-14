<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;
use app\modules\references\models\Brands;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Models */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'brand_id')->textInput() ?>

    <?php
        $brands = Brands::find()->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'brand_id' ) . ' --',
        ];
        echo $form->field($model, 'brand_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>      

    <?= $form->field($model, 'model_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
