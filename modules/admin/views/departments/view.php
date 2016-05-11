<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\Module;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */

$this->title = $model->department_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_DEPARTMENTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-view">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'ADMIN_DEPARTMENTS'), ['index'], ['class' => 'btn btn-sm btn-warning']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'REALLY_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'department_name',
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
