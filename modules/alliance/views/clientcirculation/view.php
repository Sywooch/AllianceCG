<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\alliance\Module;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CLIENTCIRCULATION'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-circulation-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right;">
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
            'name',
            'phone',
            'email:email',
            // [
            //     'attribute' => 'regions',
            //     'value' => $model->regions->region_name,
            // ],
            [
                'attribute' => 'regions',
                'value' => $model->getRegionslink(),
                'format' => 'raw',
            ],
            // [
            //     'attribute' => 'regions',
            //     // 'value' => 'fullmodelname',
            //     'value' => function ($data) {
            //         return Html::a($data->region_name, Url::to(['/references/regions/view', 'id' => $data->id]));
            //     },
            //     'format' => 'raw',
            // ],
            // // 'state',
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),
            ],
            'created_at:datetime',
            // 'updated_at:datetime',
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'visible' => $model->updated_at = $model->created_at ? false : true,
            ],
            [
              'attribute' => 'authorname',
              'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>

<?php
    echo "<p style='text-align: right'>";
    echo Html::button(FA::icon('comment') . ' ' . Module::t('module', 'COMMENT'), ['value' => Url::to(['comment', 'id' => $model->id]), 'class' => 'btn btn-info btn-sm', 'id' => 'modalButton']);
    echo "</p>";
?>

<?php
    Modal::begin([
        'header' => '<h4>' . Module::t('module', 'COMMENT') .'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
?>