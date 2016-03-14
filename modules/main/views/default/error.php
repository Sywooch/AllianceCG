<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\modules\main\Module;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?php Module::t('module', 'ERROR_OCCURED'); ?>
        <!-- The above error occurred while the Web server was processing your request. -->
    </p>
    <p>
        <?php Module::t('module', 'PLEASE_CONTACT'); ?>
        <!-- Please contact us if you think this is a server error. Thank you. -->
    </p>

</div>
