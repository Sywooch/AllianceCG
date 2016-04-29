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

$this->title = Yii::t('app', 'Creditcalendars');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-index">

    <h1>
        <?php // echo Html::encode($this->title) ?>
    </h1>


    <?= $this->render('_menu', [
        'model' => $model,
    ]) ?>

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', 'Create Creditcalendar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
