<?php

use yii\helpers\Html;
use app\modules\alliance\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CLIENTCIRCULATION'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-circulation-create">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
