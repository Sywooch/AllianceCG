<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserrolesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userroles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<?= $form->field($model, 'globalSearch', [
        'template' => '<div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}<span class="input-group-btn">'.
            Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary']).'</span></div>',
    ]); 
?> 

    <?php ActiveForm::end(); ?>


</div>
