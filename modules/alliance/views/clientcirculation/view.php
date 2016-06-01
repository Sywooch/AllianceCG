<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Employees;
use app\modules\alliance\models\Clientcirculationcomment;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CLIENTCIRCULATION'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$toggleClientData = file_get_contents('js/modules/alliance/clientcirculation/toggleClientData.js');
$this->registerJs($toggleClientData, View::POS_END);

?>
<div class="client-circulation-view">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p class="buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CLIENTCIRCULATION', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['view', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
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

    <p class="buttonpane">
        <?= Html::button(Yii::t('app', '{icon} CLIENTDATA', ['icon' => '<i class="fa fa-user"></i>']), ['class' => 'btn-link animlink', 'id' => 'showclientdata']) ?> 
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
        'id' => 'detailClientData',
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

<?= '<hr/>' ?>

<div class='buttonpane'>
    <?= Html::button(Yii::t('app', '{icon} ADD_EVENT', ['icon' => '<i class="fa fa-comment"></i>']), ['value' => Url::to(['addevent', 'id' => $model->id]), 'class' => 'btn btn-link animlink', 'id' => 'modalButton']);
    ?>
</div>

<?php

    // $query = $model->getClientcomment();
    $query = Clientcirculationcomment::find();
    $query->where(['clientcirculation_id' => $model->id]);
    $query->andwhere(['{{%clientcirculationcomment}}.state' => Clientcirculationcomment::STATUS_ACTIVE]);
    $query->joinWith(['cars']);
    $filterModel = new Clientcirculationcomment();

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

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'contact_type' => $this->contact_type,
        //     'target' => $this->target,
        //     'car_model' => $this->car_model,
        //     'author' => $this->author,
        // ]);

    // $query
    //     ->andFilterWhere(['like', 'contact_type', $commentDataProvider->contact_type])
    //     ->andFilterWhere(['like', 'target', $commentDataProvider->target])
    //     ->andFilterWhere(['like', 'car_model', $commentDataProvider->car_model])
    //     ->andFilterWhere(['like', 'comment', $commentDataProvider->comment])
    //     ->andFilterWhere(['like', 'author', $commentDataProvider->author])
        ;

    echo GridView::widget([
        // 'dataProvider' => new ActiveDataProvider(['query' => $query]),
        'dataProvider' => $commentDataProvider,
        // 'filterModel' => new ActiveDataProvider(['query' => $query]),
        // 'filterModel' => $filterModel,
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
                // 'attribute' => 'car_model',
                'attribute' => 'cars',
                'value' => function($data){
                        return is_numeric($data->car_model) ? $data->cars->fullModelName : $data->car_model;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            // [
            //     'attribute' => 'comment',
            //         'contentOptions'=>['style'=>'width: 50px;'],
            // ],
            [
                // 'attribute' => 'credit_manager_id',
                'attribute' => 'creditmanagers',
                'format' => 'raw',
                // 'value' => 'creditmanagers.fullName',
                'value'=>function ($data) {
                    return $data->getCreditmanagerlink();
                },
            ],
            [
                'attribute' => 'salesmanagers',
                'format' => 'raw',
                // 'value' => 'salesmanagers.fullName',
                'value'=>function ($data) {
                     return $data->getSalesmanagerlink();
                },
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
        'header' => '<h4>' . Yii::t('app', '{icon} ADD_EVENT', ['icon' => '<i class="fa fa-comment"></i>']) .'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
?>
