<?php
use yii\helpers\Html;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<?= Html::a(FA::icon('arrow-circle-left') . ' ' . Module::t('module', 'GO_BACK'), ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
