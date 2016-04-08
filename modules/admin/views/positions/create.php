<?php

use yii\helpers\Html;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Positions */

$this->title = Module::t('module', 'ADMIN_POSITIONS_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_POSITIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="positions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
