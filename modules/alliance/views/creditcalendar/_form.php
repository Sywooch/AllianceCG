<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use janisto\timepicker\TimePicker;
use app\modules\alliance\Module;
use yii\jui\DatePicker;
use app\modules\admin\models\User;
use app\modules\references\models\Companies;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="creditcalendar-form" style="width: 70%; margin: auto;">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?php 
        $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/creditcalendar_checkall.js'), ['depends' => [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset'],
        ]);   
    ?>

    <div class="row" style="margin-bottom: 8px">

        <div class="col-sm-3">

            <?= $form->field($model, 'date_from', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                     'language' => 'ru',
                     'mode' => 'date',
                     'clientOptions' => [
                         'dateFormat' => 'yy-mm-dd',

                     ],
                     'options' => [
                         'class' => 'form-control picker',
                         'placeholder' => $model->getAttributeLabel( 'date_from' ),
                     ],
                 ]);
            ?>

        </div>

        <div class="col-sm-3">

            <?= $form->field($model, 'time_from', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                     'language' => 'ru',
                     'mode' => 'time',
                     'clientOptions' => [
                        'timeFormat' => 'HH:mm:ss',
                        'showSecond' => false,    
                        'timeInput' => true,
                        'controlType' => 'select',
                        ],
                     'options' => [
                         'class' => 'form-control picker',
                         'placeholder' => $model->getAttributeLabel( 'time_from' ),
                     ],
                 ]);
            ?>

        </div>

        <div class="col-sm-3">

            <?= $form->field($model, 'time_to', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                     'language' => 'ru',
                     'mode' => 'time',
                     'clientOptions' => [
                        'timeFormat' => 'HH:mm:ss',
                        'showSecond' => false,    
                        'timeInput' => true,
                        'controlType' => 'select',
                        ],
                     'options' => [
                         'class' => 'form-control',
                         'placeholder' => $model->getAttributeLabel( 'time_to' ),
                     ],
                 ]);
            ?>

        </div>

        <div class="col-sm-3">

            <?= $form->field($model, 'date_to', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                     'language' => 'ru',
                     'mode' => 'date',
                     'clientOptions' => [
                         'dateFormat' => 'yy-mm-dd',

                     ],
                     'options' => [
                         'class' => 'form-control',
                         'placeholder' => $model->getAttributeLabel( 'date_to' ),
                     ],
                 ]);
            ?>    

        </div>

    </div>

    <div class="row" style="margin-bottom: 8px">
        <div class="col-sm-6" style="text-align: right;">
            <?= $form->field($model, 'allday')->checkbox(
                [
                    'label' => Module::t('module', 'CREDITCALENDAR_ALLDAY_CHECKBOX'),
                ]);
            ?>
        </div>
        <div class="col-sm-6" style="text-align: left;">
            <?php
                // if(Yii::$app->user->can('privateCreditcalendarPost')){
                    echo $form->field($model, 'private')->checkbox(
                            [
                                'label' => Module::t('module', 'CREDITCALENDAR_PRIVATE_CHECKBOX'),
                                'disabled' => Yii::$app->user->can('creditmanager'),
                            ]);
                // }
            ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 8px">

        <?= $form->field($model, 'title', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('bookmark') . ' </span>{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('title')]) ?>

        <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('file-text') . ' </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>
    </div>

    <div class="row" style="margin-bottom: 8px">

        <div class="col-sm-6">

            <?= $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('check') . ' </span>{input}</div>{error}'])->dropDownList($model->getStatusesArray()) ?>

        </div>

        <div class="col-sm-6">

            <?= $form->field($model, 'priority', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('balance-scale') . ' </span>{input}</div>{error}'])->dropDownList($model->getPrioritiesArray()) ?>

        </div>

    </div>

<?php if(!Yii::$app->user->can('creditmanager')) { ?>

    <div class="row" style="margin-bottom: 8px">
        <div class="col-sm-6">

            <?= $form->field($model, 'userids')->checkboxList(User::find()->select(['full_name', 'id'])->where(['role' => 'creditmanager'])->andWhere(['status' => 1])->indexBy('id')->column(), ['id' => 'respid']) ?>

            <a href="#" onclick="checkByParent('respid', true); return false;"><?= Module::t('module', 'CHECK_ALL') ?></a>
            /
            <a href="#" onclick="checkByParent('respid', false); return false;"><?= Module::t('module', 'UNCHECK_ALL') ?></a>
     
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'locationids')->checkboxList(Companies::find()->select(['company_name', 'id'])->indexBy('id')->column(), ['id' => 'locid']) ?>
        
            <a href="#" onclick="checkByParent('locid', true); return false;"><?= Module::t('module', 'CHECK_ALL') ?></a>
            /
            <a href="#" onclick="checkByParent('locid', false); return false;"><?= Module::t('module', 'UNCHECK_ALL') ?></a>

        </div>
    </div>

<?php } ?>

        <div class="form-group" style="text-align: right; margin-top: 30;">
            <?= Html::submitButton($model->isNewRecord ? FA::icon('plus') . ' ' . Module::t('module', 'CREATE') : FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-menu' : 'btn btn-primary btn-menu']) ?>
            <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CANCEL'), 'index', ['class' => 'btn btn-danger btn-menu']) ?>
        </div>
</div>

    <?php ActiveForm::end(); ?>
