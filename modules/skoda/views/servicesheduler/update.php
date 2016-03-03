<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Servicesheduler',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Serviceshedulers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="servicesheduler-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
