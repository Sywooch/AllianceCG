<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Employees;
use app\modules\alliance\models\Clientcirculationcomment;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CLIENTCIRCULATION'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-circulation-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right;">
        <?= Html::a(Yii::t('app', '{icon} CLIENTCIRCULATION', ['icon' => FA::icon('list')]), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
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
                // 'visible' => $model->updated_at = $model->created_at ? false : true,
            ],
            [
              'attribute' => 'authorname',
              'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>

<div class='buttonpane'>
    <?= Html::button(Yii::t('app', '{icon} ADD_EVENT', ['icon' => FA::icon('comment')]), ['value' => Url::to(['addevent', 'id' => $model->id]), 'class' => 'btn btn-link animlink', 'id' => 'modalButton']);
    ?>
</div>

<?php

    $query = $model->getClientcomment();
    // $query->where(['state' => Models::STATUS_ACTIVE]);

    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $query]),
        'filterModel' => new ActiveDataProvider(['query' => $query]),
        'showOnEmpty' => true,
        'emptyText' => 'Записи отсутствуют',
        'summary' => false,
        'tableOptions' =>[
            'class' => 'table table-striped table-bordered creditcalendargridview'
        ],
        'columns' => [
            [
                'header' => '№',
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'attribute' => 'contact_type',
                'value' => 'contacttypes.contact_type',
            ],
            [
                'attribute' => 'target',
                'value' => 'targets.target',
            ],
            [
                'attribute' => 'car_model',
            ],
            [
                'attribute' => 'comment',
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'authorname',
                'value' => 'authorname.full_name',
            ],
        ],
    ]);

?>


<?php
    Modal::begin([
        'header' => '<h4>' . Yii::t('app', '{icon} ADD_EVENT', ['icon' => FA::icon('comment')]) .'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
?>
