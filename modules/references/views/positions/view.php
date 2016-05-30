<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p class="buttonpane">
        <?= Html::a(Yii::t('app', '{icon} POSITIONS', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php
          //  Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-remove"></i>']), ['delete', 'id' => $model->id], [
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

?>


<div class="col-sm-9">
    <?= '<h3>' . Yii::t('app', 'EMPLOYEES_THIS_POSITION') . '</h3>' ?>
</div>

<div class="col-sm-3">
        <?= Html::a(Yii::t('app', '{icon} CREATE_EMPLOYEES', ['icon' => '<i class="fa fa-edit"></i>']), ['/references/employees/create?id=' . $model->id], [
                'class' => 'btn btn-link animlink',
            ]) ?>
</div>

<?= GridView::widget([
          'dataProvider' => new ActiveDataProvider(['query' => $model->getEmployees()]),
          'showOnEmpty' => true,
          'summary' => false,
          'tableOptions' =>[
              'class' => 'table table-striped table-bordered creditcalendargridview'
          ],
          'columns' => [
              [
                  'header' => '№',
                  'class' => 'yii\grid\SerialColumn'
              ],
              [
                  'attribute' => 'fullName',
                  'value' => 'fullName',
              ],
          ],
      ]);   ?> 
<!--</div>-->
