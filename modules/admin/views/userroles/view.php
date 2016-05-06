<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Userroles */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userroles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'role',
            'role_description:ntext',
            'created_at',
            'updated_at',
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
