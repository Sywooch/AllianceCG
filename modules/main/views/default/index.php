<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;


/* @var $this yii\web\View */

$this->title = Yii::$app->name;;
?>
<div class="row">
    <div class="col-md-4">
        <?php // FA::icon('home')->size(FA::SIZE_5X) ?>    
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>

<?= Yii::$app->user->identity->usercompany; ?>