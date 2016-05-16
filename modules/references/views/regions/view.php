<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Regions */

$this->title = $model->id; 
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right;">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'REGIONS'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
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
            'region_name',
            'region_code',
            // 'state',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'visible' => true,
            ],
            // 'updated_at',
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'visible' => $model->created_at == $model->updated_at ? false : true,
            ],
            // 'author',
            [
                'attribute' => 'authorname',
                'value' => $model->authorname->full_name,
            ],
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),
            ],
        ],
    ]) ?>

</div>
