<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\ContactType */

$this->title = $model->contact_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTACTTYPES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-type-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p class="buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CONTACTTYPES', ['icon' => FA::icon('list')]), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} Update', ['icon' => FA::icon('edit')]), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php 
            // Html::a(Yii::t('app', '{icon} Delete', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger btn-sm',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'contact_type',
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
            ],
            [
              'attribute' => 'authorname',
              'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>
