<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Departments */

$this->title = $model->department_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'DEPARTMENTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-view">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} DEPARTMENTS', ['icon' => FA::icon('list')]), ['index'], ['class' => 'btn btn-sm btn-warning']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('edit')]), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?php
          //  Html::a(FA::icon('remove') . ' ' . Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
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
            'department_name',
            [
              'attribute' => 'created_at',
              'format' => 'datetime',
            ],
            [
              'attribute' => 'updated_at',
              'format' => 'datetime',
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
      ]); 

    ?>

</div>
