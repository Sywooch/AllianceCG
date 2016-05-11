<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use app\modules\admin\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */

$this->title = Module::t('module', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_DEPARTMENTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create">

    <!-- <h1> -->
    	<?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
