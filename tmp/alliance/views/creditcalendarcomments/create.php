<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\CreditcalendarComments */

$this->title = Yii::t('app', 'Create Creditcalendar Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creditcalendar Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
