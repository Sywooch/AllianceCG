<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\references\models\Departments;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'DEPARTMENTS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->
    
    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>

    <?= GridView::widget([
        'id' => 'departments-grid',
        'summary' => false,
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
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
            // 'department_name',
            [
                'class' => LinkColumn::className(),
                'attribute' => 'department_name',
                'format' => 'raw',  
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
            [
                'class' => SetColumn::className(),
                // 'filter' => Brands::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Departments::STATUS_ACTIVE => 'success',
                    Departments::STATUS_BLOCKED => 'danger',
                ],
            ],
            // 'user_id',

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header' => 'Действия'
            // ],
        ],
    ]);
?>

<?php Pjax::end(); ?></div>
