<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use app\modules\alliance\Module;
use app\modules\references\models\Regions;
use app\modules\references\models\Employees;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-circulation-form">

    <div class="panel panel-default">

    <div class="panel-heading">
        <div class="buttonpane">
            <?php echo $model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']) ; ?>
        </div> <!-- buttonPane End -->
    </div> <!-- panelHeading End-->
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->field($model, 'name', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-users"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

        <?php echo $form->field($model, 'phone', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-phone"></i> </span>{input}</div>{error}'])->widget(MaskedInput::className(), [
            'mask' => '+7 (999) 999-99-99',
        ]) ?>

        <?php echo $form->field($model, 'email', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-inbox"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

        <?php
            $regions = Regions::find()->where(['<>', 'state', Regions::STATUS_BLOCKED])->all();

            $items = ArrayHelper::map($regions,'id','region_name');
            $params = [
                'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
                'prompt' => '-- ' . $model->getAttributeLabel( 'region_id' ) . ' --',
            ];
            echo $form->field($model, 'region_id', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-map"></i> </span>{input}</div>{error}'])->dropDownList($items,$params);
        ?> 
    </div> <!-- panelBody End -->

    <div class="panel-footer">
        <div class="form-group buttonpane">
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success animlinkColor' : 'btn btn-primary animlinkColor']) ?>
            <?php echo Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-sm btn-danger animlinkColor'])?>
        </div> <!-- buttonpane End -->
    </div> <!-- panelFooter End -->

        <?php ActiveForm::end(); ?>


    </div> <!-- panelEnd -->

</div>