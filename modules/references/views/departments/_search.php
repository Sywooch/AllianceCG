<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DepartmentsSearch */
/* @var $form yii\widgets\ActiveForm */

$deleteResotre = file_get_contents('js/modules/references/departments/deleteRestore.js');
$this->registerJs($deleteResotre, View::POS_END);

?>

<div class="departments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-4">
    <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    </div>

    <div class="form-group col-sm-8" style="text-align: right">
        <?= Html::submitButton(FA::icon('search') . ' ' . Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary btn-sm']) ?>

        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']); ?>
           
        <?= Html::a(FA::icon('upload') . ' ' . Module::t('module', 'RESTORE'), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']);
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
