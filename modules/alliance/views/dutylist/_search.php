<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\DutylistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dutylist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'globalSearch', [
            'template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-search"></i> </span>{input}<span class="input-group-btn">'.
                Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary animlink']).'</span></div>',
        ]); 
    ?>     

    <?php ActiveForm::end(); ?>

</div>
