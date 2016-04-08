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
    use yii\widgets\DetailView;
?>

<?php 
    $model->date = Yii::$app->formatter->asDate($model->date , 'dd/MM/yyyy');
?>

<!--<div class="col-lg-12">-->
<div class="servicesheduler-list alert-info" id="ss-list">
            <?= '<h4>' . FA::icon('user') . ' ' . $model->getAttributeLabel('responsible') . ': ' . HtmlPurifier::process($model->responsible) .'</h4>' ?>
            <?= '<h5>' . FA::icon('calendar') . ' ' . $model->getAttributeLabel('date') . ': ' . HtmlPurifier::process($model->date) .'</h5>' ?>
        </div>
    <!--</div>-->