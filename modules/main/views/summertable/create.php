<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\main\models\Summertable */

$this->title = Yii::t('app', 'Create Summertable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Summertables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="summertable-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
