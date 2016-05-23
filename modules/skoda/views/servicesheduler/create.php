<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = Yii::t('app', 'SERVICESHEDULER_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SERVICESHEDULER_INDEX'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-create ">
<div class="user-form center-block">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>