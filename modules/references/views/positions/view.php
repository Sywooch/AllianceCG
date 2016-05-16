<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="positions-view col-lg-5 col-lg-offset-3">-->

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->

    <p style="text-align: right;">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'POSITIONS'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
          //  Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
          //     'class' => 'btn btn-danger btn-sm',
          //     'data' => [
          //         'confirm' => Module::t('module', 'CONFIRM_DELETE'),
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
