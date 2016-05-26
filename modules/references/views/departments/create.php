<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departments */

$this->title = Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_DEPARTMENTS'), 'url' => ['index']];
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
