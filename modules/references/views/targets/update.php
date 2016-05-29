<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Targets */

$this->title = Yii::t('app', 'UPDATE') . $model->target;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TARGETS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->target, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="targets-update">

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
