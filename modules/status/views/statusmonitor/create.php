<?php

use yii\helpers\Html;
use app\modules\status\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\status\models\Statusmonitor */

$this->title = Module::t('module', 'STATUS_CREATE');
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
