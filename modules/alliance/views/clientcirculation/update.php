<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Client Circulation',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Circulations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="client-circulation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
