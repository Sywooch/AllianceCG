<?php
use yii\helpers\Html;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Module::t('module', 'IMPORTEXCEL');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a(FA::icon('arrow-circle-left') . ' ' . Module::t('module', 'GO_BACK'), ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
