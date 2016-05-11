<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */

$this->title = $model->brand;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'BRANDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-view">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'brand',
            // 'state',
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),
            ],
        ],
    ]) ?>

</div>
