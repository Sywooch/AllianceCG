<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin([        
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute('/skoda/clients/validation'),
        ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'clientName')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientName')]) ?>

    <?= $form->field($model, 'clientSurname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientSurname')]) ?>

    <?= $form->field($model, 'clientPatronymic')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientPatronymic')]) ?>

    <?php // echo $form->field($model, 'clientPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clientPhone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99',
    ]) ?>

    <?= $form->field($model, 'clientEmail')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientEmail')]) ?>

    <?= $form->field($model, 'clientRegion')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientRegion')]) ?>

    <?= $form->field($model, 'clientDepartment')->textInput() ?>

    <?php // echo $form->field($model, 'clientBithdayDate')->textInput() ?>

    <?php

        echo $form->field($model, 'clientBithdayDate')
                    ->label(false)
                    ->widget('kartik\date\DatePicker', [
                        'options' => ['type' => DatePicker::TYPE_INPUT, 'placeholder' => $model->getAttributeLabel('clientBithdayDate')],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'type' => DatePicker::TYPE_INPUT,
                            'todayHighlight' => true,
                            'clearButton'    => true,
                            'todayBtn' => true,
                            'autoclose' => true,
                        ]
                    ]);
    ?>    

    <?= $form->field($model, 'state')->textInput() ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <?php // echo $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                $.pjax.reload({container: '#skodaclients'});
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