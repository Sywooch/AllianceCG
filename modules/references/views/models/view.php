<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Models */

$this->title = $model->model_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'MODELS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-view">

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'MODELS'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
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
            // [
            //     'attribute' => 'brand',
            //     'value' => $model->brand->brand,
            // ],
            [
                'attribute' => 'brand',
                'format'=>'raw',
                'value' => $model->getBrandslink(),
                'visible' => !empty($model->brand->brand) ? true : false,
            ],
            'model_name',
            // [
            //     'attribute' => 'bodytype',
            //     'value' => $model->bodytype->body_type,
            // ],
            [
                'attribute' => 'brand',
                'format'=>'raw',
                'value' => $model->getBodytypeslink(),
                'visible' => !empty($model->bodytype->body_type) ? true : false,
            ],
        ],
    ]) ?>

</div>
