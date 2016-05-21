<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Userroles */

$this->title = Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_USERROLES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-create">

    <!-- <h1> -->
    	<?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
