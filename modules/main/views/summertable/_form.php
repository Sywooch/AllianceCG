<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\Summertable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="summertable-form">

    <?php $form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute('/main/summertable/validation')
        ]); 
    ?>

    <?= $form->field($model, 'model', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_color', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'discount_percent', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-percent"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput() ?>

    <?= $form->field($model, 'price', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['type' => 'number']) ?>
    
    <?= $form->field($model, 'price_discount', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'payment', [
            'template' => '<div class="col-sm-3">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-rouble"></i></span>{input}</div><div class="buttonpane">{error}</div>',
        ])->textInput(['type' => 'number']) ?>

    <div class="form-group buttonpane">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-plus"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger bnt-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
        .done(function(result) {
            if(result == 1)
            {
                $(\$form).trigger("reset");
                $(document).find('#mymodal').modal('hide');
                $.pjax.reload({container: '#testdirveRequest'});
            }else
            {
                $("#message").html(result);
            }
        }).fail(function(){
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJS($script);
?>