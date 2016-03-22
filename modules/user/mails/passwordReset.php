<?php
use yii\helpers\Html;
use app\modules\user\Module;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/password-reset', 'token' => $user->password_reset_token]);
?>
 
<?= Module::t('module', 'RESET_PASSWORD_HELLO') . ',  ' . Html::encode($user->full_name) . '! ' . Module::t('module', 'PASSWORD_RESET_GO_TO_LINK') ?>
 
<?= Html::a(Html::encode($resetLink), $resetLink) ?>