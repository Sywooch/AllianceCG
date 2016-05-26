<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Regions */

$this->title = $model->region_name; 
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right;">
        <?= Html::a(Yii::t('app', '{icon} REGIONS', ['icon' => FA::icon('list')]), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
         echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Yii::t('app', 'CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) 
        ?>
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
