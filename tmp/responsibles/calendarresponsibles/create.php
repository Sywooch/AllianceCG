<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CalendarResponsibles */

$this->title = Yii::t('app', 'Create Calendar Responsibles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendar Responsibles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-responsibles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
