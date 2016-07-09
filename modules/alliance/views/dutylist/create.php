<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Dutylist */

$this->title = Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dutylists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dutylist-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
