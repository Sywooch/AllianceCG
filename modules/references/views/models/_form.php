<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;
use app\modules\references\models\Brands;
use app\modules\references\models\Bodytypes;
use app\modules\references\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Models */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'brand_id')->textInput() ?>

    <?php
        $brands = Brands::find()->where(['<>', 'state', Brands::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'brand_id' ) . ' --',
        ];
        echo $form->field($model, 'brand_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>      

    <?= $form->field($model, 'model_name', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel( 'model_name' )]) ?>

    <?php // echo $form->field($model, 'body_type')->textInput(['maxlength' => true]) ?>

    <?php
        $bodytypes = Bodytypes::find()->where(['<>', 'state', Bodytypes::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($bodytypes,'id','body_type');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'body_type' ) . ' --',
        ];
        echo $form->field($model, 'body_type', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>         

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
