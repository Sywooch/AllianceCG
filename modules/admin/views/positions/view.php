<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="positions-view col-lg-5 col-lg-offset-3">-->

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->

    <p style="text-align: right;">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'ADMIN_POSITIONS'), ['/admin/positions'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'ADMIN_POSITIONS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'ADMIN_POSITIONS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'ADMIN_POSITIONS_REALY_DELETE?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'position',
            // 'description:ntext',
            [
                'attribute' => 'description',
                'format' => 'raw',
            ],
        ],
    ]) ?>

<!--</div>-->
