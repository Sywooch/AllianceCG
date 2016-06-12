<?php

use yii\helpers\Html;
use app\modules\alliance\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = Module::t('module', 'UPDATE') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="creditcalendar-update">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
