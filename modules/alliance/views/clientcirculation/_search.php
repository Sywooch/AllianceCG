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
    <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    <?php
        if(Yii::$app->user->can('admin')){
            echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
            echo '&nbsp';
            echo Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']);
        }
    ?>    
    <?= Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => FA::icon('list')]), ['class' => 'btn-link', 'id' => 'advanced']) ?>    
</p>

<div class="client-circulation-search" id="clientcirculation">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-10">

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
                    'format' => 'yyyy-mm-dd'
                ]
            ]
        );
    ?>

<?php 
    //  $form->field($model, 'email', [
    //     'template' => '<div class="input-group"><span class="input-group-btn">'.
    //         '<button class="btn btn-default">Go!</button></span>{input}</div>',
    // ]);
 ?>    

<?php
// $form->field($model, 'email', [
//         'template' => '<div class="input-group">{input}<span class="input-group-btn">'.
//             Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary']).'</span></div>',
//     ]); 
?>

    </div>

    <div class="form-group col-md-2">
        <?= Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
