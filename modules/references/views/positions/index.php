<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Positions;
use yii\web\View;
use app\components\grid\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PositionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'POSITIONS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_search', ['model' => $searchModel]); ?>
    
<div class="positions-index center-block">

<?= GridView::widget([
    'id' => 'positions-grid',
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    // 'summary'=> "{begin} - {end} {count} {totalCount} {page} {pageCount}",
    'showFooter'=>true,
    'showHeader' => true,
    'summary' => false,
    'layout'=>"{summary}\n{items}\n{pager}",
    'columns' => [
        [
           'class' => 'yii\grid\SerialColumn',
           'header' => '№',
           'contentOptions'=>['style'=>'width: 20px;']
        ],
        [
           'class' => 'yii\grid\CheckboxColumn',
           'contentOptions'=>['style'=>'width: 20px;']
        ],     
        [
            'class' => LinkColumn::className(),
            'attribute' => 'position',
            'filter' => ArrayHelper::map(Positions::find()->asArray()->all(), 'position', 'position'),
        ],
        [
            'attribute' => 'userscount',
            'format' => 'html',
            'filter' => false,
            'value' => function($model) {
                return '<span class="label label-primary">' . Yii::t('app', 'COUNTUSERS') . ': ' . $model->userscount . '</span>';
            },   
            'contentOptions' => ['class'=>'success;'],
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
            'value' => 'authorname.full_name',
        ],

        // [
        //     'class' => 'yii\grid\ActionColumn',
        //     'header' => 'Действия',
        // ],
        [
            'class' => SetColumn::className(),
            // 'filter' => Brands::getStatesArray(),
            'attribute' => 'state',
            'visible' => Yii::$app->user->can('admin'),
            'name' => 'statesName',
            'contentOptions'=>['style'=>'width: 50px;'],
            'cssCLasses' => [
                Positions::STATUS_ACTIVE => 'success',
                Positions::STATUS_BLOCKED => 'danger',
            ],
        ],

    ],
]); 
?>

</div>
