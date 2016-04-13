<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use yii\jui\AutoComplete;
use app\modules\admin\models\Companies;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\CreditcalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(' 

    $(document).ready(function(){
    $(\'#MultipleDelete\').click(function(){
            var PosId = $(\'#creditcalendar-grid\').yiiGridView(\'getSelectedRows\');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Удалить отмеченные записи?")) {
              $.ajax({
                type: \'POST\',
                url : \'/alliance/creditcalendar/multipledelete\',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });', \yii\web\View::POS_READY);


?>
   
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

<div class="creditcalendar-index">

    <h1>
        <?php // Html::encode($this->title) ?>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  
        
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
                
    </p>
        
    <?= Yii::$app->session->getFlash('error'); ?>
    
    <?= GridView::widget([
        'id' => 'creditcalendar-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            $curdate = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd h:i:s');
            $dtTo = Yii::$app->formatter->asDateTime($model->getDateTimeTo(), 'yyyy-MM-dd h:i:s');
            if($dtTo < $curdate){
                return ['class' => 'danger'];
            }
            else {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'title',
                'format' => 'raw',
                'filter' => AutoComplete::widget([   
                        'model' => $searchModel,
                        'attribute' => 'title',             
                        'clientOptions' => [
                            'source' => $searchModel->titleautocomplete(),
                        ],
                        'options'=>[
                            'class'=>'form-control'
                        ]
                    ]),
                'contentOptions'=>['style'=>'width: 130px;'],
            ],
            [
                'attribute' => 'dateTimeFrom',
                'format' => ['date', 'php:H:i:s d/m/Y'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'dateTimeFrom',
                    'options' => ['class' => 'form-control']
                ]),
                'value' => function ($data) {
                    return $data->getDateTimeFrom();
                },
            ],
            [
                'attribute' => 'dateTimeTo',
                'format' => ['date', 'php:H:i:s d/m/Y'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'dateTimeTo',
                    'options' => ['class' => 'form-control']
                ]),
                'value' => function ($data) {
                    return $data->getdateTimeTo();
                },
            ],
            [
                'attribute' => 'location',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_name', 'company_name'),
            ],
            [
                'attribute' => 'author',
                'format' => 'raw',
                'filter' => AutoComplete::widget([   
                        'model' => $searchModel,
                        'attribute' => 'author',             
                        'clientOptions' => [
                            'source' => $searchModel->authorautocomplete(),
                        ],
                        'options'=>[
                            'class'=>'form-control'
                        ]
                    ]),                
            ],
//            'dateTimeTo',
//            'date_from',
//            'time_from',
//            'date_to',
//            'time_to',
            // 'description:ntext',
//            'location',
            // 'is_task',
            // 'is_repeat',
//            'author',
//            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
