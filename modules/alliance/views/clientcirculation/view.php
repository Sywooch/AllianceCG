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
use yii\widgets\ActiveForm;
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

    <p class="buttonpane">
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
    

    <?php if (Yii::$app->session->hasFlash('err')) { ?>

        <div class="alert alert-danger">
            <?= Yii::t('app', 'CLIENTCIRCULATIONCOMMENTVALIDATIONERROR') ?>
        </div>

    <?php } 
    elseif (Yii::$app->session->hasFlash('ok')) { ?>

        <div class="alert alert-success">
            <?= Yii::t('app', 'CLIENTCIRCULATIONCOMMENTDONE') ?>
        </div>        

    <?php } ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($commentModel); ?>    
    <?php ActiveForm::end(); ?>

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

    $commentDataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

    // $commentDataProvider->setSort([
    //     'attributes' => [
    //         'created_at' => [
    //             'asc' => ['created_at' => SORT_ASC],
    //             'desc' => ['created_at' => SORT_DESC],
    //             'label' => 'created_at',
    //             'default' => SORT_ASC
    //         ],
    //     ]
    // ]);    

    $query->andFilterWhere(['like', 'contact_type', $commentModel->contact_type])
        ->andFilterWhere(['like', 'target', $commentModel->target])
        ->andFilterWhere(['like', 'car_model', $commentModel->car_model])
        ->andFilterWhere(['like', 'comment', $commentModel->comment])
        ->andFilterWhere(['like', 'author', $commentModel->author])
        ;

    echo GridView::widget([
        // 'dataProvider' => new ActiveDataProvider(['query' => $query]),
        'dataProvider' => $commentDataProvider,
        // 'filterModel' => new ActiveDataProvider(['query' => $query]),
        'filterModel' => $commentDataProvider,
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
                    'contentOptions'=>['style'=>'width: 50px;'],
            ],
            [
                // 'attribute' => 'credit_manager_id',
                'attribute' => 'creditmanagers',
                'value' => 'creditmanagers.fullName'
            ],
            [
                // 'attribute' => 'sales_manager_id',
                'attribute' => 'salesmanagers',
                'value' => 'salesmanagers.fullName',
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            // [
            //     'attribute' => 'authorname',
            //     'value' => 'authorname.full_name',
            // ],
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
