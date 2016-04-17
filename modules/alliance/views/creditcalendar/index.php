<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use yii\jui\AutoComplete;
use app\modules\admin\models\Companies;
use app\modules\alliance\models\Creditcalendar;
use yii\jui\DatePicker;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\CreditcalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#creditcalendar_refresh").click(); }, 60000);
});
JS;
$this->registerJs($script);

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
        
        <?php // Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_EVENT'), ['create?is_task=0'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_TASK'), ['create?is_task=1'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  
        
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
                
    </p>    
    
    <?php Pjax::begin(); ?>
    
    <?= Html::a("", ['/alliance/creditcalendar/index'], ['class' => 'hidden_button', 'id' => 'creditcalendar_refresh']) ?>
        
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
                'header' => FA::icon('calendar') . ' / ' . FA::icon('tasks'),
                'attribute' => 'is_task',
                'format' => 'raw',
                'filter' => Creditcalendar::getTasksArray(),
                'value' => function ($data) {
                    return $data->getIsTaskIcon();
                },
            ],
            [
                'attribute' => 'responsible',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Creditcalendar::find()->where(['not', ['responsible' => null]])->asArray()->all(), 'responsible', 'responsible'),
                'value' => function ($data) {
                    return $data->getResponsibles();
                },
            ],
            [
                'attribute' => 'location',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_name', 'company_name'),
            ],
//            [
//                'attribute' => 'author',
//                'format' => 'raw',
//                'filter' => AutoComplete::widget([   
//                        'model' => $searchModel,
//                        'attribute' => 'author',             
//                        'clientOptions' => [
//                            'source' => $searchModel->authorautocomplete(),
//                        ],
//                        'options'=>[
//                            'class'=>'form-control'
//                        ]
//                    ]),                
//            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'status',
                'format' => 'raw',
                'name' => 'statuses',
                'contentOptions'=>['style'=>'width: 50px;'],
                'filter' => $model->getStatusesArray(),
//                'value' => function ($data) {
//                    return $data->getStatuses();
//                },
                'cssCLasses' => [
                    Creditcalendar::STATUS_ATWORK => 'danger',
                    Creditcalendar::STATUS_CLARIFY => 'primary',
                    Creditcalendar::STATUS_FINISHED => 'success',
                ],
            ],
//            'dateTimeTo',
//            'date_from',
//            'time_from',
//            'date_to',
//            'time_to',
            // 'description:ntext',
//            'location',
//             'is_task',
            // 'is_repeat',
//            'author',
//            'created_at:datetime',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $title = false;
                        $options = []; 
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
        ],
    ]);
                    
    Pjax::end(); 
                    
?>
    
</div>
