<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use yii\helpers\Url;
use app\modules\admin\Module;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Positions;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PositionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_POSITIONS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_search', ['model' => $searchModel]); ?>
    
<div class="positions-index center-block">

<?= GridView::widget([
    'id' => 'admin-positions-grid',
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
                return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS') . ': ' . $model->userscount . '</span>';
            },   
            'contentOptions' => ['class'=>'success;'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Действия',
        ],
    ],
]); 
?>

</div>
