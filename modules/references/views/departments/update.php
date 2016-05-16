<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\modules\references\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */

$this->title = Module::t('module', 'UPDATE') . $model->department_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'DEPARTMENTS'), 'url' => ['index']];
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
