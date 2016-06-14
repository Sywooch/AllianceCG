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

    <?php
        if (Yii::$app->session->hasFlash('err')) { 
            echo '<div class="alert alert-danger">';
            echo Yii::t('app', 'VALIDATIONERROR');
            echo '</div>';
        } 
        elseif (Yii::$app->session->hasFlash('ok')) { 
            echo '<div class="alert alert-success">';
            echo Yii::t('app', 'CLIENTCIRCULATIONCOMMENTDONE');
            echo '</div>';
         }
     ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p class="buttonpane">
            <?= Html::button(Yii::t('app', '{icon} CLIENTDATA', ['icon' => '<i class="fa fa-user"></i>']), ['class' => 'btn-link', 'id' => 'showclientdata']) ?> 
        </p> 
    </div> <!-- panelHeading End -->   
    
    <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($commentModel); ?>    
    <?php ActiveForm::end(); ?>

    <?php 
        echo DetailView::widget([
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
        ]); 
?>

</div> <!-- panelBody End -->

</div> <!-- panelEnd -->

</div>

<?php echo '<hr/>' ?>

<div class="panel panel-default">

    <div class="panel-heading">

        <div class='buttonpane'>
            <?php echo Html::button(Yii::t('app', '{icon} ADD_EVENT', ['icon' => '<i class="fa fa-comment"></i>']), ['value' => Url::to(['addevent', 'id' => $model->id]), 'class' => 'btn btn-link', 'id' => 'modalButton']);
            ?>
        </div> <!-- buttonPane End -->

    </div> <!-- panelHeading End -->

    <div class="panel-body">

<?php

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
                // 'value' => 'contacttypes.contact_type',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->contacttypes->contact_type, ['clientcirculationcomment/' . $data->id]);
                },
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
                'value' => 'creditmanagers.fullName',
                // 'value'=>function ($data) {
                //     return $data->getCreditmanagerlink();
                // },
            ],
            [
                'attribute' => 'salesmanagers',
                'format' => 'raw',
                'value' => 'salesmanagers.fullName',
                // 'value'=>function ($data) {
                //      return $data->getSalesmanagerlink();
                // },
            ],
            // [
            //     'attribute' => 'authorname',
            //     'value' => 'authorname.full_name',
            // ],
        ],
    ]);

?>

</div> <!-- panelBody End -->

</div> <!-- panel End -->

<?php
    Modal::begin([
        'header' => '<h4>' . Yii::t('app', '{icon} ADD_EVENT', ['icon' => '<i class="fa fa-comment"></i>']) .'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
?>
