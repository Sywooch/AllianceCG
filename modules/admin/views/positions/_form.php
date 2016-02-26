<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="positions-form center-block">

    <?php $form = ActiveForm::begin(); ?>
    
    <h1><span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
           
    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Yii::t('app', 'BUTTON_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Yii::t('app', 'BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Yii::t('app', 'BUTTON_CANCEL'), ['/admin/positions'], ['class' => 'btn btn-danger']) ?>
    </div>    
    

    <?php
        // $form->field($model, 'position')->textInput(['maxlength' => true]) 
    ?>
    
    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?php 
    // $form->field($model, 'description')->widget(TinyMce::className(), [
    // 'options' => ['rows' => 6],
    // 'language' => 'ru',
    // 'clientOptions' => [
    //     'plugins' => [
    //         "advlist autolink lists link charmap print preview anchor",
    //         "searchreplace visualblocks code fullscreen",
    //         "insertdatetime media table contextmenu paste"
    //     ],
    //     'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    // ]
    // ]);
    ?>

    <div class="form-group">
        <?php 
            // Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) 
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
