<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\references\Module;
use app\components\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Companies;
use app\components\grid\LinkColumn;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'COMPANIES');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">

    <?= GridView::widget([
        'id' => 'companies-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
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
            [
                'attribute' => 'company_brand',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_brand', 'company_brand'),
                'value'=>function($data) { return Html::img($data->getSingleLogo(),['height' => '50']); },
                'contentOptions'=>['style'=>'width: 60px;'],
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'company_name',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_name', 'company_name'),
                'format' => 'raw',  
            ],
            [
                'attribute' => 'userscount',
                'format' => 'html',
                'filter' => false,
                'value' => function($model) {
                    return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS'  ) . ': ' . $model->userscount . '</span>';
                },   
                'contentOptions' => ['class'=>'success;'],
            ], 
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
            ],
        ],
    ]); ?>

</div>
