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
use yii\helpers\ArrayHelper;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\CreditcalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

//Pjax Auto-update

//$upd = file_get_contents('js/modules/alliance/creditcalendar/updateIndexGridView.js');
//$this->registerJs($upd, View::POS_END);

?>
   
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

    <?= $this->render('_buttonmenu', [
        'model' => $model,
    ])?>

<div class="creditcalendar-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'creditcalendar']); ?>
    
    <?= Yii::$app->session->getFlash('error'); ?>
    
    <?= GridView::widget([
        'id' => 'creditcalendar-grid',
        'dataProvider' => $dataProvider,
        'showFooter'=>true,
        'showHeader' => true,
        'summary' => '',
        'showOnEmpty'=>true,
        'emptyCell'=>'-',
        'filterModel' => $searchModel,
        'tableOptions' =>[
            'class' => 'table table-striped table-bordered creditcalendargridview'
        ],
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
//            [
//                'attribute' => 'responsible',
//                'format' => 'raw',
//                'filter' => ArrayHelper::map(Creditcalendar::find()->where(['not', ['responsible' => null]])->asArray()->all(), 'responsible', 'responsible'),
//                'value' => function ($data) {
//                    return $data->getResponsibles();
//                },
//            ],
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
                'cssCLasses' => [
                    Creditcalendar::STATUS_ATWORK => 'danger',
                    Creditcalendar::STATUS_CLARIFY => 'primary',
                    Creditcalendar::STATUS_FINISHED => 'success',
                ],
            ],
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
