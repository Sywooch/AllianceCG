<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\ContactTypeSearch */
/* @var $form yii\widgets\ActiveForm */

$deleteRestore = file_get_contents('js/modules/references/contacttypes/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

?>

<div class="contact-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-4">
        <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    </div>

    <div class="col-sm-8">

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>
        <?php // echo Html::a(Yii::t('app', 'CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>
        <?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']) ?>

    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
