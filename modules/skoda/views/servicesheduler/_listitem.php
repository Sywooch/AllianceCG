<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;
    use app\modules\user\models\User;
    use rmrevin\yii\fontawesome\FA;
?>

<?php 
    $model->date = Yii::$app->formatter->asDate($model->date , 'dd/MM/yyyy');
?>

<!--<div class="statusmonitorlist-item">-->
        <div class="col-md-4 statusmonitor-list">
            <?= FA::icon('calendar') . ' ' . $model->date; ?>
        </div>
        <!--<div class="col-md-4 statusmonitor-list">-->
            <?php Html::img('@web/img/logo/avatar.jpeg', ['class'=>'img-thumbnail']);?> 
            <?php 'lol!'; ?>
        <!--</div>-->
        <div class="col-md-8 statusmonitor-list">
            <?= Html::img('@web/img/logo/avatar.jpeg', ['class'=>'img-thumbnail', 'width'=>'30px']) . ' ' . $model->responsible; ?>
        </div>
<!--</div>-->