<?php

use yii\helpers\Html;
use app\modules\alliance\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

if(isset($_GET['is_task']) && $_GET['is_task'] == 0)
{
    $part_title = ' событие';
}
elseif(isset($_GET['is_task']) && $_GET['is_task'] == 1)
{
    $part_title = ' задание';
}
else
{
    $part_title = ' ';
}

$this->title = Module::t('module', 'CREDITCALENDAR_CREATE') . $part_title;
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
