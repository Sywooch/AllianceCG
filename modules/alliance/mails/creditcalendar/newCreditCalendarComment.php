<?php
use yii\helpers\Html;
use app\modules\alliance\Module;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$gotoLink = Yii::$app->urlManager->createAbsoluteUrl('alliance/creditcalendar/'.$id);
?>
 
<?= Module::t('module', 'NEW_CREDITCALENDAR_COMMENT') .' "'. $title . '"' ?>

<?= '<br/>' ?>

<?= Module::t('module', 'NEW_COMMENT_TEXT') . ': ' . $comment_text ?>

<?= '<br/>' ?>

<?= Module::t('module', 'FOR_FULLVIEW_EVENT_PLEASE_GO') ?>
 
<?= Html::a(Html::encode($gotoLink), $gotoLink) ?>