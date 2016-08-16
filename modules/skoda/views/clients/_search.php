<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\models\Departments;
use app\modules\skoda\models\Clients;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\ClientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>





<!-- <div class="clients-search"> -->

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h4>Фильтр</h4>
    </div>


    <div class="panel-body">
    <div class="col-md-12">

        <div class="col-md-4">

            <?php echo $form->field($model, 'clientFullName', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientFullName')]) ?>

        </div>

        <div class="col-md-4">

            <?php echo $form->field($model, 'clientPhone', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-phone"></i> </span>{input}</div>{error}'])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99',
            ])->textInput(['placeholder' => $model->getAttributeLabel( 'clientPhone' )]) ?>

        </div>

        <div class="col-md-4">

            <?php echo $form->field($model, 'clientEmail', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-inbox"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('clientEmail')]) ?>

        </div>

        <div class="col-md-6">

            <?php echo $form->field($model, 'clientDepartment', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-users"></i> </span>{input}</div>{error}'])->dropdownList(Departments::find()->select(['department_name', 'id'])->where(['state' => Departments::STATUS_ACTIVE])->andWhere(['id' => [Clients::SALES_DEPARTMENT_ID, Clients::SERVICE_DEPARTMENT_ID]])->indexBy('id')->column(), ['prompt' => $model->getAttributeLabel('clientDepartment')]) ?>

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


         <div class="form-group">
            <?= Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary animlink', 'style' => 'margin-right: 5px;']) ?>
            <?= Html::resetButton(Yii::t('app', '{icon} Reset', ['icon' => '<i class="fa fa-download"></i>']), ['class' => 'btn btn-default animlink', 'style' => 'margin-right: 5px;']) ?>
        </div>        

    </div>
    </div>
</div> <!-- Panel -->    






    <?php ActiveForm::end(); ?>

<!-- </div> -->

