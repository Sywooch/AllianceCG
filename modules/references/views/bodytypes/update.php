<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Bodytypes */

$this->title = Yii::t('app', 'UPDATE') . $model->body_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BODY_TYPES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->body_type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="bodytypes-update">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
