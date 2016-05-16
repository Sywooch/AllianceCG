<?php

use yii\helpers\Html;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Regions */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-create">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
