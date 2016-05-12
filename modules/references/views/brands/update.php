<?php

use yii\helpers\Html;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */

$this->title = Module::t('module', 'UPDATE') . $model->brand;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'BRANDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->brand, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="brands-update">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

	<div class="alert alert-danger">
		<?= Module::t('module', 'WARNING_EDIT_TARGETS') ?>
	</div>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
