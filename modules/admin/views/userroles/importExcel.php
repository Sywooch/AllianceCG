<?php
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'IMPORTEXCEL');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'USERROLES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a(Yii::t('app', '{icon} GO_BACK', ['icon' => '<i class="fa fa-arrow-circle-left"></i>']), ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
