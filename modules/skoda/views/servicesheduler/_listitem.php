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

    <div class="col-lg-12">
        <?= '<h4>' . FA::icon('user') . ' ' . HtmlPurifier::process($model->responsible) .'</h4>' ?>
    </div>  
    <div class="col-lg-12">
        <?= '<h5>' . FA::icon('calendar') . ' ' . HtmlPurifier::process($model->date) .'</h5>' ?>
    </div>    
