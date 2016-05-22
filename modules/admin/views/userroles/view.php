<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Userroles */

$this->title = $model->role_description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_USERROLES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-view">

    <!-- <h1> -->
        <?php // echo  Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => FA::icon('pencil')]), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('trash')]), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Yii::t('app', 'REALLY_DELETE'),
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
            // 'author',
            [
                'attribute' => 'authorname',
                'value' => $model->authorname->full_name,
            ],
        ],
    ]); 

    ?>
    
    <?= '<h3>' . Yii::t('app', '{icon} USERS_WITH_CURRENT_ROLE', ['icon' => FA::icon('users')]) . '</h3>' ?>

    <?= '<p class="buttonpane">' . Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['/admin/users/create'], ['class' => 'btn btn-sm btn-success']) . '</p>' ?>

    <?php

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
            // [
            //     'attribute' => 'fullname',
            //     'value' => 'full_name',
            // ],
            [
               'attribute'=>'fullname',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->getUserlink();
                },
            ], 
        ],
    ]);    
?>

</div>
