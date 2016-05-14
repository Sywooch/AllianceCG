<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\references\Module;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\BodytypesSearch */
/* @var $form yii\widgets\ActiveForm */

$multipleDelete = file_get_contents('js/modules/references/bodytypes/deleteRestore.js');
$this->registerJs($multipleDelete, View::POS_END);

?>

<div class="bodytypes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-4">

        <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>

    </div>

    <div class="col-md-8">

    <div class="form-group">
        <?= Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
            if(Yii::$app->user->can('admin')){
                echo Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']);
                echo '&nbsp';
                echo Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
                echo '&nbsp';
                echo Html::a(FA::icon('upload') . ' ' . Module::t('module', 'RESTORE'), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']);
            }
        ?>        
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
