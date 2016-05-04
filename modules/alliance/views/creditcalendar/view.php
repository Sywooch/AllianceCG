<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-view">

<!--    <h1>-->
        <?php // ehocHtml::encode($this->title) ?>
<!--    </h1>-->


<!--     <div class="panel panel-default">

        <div class="panel-heading">
            <h4> -->
                <?php // FA::icon('calendar') . ' ' . Html::encode($this->title) ?>
<!--             </h4>
        </div>

        <div class="panel-body"> -->

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p style="text-align: right">
                <?= Html::a(FA::icon('pencil') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Module::t('module', 'DELETE_CONFIRMATION'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

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
                    'created_at:datetime',
                    [
                        'attribute' => 'updated_at',
                        'format' => 'datetime',
                        'visible' => ($model->updated_at !== $model->created_at) ? true : false,
                    ],

                ],
            ]) ?>

<!--         </div>
    </div> -->



</div>

    <div class="panel panel-default">

        <div class="panel-heading panel-info">
            <h4>
                <?= FA::icon('comment') . ' ' . Module::t('module', 'COMMENTS'); ?>
            </h4>
        </div>

        <div class="panel-body">

            <?php
                echo "<p style='text-align: right'>";
                echo Html::button(FA::icon('comment') . ' ' . Module::t('module', 'COMMENT'), ['value' => Url::to(['comment', 'id' => $model->id]), 'class' => 'btn btn-info btn-sm', 'id' => 'modalButton']);
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
                    'header' => '<h4>' . Module::t('module', 'COMMENT') .'</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg'
                ]);

                echo "<div id='modalContent'></div>";

                Modal::end();
                ?>

        </div>
    </div>

