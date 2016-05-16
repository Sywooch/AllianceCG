<?php

use yii\helpers\Html;
use app\modules\references\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->position, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="positions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
