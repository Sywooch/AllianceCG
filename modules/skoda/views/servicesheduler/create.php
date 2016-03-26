<?php

use yii\helpers\Html;
use app\modules\skoda\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = Module::t('module', 'SERVICESHEDULER_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'SERVICESHEDULER_INDEX'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-create ">
<div class="user-form center-block">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>