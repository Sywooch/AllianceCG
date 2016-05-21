<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->registerCssFile('@web/css/landing_login.css', ['depends' => ['app\assets\AppAsset']]);  

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error error-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?php Yii::t('app', 'ERROR_OCCURED'); ?>
        <!-- The above error occurred while the Web server was processing your request. -->
    </p>
    <p>
        <?php Yii::t('app', 'PLEASE_CONTACT'); ?>
        <!-- Please contact us if you think this is a server error. Thank you. -->
    </p>

</div>
