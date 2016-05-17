<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\references\Module;
use app\components\grid\LinkColumn;
use app\modules\references\models\Employees;
use app\components\grid\SetColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'EMPLOYEES');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p> -->
        <?php // echo Html::a(Yii::t('app', 'Create Employees'), ['create'], ['class' => 'btn btn-success']) ?>
    <!-- </p> -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'employees-grid',
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
            // 'photo',
            [
                'attribute' => 'photo',
                // 'format' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(),['width'=>50]); 
                },
            ],
            // 'fullName',    
            [
                'class' => LinkColumn::className(),
                'attribute' => 'fullName',
                'format' => 'raw',
            ],
            // 'name',
            // 'patronimyc',
            // 'surname',
            // 'company_id',
            [
                'attribute' => 'brandlogo',
                // 'format' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->getBrandImageUrl(),['width'=>50]); 
                },
            ],
            // [
            //     'attribute' => 'company',
            //     'value' => 'company.company_name'
            // ],
            [
               'attribute'=>'brand',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->getBrandlink();
                },
            ], 
            [
               'attribute'=>'company',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->getCompanylink();
                },
            ],   
            // 'department_id',
            // [
            //     'attribute' => 'department',
            //     'value' => 'department.department_name'
            // ],
            [
               'attribute'=>'department',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->getDepartmentlink();
                },
            ], 
            // 'position_id',
            // [
            //     'attribute' => 'position',
            //     'value' => 'position.position',
            // ],
            [
               'attribute'=>'position',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->getPositionlink();
                },
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
                    Employees::STATUS_ACTIVE => 'success',
                    Employees::STATUS_BLOCKED => 'danger',
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
