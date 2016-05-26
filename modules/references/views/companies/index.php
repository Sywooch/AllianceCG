<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Companies;
use app\components\grid\LinkColumn;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'COMPANIES');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">

    <?= GridView::widget([
        'id' => 'companies-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'emptyCell'=>'-',
        'layout'=>"{pager}\n{summary}\n{items}",
        'summary' => false,
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
            // [
            //     'attribute' => 'company_brand',
            //     'value' => 'brands.brand',
            // ],
            [
                'attribute'=>'company_brand',
                'format'=>'html',//raw, html
                'content'=>function($data){
                        $logo = (!empty($data->getParentBrands()) && file_exists($data->getParentBrands())) ? HTML::img('/'.$data->getParentBrands(), ['width' => '50']) : HTML::img(Companies::COMPANY_NOLOGO, ['width' => '50']);
                        return $logo;
                    }
            ], 
            [
                'class' => LinkColumn::className(),
                'attribute' => 'company_name',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_name', 'company_name'),
                'format' => 'raw',  
            ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => 'datetime',
            // ],
            // [
            //     'attribute' => 'updated_at',
            //     'format' => 'datetime',
            // ],
            // [
            //     'attribute' => 'authorname',
            //     'value' => 'authorname.full_name',
            // ],
            [
                'class' => SetColumn::className(),
                // 'filter' => Brands::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Companies::STATUS_ACTIVE => 'success',
                    Companies::STATUS_BLOCKED => 'danger',
                ],
            ],
            [
                'attribute' => 'userscount',
                'format' => 'html',
                'filter' => false,
                'value' => function($model) {
                    return '<span class="label label-primary">' . Yii::t('app', 'COUNTUSERS'  ) . ': ' . $model->userscount . '</span>';
                },   
                'contentOptions' => ['class'=>'success;'],
            ], 
            // [
            //     'class' => ActionColumn::className(),
            //     'contentOptions'=>['style'=>'width: 20px;'],
            //     'template' => '{update}',
            // ],
        ],
    ]); ?>

</div>
