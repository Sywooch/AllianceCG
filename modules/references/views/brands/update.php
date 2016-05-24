<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */

$this->title = Yii::t('app', 'UPDATE') . $model->brand;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BRANDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->brand, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="brands-update">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

	<div class="alert alert-danger">
		<?= Yii::t('app', 'WARNING_EDIT_TARGETS') ?>
	</div>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
