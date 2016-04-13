<?php

use yii\helpers\Html;
use app\modules\alliance\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = Module::t('module', 'CREDITCALENDAR_CREATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="creditcalendar-create">
<div class="user-form center-block">

    <h1>
        <?php Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>
</div>
