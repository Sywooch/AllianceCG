<?php
use yii\helpers\Html;
use app\modules\alliance\Module;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl('alliance/creditcalendar/'.$id);
?>
 
<?= Module::t('module', 'NEW_CREDITCALENDAR_EVENT_TITLE') . $title ?>

<?= '<br/>' ?>

<?= Module::t('module', 'TIME_TO_WORK') . $dateTimeFrom . ' - ' . $dateTimeTo ?>

<?= '<br/>' ?>

<?= Module::t('module', 'EVENT_DESCRIPTION') . $description ?>

<?= '<br/>' ?>

<?= Module::t('module', 'FOR_VIEW_EVENT_PLEASE_GO') ?>
 
<?= Html::a(Html::encode($resetLink), $resetLink) ?>