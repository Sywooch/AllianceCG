<?php

use yii\helpers\Html;
use app\modules\references\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Models */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'MODELS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-create">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
