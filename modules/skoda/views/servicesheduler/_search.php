<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\ServiceshedulerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="servicesheduler-search">-->

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'options' => [
//            'class' => 'servicesheduler-search-form'
        ],        
    ]); ?>

    <?= $form->field($model, 'responsible', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('th-large') . ' </span>{input}<span class="input-group-addon"> ' . Html::submitButton(FA::icon('search') . ' ' . Yii::t('app', 'SERVICESHEDULER_SEARCH'), ['class' => 'btn-link']) . ' </span></div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'responsible' )])    ?>

    <?php ActiveForm::end(); ?>

<!--</div>-->

