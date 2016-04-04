<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\Module;
use app\modules\skoda\models\Servicesheduler;
use rmrevin\yii\fontawesome\FA;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */


$formatter = new \yii\i18n\Formatter;
$formatter->dateFormat = 'php:d/m/Y';
$this->title = $formatter->asDate($model->date);

$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'SERVICESHEDULER_INDEX'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-view col-lg-12">

    <h1><?php Html::encode($this->title) ?></h1>

    <p style="text-align: right">
        <?= Html::a(FA::icon('tasks') . Module::t('module', 'SERVICESHEDULER_INDEX'), ['calendar'], ['class' => 'btn btn-warning btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('edit') . Module::t('module', 'STATUS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . Module::t('module', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'STATUS_CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
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
            'responsible',
        ],
    ]) ?>

</div>
