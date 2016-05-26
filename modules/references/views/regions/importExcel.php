<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'IMPORTEXCEL');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a(FA::icon('arrow-circle-left') . ' ' . Yii::t('app', 'GO_BACK'), ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
