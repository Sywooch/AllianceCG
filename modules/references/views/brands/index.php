<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\references\Module;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use app\components\grid\SetColumn;
use app\modules\references\models\Brands;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\BrandsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'BRANDS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-index">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    
    
    <?= GridView::widget([
        'id' => 'brands-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],

            // 'id',
            // 'brand_logo',
            [
                'attribute' => 'brand_logo',
                // 'format' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    // return $model->getImageUrl();
                    return Html::img($model->getImageUrl(),['width'=>50]); 
                },
            ],
            // 'brand',     
            [
                'class' => LinkColumn::className(),
                'attribute' => 'brand',
                'format' => 'raw',    
                // 'value' => function ($data) {
                //     return $data->getFullname();
                // },
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
                'attribute' => 'author',
                'value' => 'authorname.full_name',
            ],       
            // 'state',
            [
                'class' => SetColumn::className(),
                'filter' => Brands::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Brands::STATUS_ACTIVE => 'success',
                    Brands::STATUS_BLOCKED => 'default',
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
?>

<?php Pjax::end(); ?></div>