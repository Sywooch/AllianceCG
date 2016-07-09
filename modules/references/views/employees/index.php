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

$this->title = Yii::t('app', 'EMPLOYEES');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">


<div class="buttonpane">

<?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']); ?>
        
<?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-remove"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']); ?>
        
<?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => '<i class="fa fa-upload"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleRestore']); ?>

<?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
<?php // echo Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => '<i class="fa fa-file-excel-o"></i>']), ['class' => 'btn btn-link animlink', 'id' => 'advancedOperations']) ?>

</div>

<?php Pjax::begin(); ?>    

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="panel-body">
        

    <?= GridView::widget([
        'id' => 'employees-grid',
        'summary' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'filter' => false,
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(), ['width'=>50, 'class' => 'img-rounded']); 
                },
            ],
            [
                'attribute' => 'brandlogo',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->getBrandImageUrl(),['width'=>50, 'class' => 'img-rounded']); 
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
            // [
            //     'attribute' => 'company',
            //     'value' => 'company.company_name'
            // ],
            // 
            // [
            //    'attribute'=>'brand',
            //    'format' => 'raw',
            //    'value'=>function ($data) {
            //         return $data->getBrandlink();
            //     },
            // ], 
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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    ?>
<?php Pjax::end(); ?></div>


        </div>
    </div>    
