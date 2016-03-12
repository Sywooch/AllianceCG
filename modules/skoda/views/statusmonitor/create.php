<?php

use yii\helpers\Html;
use app\modules\skoda\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = Module::t('module', 'STATUS_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statusmonitor-create">

    <h1>
	    <?php 
	    	// Html::encode($this->title) 
	    ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
