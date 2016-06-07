<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Clientcirculationcomment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientcirculationcomments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientcirculationcomment-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p class="buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CLIENTCIRCULATIONCOMMENTS', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['view', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-edit"></i>']), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-link animlink',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'clientcirculation_id',
            // 'contact_type',
            [
                'attribute' => 'clientcirculation',
                'label' => Yii::t('app', 'CLIENTNAME'),
                'value' => $model->clientcirculation->name,
            ],
            [
                'attribute' => 'contacttypes',
                'value' => $model->contacttypes->contact_type,
            ],
            // 'target',
            [
                'attribute' => 'targets',
                'value' => $model->targets->target,
            ],
            // 'car_model',
            [
                'attribute' => 'cars',
                'label' => Yii::t('app', 'CARS'),
                'value' => $model->cars->fullModelName,
            ],
            'comment:ntext',
            // 'state',
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),

            ],
            // 'created_at:datetime',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'visible' => true,
            ],
            // 'updated_at:datetime',
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'visible' => $model->created_at == $model->updated_at ? false : true,
            ],
            // 'author',
            [
                'attribute' => 'authorname',
                'value' => $model->authorname->fullName,
            ],
        ],
    ]) ?>

</div>
