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

    <h1><span class="glyphicon glyphicon-piggy-bank" style='padding-right:10px;'></span><?= $model->isNewRecord ? Module::t('module', 'STATUS_CREATE') : Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->date; ?></h1>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'STATUS_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/servicesheduler/calendar'], ['class' => 'btn btn-danger']) ?>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
