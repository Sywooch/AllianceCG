<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CalendarResponsibles */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Calendar Responsibles',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendar Responsibles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calendar-responsibles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
