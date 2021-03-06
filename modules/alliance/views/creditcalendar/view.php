<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-view">

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p class="buttonpane">
                <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-pencil"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
                <?php 
                    // Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-trash"></i>']), ['delete', 'id' => $model->id], [
                    //     'class' => 'btn btn-link btn-sm',
                    //     'data' => [
                    //         'confirm' => Yii::t('app', 'DELETE_CONFIRMATION', ['icon' => '<i class="fa fa-"></i>']),
                    //         'method' => 'post',
                    //     ],
                    // ]) 
                ?>
            </p>

         <div class="panel panel-default">

            <div class="panel-heading">
                <h4> 
                    <?php echo '<i class="fa fa-calendar"></i> ' . Html::encode($this->title) ?>
                </h4>
            </div>

            <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'period',
                    ],
                    'title',
                    'description:ntext',
                    [
                        'attribute' => 'responsibles',
                        'value' => implode(', ', ArrayHelper::map($model->users, 'id', 'full_name')),
                        'visible' => (!empty($model->users)) ? true : false,
                    ],
                    [
                        'attribute' => 'locations',
                        'value' => implode(', ', ArrayHelper::map($model->locations, 'id', 'company_name')),
                        'visible' => (!empty($model->locations)) ? true : false,
                    ],
                    [
                        'attribute' => 'status',
                        'value' => $model->getStatuses(),
                    ],
                    [
                        'attribute' => 'priority',
                        'value' => $model->getPriorities(),
                    ],
                    [
                        'attribute' => 'author',
                        'value' => $model->authorname->full_name,
                    ],
                    // 'created_at:datetime',
                    [
                        'attribute' => 'created_at',
                        'format' => 'raw',
                        'value' => \Yii::$app->formatter->asDatetime($model->created_at, "php:d/m/Y H:i"),
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'raw',
                        'value' => \Yii::$app->formatter->asDatetime($model->updated_at, "php:d/m/Y H:i"),
                        'visible' => ($model->updated_at !== $model->created_at) ? true : false,
                    ],

                ],
            ]) ?>

        </div>
    </div>



</div>

    <div class="panel panel-default">

        <div class="panel-heading panel-info">
            <h4>
                <?= Yii::t('app', '{icon} COMMENTS', ['icon' => '<i class="fa fa-comment"></i>']); ?>
            </h4>
        </div>

        <div class="panel-body">

            <?php
                echo "<p style='text-align: right'>";
                echo Html::button(Yii::t('app', '{icon} COMMENT', ['icon' => '<i class="fa fa-comment"></i>']), ['value' => Url::to(['comment', 'id' => $model->id]), 'class' => 'btn btn-link animlink', 'id' => 'modalButton']);
                echo "</p>";
            ?>

                <?php
                echo GridView::widget([
                    'dataProvider' => new ActiveDataProvider(['query' => $model->getCalendarComments()]),
                    'showOnEmpty' => true,
                    'emptyText' => 'Комментарии отсутствуют',
                    'tableOptions' =>[
                        'class' => 'table table-striped table-bordered creditcalendargridview'
                    ],
                    'columns' => [
                        [
                            'header' => '№',
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        [
                            'attribute' => 'user_id',
                            'value' => 'authorname.full_name',
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                        ],
                        [
                            'attribute' => 'comment_text',
                            'contentOptions'=>['style'=>'width: 70%;'],
                        ],
                    ],
                ]);

                Modal::begin([
                    'header' => '<h4>' . Yii::t('app', 'COMMENT') .'</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg'
                ]);

                echo "<div id='modalContent'></div>";

                Modal::end();
                ?>

        </div>
    </div>

