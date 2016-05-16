<?php

use yii\helpers\Html;
use app\modules\references\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="positions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
