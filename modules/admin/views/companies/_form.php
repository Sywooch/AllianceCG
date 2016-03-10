<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="companies-form center-block"> -->
<div class="user-form center-block">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <h1><span class="glyphicon glyphicon-tent" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
           
    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'ADMIN_CREATE_POSITIONS') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'ADMIN_POSITIONS_BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'ADMIN_POSITIONS_BUTTON_CANCEL'), ['/admin/companies'], ['class' => 'btn btn-danger']) ?>
    </div>        

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_brand')->textInput(['maxlength' => true]) ?>

    <?php
        // $form->field($model, 'company_logo')->textInput(['maxlength' => true]) 
    ?>

    <?= $form->field($model, 'brandlogo')->fileInput() ?>

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

    <div class="form-group">
        <?php Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
