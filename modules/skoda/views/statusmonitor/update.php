<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = Yii::t('app', 'STATUS_UPDATE') . ': ' . $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->regnumber, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'STATUS_UPDATE');
?>
<div class="statusmonitor-update">

    <h1>
    	<?php
    		// Html::encode($this->title) 
    	?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
