<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use app\components\grid\SetColumn;
use yii\helpers\ArrayHelper;
use app\components\grid\LinkColumn;
use yii\jui\AutoComplete;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'CREDITCALENDARS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$multipleDelete = file_get_contents('js/modules/alliance/creditcalendar/gridViewMultipleDelete.js');
$this->registerJs($multipleDelete, View::POS_END);

$ExportExcel = file_get_contents('js/modules/alliance/creditcalendar/gridViewExcelExport.js');
$this->registerJs($ExportExcel, View::POS_END);

?>
<div class="creditcalendar-index">

<?= $this->render('_menu', [
    'model' => $model,
]) ?>

<p style="text-align: right">
    <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>

    <?php // Html::button(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['value' => Url::to(['create']), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButton']);?>
    <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    <?php
        if (Yii::$app->user->can('deleteCreditcalendarPost')) {
            echo Html::a(FA::icon('trash') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
        }
    ?>
    <?php 
        // if(!Yii::$app->user->can('creditmanager')){
        //     echo Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ;
        // }
    ?>

    <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'  ), ['export'], [
            'id' => 'Excel',
            'class' => 'btn btn-warning btn-sm',
            'onclick' => 'setParams()',
            'data' => [
                'method' => 'post',
                'confirm' => Module::t('module', 'CREDITCALENDAR_EXPORT_CONFIRM'),
            ]
         ]);
    ?>     

<?php
// $script = "
//         function setParams(){
//             var keyList = $('#creditcalendar-grid').yiiGridView('getSelectedRows');
//             if(keyList != '') {
//                 $('#btn-multi-del').attr('data-params', JSON.stringify({keyList}));
//             } else {
//                 $('#btn-multi-del').removeAttr('data-params');
//             }
//         };";
// $this->registerJs($script, yii\web\View::POS_BEGIN);
?>    

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        // $countRecords = '<span class="label label-success">{count}</span>' ;
        // $beginRecords = '<span class="label label-success">{begin}</span>' ;
        // $endRecords = '<span class="label label-success">{end}</span>' ;
        // $events = '<h3>События:</h3>';
    ?>

   

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
//          'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
            'id' => 'creditcalendar-grid',
            'tableOptions' =>[
                'class' => 'table table-striped table-bordered creditcalendargridview'
            ],
            // 'summary' => false,
            // 'summary' => " <h4>События: $beginRecords - $endRecords из $countRecords </h4><br/>",
            // 'rowOptions' => function($model){
            //     if($model->status == Creditcalendar::STATUS_CLARIFY){
            //         return ['class' => 'info'];
            //     }
            //     elseif($model->status == Creditcalendar::STATUS_ATWORK) {
            //         return ['class' => 'danger'];
            //     }
            //     elseif($model->status == Creditcalendar::STATUS_FINISHED) {
            //         return ['class' => 'success'];
            //     }
            // },
            'columns' => [
                [
                    'header' => '№',
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'contentOptions'=>['style'=>'width: 20px;']
                ],
                [
                    'attribute' => 'period'
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
                    'attribute' => 'locations',
                    'value' => function($model) {
                        return implode(', ', ArrayHelper::map($model->locations, 'id', 'company_name'));
                    },
                    'visible' => !Yii::$app->user->can('creditmanager') ? true : false,
                ],
                [
                    'attribute' => 'responsibles',
                    'value' => function($model) {
                        return implode(', ', ArrayHelper::map($model->users, 'id', 'full_name'));
                    },
                    'visible' => !Yii::$app->user->can('creditmanager') ? true : false,
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'priority',
                    'name' => 'priorities',
                    'format' => 'raw',
                    'filter' => $searchModel->getPrioritiesArray(),
                    'cssCLasses' => [
                        Creditcalendar::PRIORITY_BASIC => 'success',
                        Creditcalendar::PRIORITY_LOW => 'info',
                        Creditcalendar::PRIORITY_HIGH => 'danger',
                    ],
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'status',
                    'format' => 'raw',
                    'name' => 'statuses',
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'filter' => $searchModel->getStatusesArray(),
                    'cssCLasses' => [
                        Creditcalendar::STATUS_ATWORK => 'danger',
                        Creditcalendar::STATUS_CLARIFY => 'primary',
                        Creditcalendar::STATUS_FINISHED => 'success',
                    ],
                ],
                [
                    'attribute' => 'calendarcommentscount',
                    'format' => 'html',
                    'filter' => false,
                    'value' => function($model) {
                        return '<span class="label label-primary">' . Module::t('module', 'COMMENTS') . ': ' . $model->calendarcommentscount . '</span>';
                    },   
                    'contentOptions' => ['class'=>'success;'],
                ],
                // [
                //     'class' => ActionColumn::className(),
                //     'header' => 'Действия',
                //     'contentOptions'=>['style'=>'width: 130px;'],
                //     'template' => '{view}{update}{delete}',
                //     'buttons' => [
                //         'view' => function ($url, $model) {
                //             $title = false;
                //             $options = [];
                //             $icon = '<span class="btn btn-sm btn-warning">'.FA::icon("play-circle").'</span>';
                //             $label = $icon;
                //             $url = Url::toRoute(['view', 'id' => $model->id]);
                //             $options['tabindex'] = '-1';
                //             return Html::a($label, $url, $options) .''. PHP_EOL;
                //         },
                //         'update' => function ($url, $model) {
                //             $title = false;
                //             $options = [];
                //             $icon = '<span class="btn btn-sm btn-primary">'.FA::icon("edit").'</span>';
                //             $label = $icon;
                //             $url = Url::toRoute(['update', 'id' => $model->id]);
                //             $options['tabindex'] = '-1';
                //             return Html::a($label, $url, $options) .''. PHP_EOL;
                //         },
                //         'delete' => function ($url, $model, $key) {
                //             if(!Yii::$app->user->can('creditmanager')){
                //                 return Html::a('<span class="btn btn-sm btn-danger">'.FA::icon("trash").'</span>', $url, [
                //                     'title' => false,
                //                     'data-confirm' => Module::t('module', 'DELETE_CONFIRMATION'),
                //                     'data-method' => 'post',
                //                     'data-pjax' => '0',
                //                 ]);
                //             }
                //         },
                //     ],
                // ],

               [
                   'header' => 'Действия',
                   'class' => 'yii\grid\ActionColumn'
               ],
            ],
        ]); 
    ?>

</div>