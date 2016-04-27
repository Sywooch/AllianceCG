<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Creditcalendars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Creditcalendar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
//            'calendarResponsibles.user_id',

//            [
//                'label' => 'user_id',
//                'value' => implode(', ', ArrayHelper::map($model->users, 'id', 'full_name')),
//            ],

            'date_from',
            'time_from',
            'date_to',
            'time_to',
            // 'description:ntext',
            'location',
            // 'type',
            // 'allday',
            // 'author',
            // 'created_at',
            // 'updated_at',
            'status',
            // 'private',
            // 'calendar_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
