<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="positions-view col-lg-5 col-lg-offset-3">-->

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->

    <p style="text-align: right;">
        <?= Html::a(Yii::t('app', '{icon} POSITIONS', ['icon' => FA::icon('list')]), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
          //  Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
          //     'class' => 'btn btn-danger btn-sm',
          //     'data' => [
          //         'confirm' => Yii::t('app', 'CONFIRM_DELETE'),
          //         'method' => 'post',
          //     ],
          // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'position',
            // 'description:ntext',
            [
                'attribute' => 'description',
                'format' => 'raw',
            ],
            [
              'attribute' => 'created_at',
              'format' => 'datetime',
            ],
            [
              'attribute' => 'updated_at',
              'format' => 'datetime',
              'visible' => $model->updated_at == $model->created_at ? false : true,
            ],
            [
              'attribute' => 'authorname',
              'value' => $model->authorname->full_name,
            ],
        ],
    ]); 

    echo GridView::widget([
          'dataProvider' => new ActiveDataProvider(['query' => $model->getUser()]),
          'showOnEmpty' => true,
          'tableOptions' =>[
              'class' => 'table table-striped table-bordered creditcalendargridview'
          ],
          'columns' => [
              [
                  'header' => '№',
                  'class' => 'yii\grid\SerialColumn'
              ],
              [
                  'attribute' => 'fullname',
                  'value' => 'full_name',
              ],
          ],
      ]);   ?> 
<!--</div>-->
