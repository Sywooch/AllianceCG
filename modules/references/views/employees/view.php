<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Employees */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'EMPLOYEES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} EMPLOYEES', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php 
            // Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-remove"></i>']), ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'fullName',
            ],
            [
                'attribute' => 'photo',
                'value'=>$model->getImageUrl(),
                'format' => ['image',['width'=>'50', 'class' => 'img-rounded']],
            ],
            // [
            //     'attribute' => 'company',
            //     'value' => $model->company->company_name,
            // ],
            [
                'attribute' => 'companies',
                'format'=>'raw',
                'value' => $model->getCompanylink(),
                'visible' => !empty($model->company->company_name) ? true : false,
            ],
            // [
            //     'attribute' => 'department',
            //     'value' => $model->department->department_name,
            // ],
            [
                'attribute' => 'department',
                'format'=>'raw',
                'value' => $model->getDepartmentlink(),
                'visible' => !empty($model->department->department_name) ? true : false,
            ],
            // [
            //     'attribute' => 'position',
            //     'value' => $model->position->position,
            // ],
            [
                'attribute' => 'position',
                'format'=>'raw',
                'value' => $model->getPositionlink(),
                'visible' => !empty($model->position->position) ? true : false,
            ],
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
    ]) ?>

</div>
