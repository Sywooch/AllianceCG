<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Dutylist */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Dutylist',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dutylists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dutylist-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
