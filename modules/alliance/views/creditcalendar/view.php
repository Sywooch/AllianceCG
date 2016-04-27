<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditcalendars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-view">

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
//            'id',
            'title',
//            'date_from',
//            'time_from',
//            'date_to',
//            'time_to',
            'description:ntext',
//            'location',
//            'type',
//            'allday',
            [
                'attribute' => 'author',
                'value' => $model->authorname->full_name,
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'status',
//            'private',
//            'calendar_type',
            [
                'attribute' => 'period',
            ],
            [
                'label' => 'responsibles',
                'value' => implode(', ', ArrayHelper::map($model->users, 'id', 'full_name')),
            ],

        ],
    ]) ?>

</div>
