<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use app\components\grid\SetColumn;
use yii\helpers\ArrayHelper;
use app\components\grid\LinkColumn;
use yii\jui\AutoComplete;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CREDITCALENDARS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$multipleDelete = file_get_contents('js/modules/alliance/creditcalendar/gridViewMultipleDelete.js');
$this->registerJs($multipleDelete, View::POS_END);

$ExportExcel = file_get_contents('js/modules/alliance/creditcalendar/gridViewExcelExport.js');
$this->registerJs($ExportExcel, View::POS_END);

$toggleSearch = file_get_contents('js/modules/alliance/creditcalendar/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

?>
<div class="creditcalendar-index">

<?= $this->render('_menu', [
    'model' => $model,
]) ?>

<p style="text-align: right">
    <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>

    <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
    <?php
        if (Yii::$app->user->can('deleteCreditcalendarPost') || Yii::$app->user->can('admin')) {
            echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-trash"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']);
        }
    ?>

    <?= Html::a(Yii::t('app', '{icon} CREDITCALENDAR_EXPORT_EXCEL', ['icon' =>'<i class="fa fa-file-excel-o"></i>'] ), ['export'], [
            'id' => 'Excel',
            'class' => 'btn btn-link animlink',
            'onclick' => 'setParams()',
            'data' => [
                'method' => 'post',
                'confirm' => Yii::t('app', 'CREDITCALENDAR_EXPORT_CONFIRM'),
            ]
         ]);
    ?>

    <?php // echo Html::button(Yii::t('app', '{icon} SEARCH', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn-link animlink', 'id' => 'advancedSearch']) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default"> <!-- panelStart -->

        <div class="panel-heading"><!-- panelHeaderBegin -->
            PanelHeading
        </div> <!-- panelHeadingEnd -->  
        
        <div class="panel-body"><!-- panelBodyBegin -->

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
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
                // [
                //     'attribute' => 'locations',
                //     'value' => function($model) {
                //         return implode(', ', ArrayHelper::map($model->locations, 'id', 'company_name'));
                //     },
                //     'visible' => !Yii::$app->user->can('creditmanager') ? true : false,
                // ],
                [
                    'attribute' => 'responsibles',
                    'value' => function($model) {
                        return !empty($model->users) ? implode(', ', ArrayHelper::map($model->users, 'id', 'full_name')) : Yii::t('app', 'RESPONSIBLES_DOES_NOT_EXIST');
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
                        return '<span class="label label-primary">' . Yii::t('app', 'COMMENTS') . ': ' . $model->calendarcommentscount . '</span>';
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

               // [
               //     'header' => 'Действия',
               //     'class' => 'yii\grid\ActionColumn'
               // ],
            ],
        ]); 
    ?>


    </div><!-- panelBodyEnd -->
  </div><!-- panelEnd -->


</div>