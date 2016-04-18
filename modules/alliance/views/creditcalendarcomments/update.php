<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarComments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Creditcalendar Comments',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditcalendar Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="creditcalendar-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
