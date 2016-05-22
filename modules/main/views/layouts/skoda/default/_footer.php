<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\modules\main\models\ContactForm;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
    use app\modules\skoda\Module;
?>
<!--Yii::$app->name--> 
<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <b>
                <!--&copy;--> 
            <?= Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36']) ?>
            <b>
            <?= 'СтрелаАвто' ?> 
        </b></p>

        <!--<p class="pull-right">-->
            <?php
//                echo Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36'])
            ?>
            <!--<b>-->
            <?php
//                echo Yii::$app->name 
            ?> 
        <!--</b></p>-->

<div class="pull-right">
            <?php
                echo Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36'])
            ?>
            <b>
            <?php
                echo 'Монитор готовности Skoda';
            ?> 
        </b></p>    
</div>
</footer>