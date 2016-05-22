<?php 
    use yii\helpers\Html;
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
                // echo Html::img('@web/img/logo/alliance_logo.png', ['width'=>'36','height'=>'36'])
            echo Html::img('@web/img/logo/alliance_logo.png', ['height'=>'36'])
            ?>
            <b>
            <?php
                // echo Yii::$app->name 
            ?> 
        </b></p>
    </div>
</footer>