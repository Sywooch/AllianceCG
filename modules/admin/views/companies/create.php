<?php

use yii\helpers\Html;
use app\modules\admin\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Companies */

$this->title = Module::t('module', 'ADMIN_COMPANIES_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_COMPANIES_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
