<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\alliance\models\Creditcalendar;
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

?>
<div class="creditcalendar-index">

    <div class="panel panel-default">

        <div class="panel-heading panel-info">

            <h4>
                <?php echo FA::icon('calendar') . ' ' . Html::encode($this->title) ?>
            </h4>
            
        </div>
        <div class="panel-body">

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p style="text-align: right">
                <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
                <?php
                    if (!Yii::$app->user->can('deleteCreditcalendarPost')) {
                        echo Html::a(FA::icon('trash') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
                    }
                ?>
            </p>

            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
                $countRecords = '<span class="label label-success">{count}</span>' ;
                $beginRecords = '<span class="label label-success">{begin}</span>' ;
                $endRecords = '<span class="label label-success">{end}</span>' ;
                $events = '<h3>События:</h3>';
            ?>

            <div class="bs-callout bs-callout-success">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                  'filterModel' => $searchModel,
//                  'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                    'id' => 'creditcalendar-grid',
                    'tableOptions' =>[
                        'class' => 'table table-striped table-bordered creditcalendargridview'
                    ],
                    'summary' => " <h4>События: $beginRecords - $endRecords из $countRecords </h4><br/>",
                    'rowOptions' => function($model){
                        if($model->status == Creditcalendar::STATUS_CLARIFY){
                            return ['class' => 'info'];
                        }
                        elseif($model->status == Creditcalendar::STATUS_ATWORK) {
                            return ['class' => 'danger'];
                        }
                        elseif($model->status == Creditcalendar::STATUS_FINISHED) {
                            return ['class' => 'success'];
                        }
                    },
                    'columns' => [
                        [
                            'header' => '№',
                            'class' => 'yii\grid\SerialColumn'
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
                            }
                        ],
                        [
                            'attribute' => 'responsibles',
                            'value' => function($model) {
                                return implode(', ', ArrayHelper::map($model->users, 'id', 'full_name'));
                            }
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
                            'class' => ActionColumn::className(),
                            'header' => 'Действия',
                            'contentOptions'=>['style'=>'width: 130px;'],
                            'template' => '{view}{update}{delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    $title = false;
                                    $options = [];
                                    $icon = '<span class="btn btn-sm btn-warning">'.FA::icon("play-circle").'</span>';
                                    $label = $icon;
                                    $url = Url::toRoute(['view', 'id' => $model->id]);
                                    $options['tabindex'] = '-1';
                                    return Html::a($label, $url, $options) .''. PHP_EOL;
                                },
                                'update' => function ($url, $model) {
                                    $title = false;
                                    $options = [];
                                    $icon = '<span class="btn btn-sm btn-primary">'.FA::icon("edit").'</span>';
                                    $label = $icon;
                                    $url = Url::toRoute(['update', 'id' => $model->id]);
                                    $options['tabindex'] = '-1';
                                    return Html::a($label, $url, $options) .''. PHP_EOL;
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="btn btn-sm btn-danger">'.FA::icon("trash").'</span>', $url, [
                                        'title' => false,
                                        'data-confirm' => Module::t('module', 'DELETE_CONFIRMATION'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                                },
                            ],
                        ],

//                        [
//                            'header' => 'Действия',
//                            'class' => 'yii\grid\ActionColumn'
//                        ],
                    ],
                ]); ?>
            </div>
        </div>

        </div>
    </div>
