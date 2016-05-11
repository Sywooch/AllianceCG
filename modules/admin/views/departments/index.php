<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\Module;
use app\components\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_DEPARTMENTS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->
    
    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>

    <?= GridView::widget([
        'id' => 'departments-positions-grid',
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
                    return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS'  ) . ': ' . $model->userscount . '</span>';
                },   
                'contentOptions' => ['class'=>'success;'],
            ], 
            // 'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия'
            ],
        ],
    ]);
?>

<?php Pjax::end(); ?></div>
