<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\ClientCirculation */

$this->title = Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CLIENTCIRCULATION'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-circulation-create">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
