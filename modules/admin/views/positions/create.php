<?php

use yii\helpers\Html;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = Module::t('module', 'ADMIN_POSITIONS_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="positions-create">

    <h1>
    <?php
        // Html::encode($this->title) 
    ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
