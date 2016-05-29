<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
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
                
   
    <?= $form->field($model, 'company_name', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-institution"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_name' )]) ?>
    
    <?php // echo $form->field($model, 'company_brand', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'company_brand' )]) ?>

    <?php
        $brands = Brands::find()->where(['<>', 'state', Brands::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($brands,'id','brand');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'company_brand' ) . ' --',
        ];
        echo $form->field($model, 'company_brand', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-car"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
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

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>  
    

    <?php ActiveForm::end(); ?>

</div>
