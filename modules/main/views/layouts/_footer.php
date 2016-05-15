<?php 
    use yii\helpers\Html;
    use app\modules\main\models\ContactForm;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    use yii\captcha\Captcha;
    use yii\bootstrap\Modal;
    use rmrevin\yii\fontawesome\FA;
    use app\modules\alliance\Module;
?>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy; 
            <?php
                echo 'Группа компаний "Альянс"'
            ?>
            <?php
                echo date('Y'); 
                echo Html::button(FA::icon('comment') . ' ' . Module::t('module', 'COMMENT'), ['value' => Url::to('/main/contact'), 'class' => 'btn btn-info btn-sm', 'id' => 'modalButton']);
            ?>
        </b></p>

        <p class="pull-right">
            <?php                
                echo Html::img('@web/img/logo/alliance_logo.png', ['height'=>'36'])
            ?>
        </p>

    </div>
</footer>

<?php
    Modal::begin([
        'header' => '<h4>' . Module::t('module', 'COMMENT') .'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

?>