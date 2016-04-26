<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = Module::t('module', 'CREDITCALENDAR_UPDATE') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'CREDITCALENDAR_UPDATE');
?>
<div class="creditcalendar-update">
<div class="user-form center-block">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
