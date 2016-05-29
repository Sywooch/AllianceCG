<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
// use janisto\timepicker\TimePicker;
// use yii\jui\DatePicker;
use app\modules\admin\models\User;
use app\modules\references\models\Companies;
use kartik\time\TimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="creditcalendar-form">

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

            <?php 
            // $form->field($model, 'date_from', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
            //          'language' => 'ru',
            //          'mode' => 'date',
            //          'clientOptions' => [
            //              'dateFormat' => 'yy-mm-dd',

            //          ],
            //          'options' => [
            //              'class' => 'form-control picker',
            //              'placeholder' => $model->getAttributeLabel( 'date_from' ),
            //          ],
            //      ]);
            ?>

            <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_from',
                    // 'type' => DatePicker::TYPE_BUTTON,
                    'options' => ['placeholder' => $model->getAttributeLabel( 'date_from' )],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        // 'format' => 'yyyy-MM-dd',
                        'todayHighlight' => true
                    ]
                ]);
            ?>            

        </div>

        <div class="col-sm-3">

            <?php 
                // $form->field($model, 'time_from', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
                //      'language' => 'ru',
                //      'mode' => 'time',
                //      'clientOptions' => [
                //         'timeFormat' => 'HH:mm:ss',
                //         'showSecond' => false,    
                //         'timeInput' => true,
                //         'controlType' => 'select',
                //         ],
                //      'options' => [
                //          'class' => 'form-control picker',
                //          'placeholder' => $model->getAttributeLabel( 'time_from' ),
                //      ],
                //  ]);
            ?>

            <?= TimePicker::widget([
                        'model' => $model,
                        'attribute' => 'time_from',
                        'addonOptions' => [
                            'asButton' => false,
                        ],
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                            'minuteStep' => 1,
                            'secondStep' => 5,
                        ]
                    ]);            
            ?>            

        </div>

        <div class="col-sm-3">

            <?php 
            // $form->field($model, 'time_to', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
            //          'language' => 'ru',
            //          'mode' => 'time',
            //          'clientOptions' => [
            //             'timeFormat' => 'HH:mm:ss',
            //             'showSecond' => false,    
            //             'timeInput' => true,
            //             'controlType' => 'select',
            //             ],
            //          'options' => [
            //              'class' => 'form-control',
            //              'placeholder' => $model->getAttributeLabel( 'time_to' ),
            //          ],
            //      ]);
            ?>

            <?= TimePicker::widget([
                        'model' => $model,
                        'attribute' => 'time_to',
                        'addonOptions' => [
                            'asButton' => false,
                        ],
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                            'minuteStep' => 1,
                            'secondStep' => 5,
                        ]
                    ]);            
            ?>               

        </div>

        <div class="col-sm-3">

            <?php 
            // $form->field($model, 'date_to', ['template' => '{input}{error}{hint}'])->widget(TimePicker::className(), [
            //          'language' => 'ru',
            //          'mode' => 'date',
            //          'clientOptions' => [
            //              'dateFormat' => 'yy-mm-dd',

            //          ],
            //          'options' => [
            //              'class' => 'form-control',
            //              'placeholder' => $model->getAttributeLabel( 'date_to' ),
            //          ],
            //      ]);
            ?>    


            <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to',
                    // 'type' => DatePicker::TYPE_BUTTON,
                    'options' => ['placeholder' => $model->getAttributeLabel( 'date_to' )],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        // 'format' => 'yyyy-MM-dd',
                        'todayHighlight' => true
                    ]
                ]);
            ?>                  

        </div>

    </div>

    <div class="row" style="margin-bottom: 8px">
        <div class="col-sm-6" style="text-align: right;">
            <?= $form->field($model, 'allday')->checkbox(
                [
                    'label' => Yii::t('app', '{icon} CREDITCALENDAR_ALLDAY_CHECKBOX', ['icon' => '<i class="fa fa-retweet"></i>']),
                ]);
            ?>
        </div>
        <div class="col-sm-6" style="text-align: left;">
            <?php
                // if(Yii::$app->user->can('privateCreditcalendarPost')){
                    echo $form->field($model, 'private')->checkbox(
                            [
                                'label' => Yii::t('app', '{icon} CREDITCALENDAR_PRIVATE_CHECKBOX', ['icon' => '<i class="fa fa-lock"></i>']),
                                'disabled' => Yii::$app->user->can('creditmanager'),
                            ]);
                // }
            ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 8px">

        <?= $form->field($model, 'title', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-bookmark"></i> </span>{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('title')]) ?>

        <?= $form->field($model, 'description', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-file-text"></i> </span>{input}</div>{error}'])->textarea(['rows' => 4, 'placeholder' => $model->getAttributeLabel('description')]) ?>
    </div>

    <div class="row" style="margin-bottom: 8px">

        <div class="col-sm-6">

            <?= $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-check"></i> </span>{input}</div>{error}'])->dropDownList($model->getStatusesArray()) ?>

        </div>

        <div class="col-sm-6">

            <?= $form->field($model, 'priority', ['template'=>'<div class="input-group"><span class="input-group-addon"> <i class="fa fa-balance-scale"></i> </span>{input}</div>{error}'])->dropDownList($model->getPrioritiesArray()) ?>

        </div>

    </div>

<?php if(!Yii::$app->user->can('creditmanager')) { ?>

    <div class="row" style="margin-bottom: 8px">
        <div class="col-sm-6">

            <?= $form->field($model, 'userids', ['template' => '<i class="fa fa-users"></i> {label}{input}'])->checkboxList(User::find()->select(['full_name', 'id'])->where(['role' => 'creditmanager'])->andWhere(['status' => 1])->indexBy('id')->column(), ['id' => 'respid']) ?>

            <a href="#" onclick="checkByParent('respid', true); return false;"><?= Yii::t('app', '{icon} CHECK_ALL', ['icon' => '<i class="fa fa-check-square"></i>']) ?></a>
            /
            <a href="#" onclick="checkByParent('respid', false); return false;"><?= Yii::t('app', '{icon} UNCHECK_ALL', ['icon' => '<i class="fa fa-close"></i>']) ?></a>
     
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'locationids', ['template' => '<i class="fa fa-building"></i> {label}{input}'])->checkboxList(Companies::find()->select(['company_name', 'id'])->indexBy('id')->column(), ['id' => 'locid']) ?>
        
            <a href="#" onclick="checkByParent('locid', true); return false;"><?= Yii::t('app', '{icon} CHECK_ALL', ['icon' => '<i class="fa fa-check-square"></i>']) ?></a>
            /
            <a href="#" onclick="checkByParent('locid', false); return false;"><?= Yii::t('app', '{icon} UNCHECK_ALL', ['icon' => '<i class="fa fa-close"></i>']) ?></a>

        </div>
    </div>

<?php } ?>

        <div class="form-group" style="text-align: right; margin-top: 30;">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']) : Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['class' => $model->isNewRecord ? 'btn btn-success btn-menu animlink' : 'btn btn-primary btn-menu']) ?>
            <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), 'index', ['class' => 'btn btn-danger btn-menu btn-sm']) ?>
        </div>
</div>

    <?php ActiveForm::end(); ?>
