<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\alliance\models\Clientcirculationcomment;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\ClientcirculationcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientcirculationcomments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientcirculationcomment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Clientcirculationcomment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => '№',
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'attribute' => 'clientname',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->clientcirculation->name, ['clientcirculation/' . $data->clientcirculation_id]);
                },
                // 'value' => 'clientcirculation.name',
            ],
            // [
            //     'class' => LinkColumn::className(),
            //     'attribute' => 'clientname',
            //     'value' => 'clientcirculation.name',
            //     'format' => 'raw',
            // ],
            [
                'attribute'=> 'contacttypes',
                'value' => 'contacttypes.contact_type',
            ],
            [
                'attribute'=> 'targets',
                'value' => 'targets.target',
            ],
            // 'contact_type',
            // 'target',
            // 'car_model',
            [
                'attribute' => 'car_model',
                'value' => function($data){
                    return is_numeric($data->car_model) ? $data->cars->fullModelName : $data->car_model;
                },
            ],
            [
                'class' => SetColumn::className(),
                'filter' => Clientcirculationcomment::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Clientcirculationcomment::STATUS_ACTIVE => 'success',
                    Clientcirculationcomment::STATUS_BLOCKED => 'danger',
                ],
            ],
            [
                'attribute' => 'authorname',
                'value' => 'authorname.full_name',
                'visible' => Yii::$app->user->can('admin'),
            ],
            // 'comment:ntext',
            // 'state',
            // 'created_at',
            // 'updated_at',
            // 'author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
