<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */

$this->title = Yii::t('app', 'Create Servicesheduler');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Serviceshedulers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
