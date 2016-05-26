<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Companies */

$this->title = Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'COMPANIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
