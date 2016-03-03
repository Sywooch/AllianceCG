<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\ServiceshedulerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicesheduler-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'servicesheduler-search-form'
        ],        
    ]); ?>

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'SERVICESHEDULER_SEARCH_TITLE') ?> </h1>       

    <?php
        // $form->field($model, 'id') 
    ?>

    <?php
        // echo $form->field($model, 'date') 
    ?>


<div style="width: 250px; ">

    <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'date_from',
                'attribute2' => 'date_to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose'=>true,
                ]
            ]);        

    ?>    
</div>  <br/>    

    <?php 
        echo $form->field($model, 'responsible') 
    ?>

    <?php

        // $mc = User::find()
        //     ->where(['position' => 'Мастер-консультант'])
        //     ->all();

        // foreach ($mc as $key => $value) {
        //     $mcname = $value->name . ' ' . $value->surname;
        //     $value->allname = $mcname;
        // }        
    
        // $items = ArrayHelper::map($mc,'id','allname');
        // $params = [
        //     'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
        // ];

        // echo $form->field($model, 'responsible', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-user"></span></span>{input}'])->dropDownList($items,$params) . '</div>' 
    ?>        

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'SERVICESHEDULER_SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'SERVICESHEDULER_RESET'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
