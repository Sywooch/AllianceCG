<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\models\Servicesheduler;
// use rmrevin\yii\fontawesome\FA;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */


$formatter = new \yii\i18n\Formatter;
$formatter->dateFormat = 'php:d/m/Y';
$this->title = $formatter->asDate($model->date);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SERVICESHEDULER_INDEX'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-view col-lg-12">

    <h1><?php Html::encode($this->title) ?></h1>

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} SERVICESHEDULER_INDEX', ['icon' => '<i class="fa fa-tasks"></i>']), ['calendar'], ['class' => 'btn btn-link animlink', 'id' => 'refreshButton']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} STATUS_UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php
            // Html::a(FA::icon('remove') . Yii::t('app', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger btn-sm',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'STATUS_CONFIRM_DELETE'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
//            'date',
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d/m/Y'],
            ],
            // 'responsible',
            [
                'attribute' => 'responsibles',
                'value' => $model->responsibles->fullName,
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
