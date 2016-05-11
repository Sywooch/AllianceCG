<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */

$this->title = Module::t('module', 'Update {modelClass}: ', [
    'modelClass' => 'Departments',
]) . $model->department_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_DEPARTMENTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->department_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="departments-update">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
