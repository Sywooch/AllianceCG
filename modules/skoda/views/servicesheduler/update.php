<?php

use yii\helpers\Html;
use app\modules\skoda\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = Module::t('module', 'STATUS_UPDATE_RN') . ': ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'SERVICESHEDULER_INDEX'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'STATUS_UPDATE_RN');
?>
<div class="servicesheduler-update">
<div class="user-form center-block">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
