<?php

use yii\helpers\Html;
use app\modules\references\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Targets */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'TARGETS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="targets-create">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>