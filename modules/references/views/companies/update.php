<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Companies */

$this->title = Yii::t('app', 'ADMIN_COMPANIES_UPDATE') . ' ' . $model->company_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_COMPANIES_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'ADMIN_COMPANIES_UPDATE');
?>
<div class="companies-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
