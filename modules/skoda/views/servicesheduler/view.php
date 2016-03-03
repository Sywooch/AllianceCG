<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Serviceshedulers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-view col-lg-5 col-lg-offset-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-tasks"></span>  ' . Module::t('module', 'SERVICESHEDULER_INDEX'), ['index'], ['class' => 'btn btn-warning', 'id' => 'refreshButton']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
            'date',
            'responsible',
        ],
    ]) ?>

</div>
