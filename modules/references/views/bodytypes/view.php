<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Bodytypes */

$this->title = $model->body_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BODY_TYPES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bodytypes-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">

        <?= Html::a(Yii::t('app', '{icon} BODY_TYPES', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?>
        <?php 
            // Html::a(FA::icon('remove') . ' ' . Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
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
            'body_type',
            'description:ntext',
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'visible' => $model->created_at != $model->updated_at ? true : false,
            ],
            [
                'attribute' => 'author',
                'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>
