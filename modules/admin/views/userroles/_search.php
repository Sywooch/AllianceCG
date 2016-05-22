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

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'role_description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'author') ?>

    <div class="col-md-6">

    <?php // echo  $form->field($model, 'globalSearch') ?>

    <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>

    </div>

    <div class="col-md-6">

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-12 alert alert-danger">
        <?= Yii::t('app', 'USERROLES_INFO') ?>
    </div>

</div>
