<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
        <?= Html::a(Yii::t('app', '{icon} REGIONS', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php
        //  Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-remove"></i>']), ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger btn-sm',
        //     'data' => [
        //         'confirm' => Yii::t('app', 'CONFIRM_DELETE'),
        //         'method' => 'post',
        //     ],
        // ]) 
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
