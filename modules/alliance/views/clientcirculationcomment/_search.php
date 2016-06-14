<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientcirculationcommentSearch */
/* @var $form yii\widgets\ActiveForm */

$toggleAdvanced = file_get_contents('js/modules/alliance/clientcirculationcomment/toggleAdvanced.js');
$this->registerJs($toggleAdvanced, View::POS_END);

?>

<div class="clientcirculationcomment-search" id="clientcirculation">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-4">

        <?php echo $form->field($model, 'comment', ['template' => '{input}{error}'])->widget(
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

    <div class="form-group col-md-6">        
        <?php echo $form->field($model, 'globalSearch', [
                'template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-search"></i> </span>{input}{error}</div>',
            ]); 
        ?>   
    </div>

    <div class="buttonpane col-md-2">
        <?php echo Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary btn-sm animlink']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
