<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Clientcirculationcomment */

$this->title = Yii::t('app', 'Create Clientcirculationcomment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientcirculationcomments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientcirculationcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
