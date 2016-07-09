<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Dutylist */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dutylists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dutylist-view">

    <p>
        <?php // echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            // Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            // 'employee_id',
            // 'date',
            [
                'attribute' => 'employee_id',
                'value' => $model->employee->fullName,
            ],
            [ 
                'attribute' => 'date',
                'value' => date("d/m/Y",  strtotime($model->date)),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d/m/Y H:i'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d/m/Y H:i'],
            ],
            [
                'attribute' => 'authorname',
                'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>
