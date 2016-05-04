<?php 
    use yii\helpers\Html;
    use app\modules\main\models\ContactForm;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use app\modules\alliance\Module;
    use rmrevin\yii\fontawesome\FA;
    use yii\captcha\Captcha;
?>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy; 
            <?php
                echo 'Группа компаний "Альянс"'
            ?>
            <?php
                echo date('Y');
                echo '<br/>';
                // echo Html::button(FA::icon('comment') . ' ' . Module::t('module', 'COMMENT'), ['value' => Url::to(['comment']), 'class' => 'btn btn-link', 'id' => 'modalButton']);

                Modal::begin([
                    'header' => '<h4>' . Module::t('module', 'COMMENT') .'</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg'
                ]);

                echo "<div id='modalContent'></div>";

                Modal::end();

            ?>
        </b></p>

        <p class="pull-right">
            <?php                
                echo Html::img('@web/img/logo/alliance_logo.png', ['height'=>'36'])
            ?>
        </p>

    </div>
</footer>