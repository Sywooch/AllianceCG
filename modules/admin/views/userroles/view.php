<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use app\modules\admin\Module;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Userroles */

$this->title = $model->role_description;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_USERROLES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-view">

    <!-- <h1> -->
        <?php // echo  Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('pencil') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
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
            // 'id',
            'role',
            'role_description:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            'author',
        ],
    ]); 

    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getUsersbyrole()]),
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
