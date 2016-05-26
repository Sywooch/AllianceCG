<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="positions-form center-block">

    <?php $form = ActiveForm::begin(); ?>
    
    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->
          
    

    <?php
        // $form->field($model, 'position')->textInput(['maxlength' => true]) 
    ?>
    
    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
            $model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('floppy-o')]) : Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]),
            ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']
        ) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => FA::icon('remove')]), ['index'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
