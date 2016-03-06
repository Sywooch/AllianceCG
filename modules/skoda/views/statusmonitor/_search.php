<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\admin\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\skoda\Module;
use yii\jui\AutoComplete;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\StatusmonitorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'user-search-form'
        ],        
    ]); ?>

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'STATUS_SEARCH_TITLE') ?> </h1>    


    <?= $form->field($model, 'regnumber', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-calendar"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'regnumber' )]) . '</div>' ?>  


<div style="width: 250px; ">

    <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'from',
                'attribute2' => 'to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose'=>true,
                ]
            ]);        

    ?>    
</div>  <br/>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'STATUS_SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'STATUS_RESET'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
