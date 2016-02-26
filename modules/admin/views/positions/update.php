<?php

use yii\helpers\Html;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->position, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'ADMIN_POSITIONS_UPDATE');
?>
<div class="positions-update">

    <h1>
        <?php
            // Html::encode($this->title) 
        ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
