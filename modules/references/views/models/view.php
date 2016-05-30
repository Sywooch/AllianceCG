<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Models */

$this->title = $model->model_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MODELS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} MODELS', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php 
            // Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-link animlink',
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
            // [
            //     'attribute' => 'brand',
            //     'value' => $model->brand->brand,
            // ],
            [
                'attribute' => 'brand',
                'format'=>'raw',
                'value' => $model->getBrandslink(),
                'visible' => !empty($model->brand->brand) ? true : false,
            ],
            'model_name',
            // [
            //     'attribute' => 'bodytype',
            //     'value' => $model->bodytype->body_type,
            // ],
            [
                'attribute' => 'bodytype',
                'format'=>'raw',
                'value' => $model->getBodytypeslink(),
                'visible' => !empty($model->bodytype->body_type) ? true : false,
            ],
        ],
    ]) ?>

</div>
