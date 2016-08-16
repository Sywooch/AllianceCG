<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Departments;
use app\modules\skoda\models\Clients;

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

    <?= $form->field($model, 'clientSurname', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientSurname')]) ?>

    <?= $form->field($model, 'clientName', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientName')]) ?>

    <?= $form->field($model, 'clientPatronymic', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientPatronymic')]) ?>

    <?= $form->field($model, 'clientRegion', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientRegion')]) ?>

    <div class="col-md-12">

        <div class="col-md-6">

            <?= $form->field($model, 'clientPhone', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-phone"></i> </span>{input}</div>{error}'])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99',
            ])->textInput(['placeholder' => $model->getAttributeLabel( 'clientPhone' )]) ?>

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'clientEmail', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-inbox"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientEmail')]) ?>

        </div>

    </div>

    <div class="col-md-12">

        <div class="col-md-6">

            <?= $form->field($model, 'clientDepartment', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-users"></i> </span>{input}</div>{error}'])->dropdownList(Departments::find()->select(['department_name', 'id'])->where(['state' => Departments::STATUS_ACTIVE])->andWhere(['id' => [Clients::SALES_DEPARTMENT_ID, Clients::SERVICE_DEPARTMENT_ID]])->indexBy('id')->column(), ['prompt' => $model->getAttributeLabel('clientDepartment')]) ?>

        </div>

        <div class="col-md-6">

            <?php

                echo $form->field($model, 'clientBithdayDate')
                   ->label(false)
                   ->widget('kartik\date\DatePicker', [
                       'options' => ['type' => DatePicker::TYPE_INPUT, 'placeholder' => $model->getAttributeLabel('clientBithdayDate')],
                       'pluginOptions' => [
                           'format' => 'yyyy-mm-dd',
                           // 'format' => 'dd/mm/yyyy',
                           'type' => DatePicker::TYPE_INPUT,
                           'todayHighlight' => true,
                           'clearButton'    => true,
                           'todayBtn' => true,
                           'autoclose' => true,
                       ]
                   ]);
            ?>    

        </div>

    </div>

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