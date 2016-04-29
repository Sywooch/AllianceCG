<?php

use yii\helpers\Html;
use app\modules\alliance\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = Yii::t('app', 'Create Creditcalendar');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditcalendar-create">

<!--    <h1>-->
        <?php // echo Html::encode($this->title) ?>
<!--    </h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
