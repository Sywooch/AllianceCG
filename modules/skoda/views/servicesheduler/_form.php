<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use app\modules\user\models\User as UserName;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="user-form center-block"> -->
<div>

    <?php $form = ActiveForm::begin(); ?>


    <h1><span class="glyphicon glyphicon-piggy-bank" style='padding-right:10px;'></span><?= $model->isNewRecord ? Module::t('module', 'STATUS_CREATE') : Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->date; ?></h1>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'STATUS_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/servicesheduler'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php 
        echo $form->field($model, 'date', ['template' => "{input}\n{hint}\n{error}"])->widget(DatePicker::classname(),[
              'options' => ['placeholder' => $model->getAttributeLabel( 'date' )],
              'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => TRUE,
            ],
            ]);    
            
        echo '<br/>';

        $mc = User::findAll([
                'position' => 'Мастер-консультант',
                ]            
            );

        foreach ($mc as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->allname = $mcname;
        }
    
        $items = ArrayHelper::map($mc,'allname','allname');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
            'inline' => false,
        ];

        echo $form->field($model, 'responsible', ['template'=>' {input}{error}'])->radioList($items,$params,['class' => 'form-control input-sm radio', 'itemOptions' => ['class' => 'radio']])
    ?> 

    <?php ActiveForm::end(); ?>

</div>
