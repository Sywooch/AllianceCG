<?php

use yii\helpers\Html;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Companies */

$this->title = Module::t('module', 'ADMIN_COMPANIES_UPDATE') . ' ' . $model->company_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_COMPANIES_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'ADMIN_COMPANIES_UPDATE');
?>
<div class="companies-update">

    <h1>
    	<?php
    		// Html::encode($this->title) 
    	?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
