<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use app\modules\references\models\Brands;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="companies-form center-block"> -->
<div class="user-form center-block">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!--<h1>-->
            <?php // FA::icon('institution') . Html::encode($this->title) ?>
    <!--</h1>-->
           
    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? FA::icon('floppy-o') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']
        ) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>        
   
    <?= $form->field($model, 'company_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_name' )]) ?>
    
    <?php // echo $form->field($model, 'company_brand', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_brand' )]) ?>

    <?php
        $brands = Brands::find()->where(['<>', 'state', Brands::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'company_brand' ) . ' --',
        ];
        echo $form->field($model, 'company_brand', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('car') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 

    <?= $form->field($model, 'company_description')->widget(TinyMce::className(), [
    'options' => ['rows' => 10, 'cols' => 20],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>

    <?php ActiveForm::end(); ?>

</div>
