<?php

use yii\helpers\Html;
use app\modules\references\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Companies */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'COMPANIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
