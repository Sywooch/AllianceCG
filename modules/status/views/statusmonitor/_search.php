<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use app\modules\admin\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\status\Module;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\modules\status\models\StatusmonitorSearch */
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

    <?php

        // $mcs = Statusmonitor::find()->all();

        $mc = User::find()
            ->where(['position' => 'Мастер-консультант'])
            ->all();

        foreach ($mc as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->allname = $mcname;
        }        
    
        $items = ArrayHelper::map($mc,'id','allname');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
        ];

        // echo $form->field($model, 'responsible')->dropDownList($items,$params)
    ?> 

    <?= $form->field($model, 'responsible', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-user"></span></span>{input}'])->dropDownList($items,$params) . '</div>' ?>    

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'STATUS_SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'STATUS_RESET'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
