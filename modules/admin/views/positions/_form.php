<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="positions-form center-block">

    <?php $form = ActiveForm::begin(); ?>
    
    <h1><span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
           
    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'ADMIN_CREATE_POSITIONS') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'ADMIN_POSITIONS_BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'ADMIN_POSITIONS_BUTTON_CANCEL'), ['/admin/positions'], ['class' => 'btn btn-danger']) ?>
    </div>    
    

    <?php
        // $form->field($model, 'position')->textInput(['maxlength' => true]) 
    ?>
    
    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) ?>

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

    <?php ActiveForm::end(); ?>

</div>
