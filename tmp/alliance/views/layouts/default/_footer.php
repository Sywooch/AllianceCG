<?php 
    use yii\helpers\Html;
    use app\modules\main\models\ContactForm;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    use yii\captcha\Captcha;
?>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy; 
            <?php
                echo 'Группа компаний "Альянс"'
            ?>
            <?php
                echo date('Y') 
            ?>
        </b></p>

        <p class="pull-right">
            <?php                
                echo Html::img('@web/img/logo/alliance_logo.png', ['height'=>'36'])
            ?>
        </p>

    </div>
</footer>