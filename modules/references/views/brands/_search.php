<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\BrandsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    </div>

    <div class="form-group col-md-6" style="text-align: right">
        <?= Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
