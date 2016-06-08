<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculationSearch */
/* @var $form yii\widgets\ActiveForm */

$toggleAdvanced = file_get_contents('js/modules/alliance/clientcirculation/toggleAdvanced.js');
$this->registerJs($toggleAdvanced, View::POS_END);

?>

<p class="buttonpane">
    <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-link animlink']) ?>
    <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-link animlink']) ?>
    <?php
        if(Yii::$app->user->can('admin')){
            echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']);
            echo '&nbsp';
            echo Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleRestore']);
        }
    ?>    
    <?= Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => FA::icon('list')]), ['class' => 'btn-link animlink', 'id' => 'advanced']) ?>    
</p>

<div class="client-circulation-search" id="clientcirculation">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-4">

        <?= $form->field($model, 'comment', ['template' => '{input}{error}'])->widget(
            DatePicker::className(), [
                    'inline' => false, 
                    'language' => 'ru',
                    'size' => 'ms',
                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'template' => '{addon}{input}',
                    'options' => ['placeholder' => $model->getAttributeLabel('comment')],
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]
            );
        ?>

    </div>

    <div class="form-group col-md-8">        
        <?= $form->field($model, 'globalSearch', [
                'template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-search"></i> </span>{input}{error}</div>',
            ]); 
        ?>   
    </div>

    <div class="buttonpane col-md-12">
        <?= Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm animlink']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
