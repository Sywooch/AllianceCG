<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Employees */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'EMPLOYEES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'EMPLOYEES'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['index'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' .Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' .Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'fullName',
            ],
            // 'name',
            // 'surname',
            // 'patronimyc',
            [
                'attribute' => 'photo',
                'value'=>$model->getImageUrl(),
                'format' => ['image',['width'=>'50']],
            ],
            // 'photo',
            // 'company_id',
            [
                'attribute' => 'company',
                'value' => $model->company->company_name,
            ],
            // 'department_id',
            [
                'attribute' => 'department',
                'value' => $model->department->department_name,
            ],
            // 'position_id',
            [
                'attribute' => 'position',
                'value' => $model->position->position,
            ],
        ],
    ]) ?>

</div>
