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
    
    
    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon"> <i class="fa fa-briefcase"></i> </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) ?>

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
            $model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']),
            ['class' => $model->isNewRecord ? 'btn btn-success animlink' : 'btn btn-primary animlink']
        ) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger animlink btn-sm']) ?>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
