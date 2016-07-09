<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\models\Employees;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Dutylist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dutylist-form">

    <?php 
        $form = ActiveForm::begin([        
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute('/alliance/dutylist/validation'),
        ]); 
    ?>

    <?php // echo $form->field($model, 'employee_id')->textInput() ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php
            echo $model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']);
        ?>
    </div>
    <div class="panel-body">

        <?= $form->errorSummary($model); ?>

        <div class="col-md-6">

        <?php

            echo $form->field($model, 'date')
                        ->label(false)
                        ->widget('kartik\date\DatePicker', [
                            'options' => ['type' => DatePicker::TYPE_INPUT, 'placeholder' => $model->getAttributeLabel('date')],
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

        </div>

        <div class="col-md-6">

        <?php
            $Employees = Employees::find()
                ->where(
                        ['<>', 'state', Employees::STATUS_BLOCKED]
                    )
                ->andWhere(
                        ['duty_status' => 1]
                    )
                ->all()
                ;
        
            foreach ($Employees as $key => $value) {
                $dutyName = $value->name . ' ' . $value->surname;
                $value->name = $dutyName;
            }


            $items = ArrayHelper::map($Employees,'id','name');
            $params = [
                'prompt' => '-- ' . $model->getAttributeLabel( 'employee_id' ) . ' --',
            ];
            echo $form->field($model, 'employee_id', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-briefcase"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
        ?>        

        </div>    

    </div>

    <div class="panel-footer">
    
        <div class="form-group buttonpane">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success animlink' : 'btn btn-primary animlink']) ?>
            <?php echo Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), '/alliance/dutylist/index', ['class' => 'btn btn-danger btn-sm animlink']); ?>
        </div>

    </div>
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
                $.pjax.reload({container: '#dutylist'});
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