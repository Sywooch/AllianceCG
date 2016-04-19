<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarResponsibles */

$this->title = Yii::t('app', 'Create Creditcalendar Responsibles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditcalendar Responsibles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-responsibles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
