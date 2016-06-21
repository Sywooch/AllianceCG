<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\Summertable */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Summertable',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Summertables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="summertable-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
