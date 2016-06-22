<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

<?php echo $form->field($model, 'name', [
        'template' => '<div class="col-sm-3 buttonpane">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-user"></i></span>{input}{error}</div>',
            // '<span class="input-group-addon">Ф.И.О.</span></div>',
    ])->textInput() ?>

<?php // echo $form->field($model, 'phone')->textInput() ?>

<!-- <br /><br /> -->

<?php 
	echo $form->field($model, 'phone', [
        	'template' => '<div class="col-sm-3 buttonpane">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-phone"></i></span>{input}{error}</div>',
            // '<span class="input-group-addon">Тел.</span></div>',
    	])->widget(\yii\widgets\MaskedInput::className(), [
    		'mask' => '+7 (999) 999-99-99',
	])
?>

<?php echo $form->field($model, 'selectedcar', [
        'template' => '<div class="col-sm-3 buttonpane">{label}</div><div class="input-group col-sm-9"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}{error}</div>',
            // '<span class="input-group-addon">А/М</span></div>',
    ])->textInput(['readonly' => true]) ?>


    <div class="form-group buttonpane">
        <?= Html::submitButton(Yii::t('app', '{icon} TESTDRIVEREQUEST', ['icon' => '<i class="fa fa-send"></i>']), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>    

<?php ActiveForm::end(); ?>

<?php

$script2 = <<< JS

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
$this->registerJS($script2);
?>