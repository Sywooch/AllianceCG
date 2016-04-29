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

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'CREDITCALENDARS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;
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
            </p>

            <?php echo $this->render('_search', ['model' => $searchModel]); ?>


            <div class="bs-callout bs-callout-success">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                    'tableOptions' =>[
                        'class' => 'table table-striped table-bordered creditcalendargridview'
                    ],
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
                            'attribute' => 'period'
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
                            'header' => 'Действия',
                            'class' => 'yii\grid\ActionColumn'
                        ],
                    ],
                ]); ?>
            </div>
        </div>

        </div>
    </div>
