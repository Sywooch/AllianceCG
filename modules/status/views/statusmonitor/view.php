<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\status\models\Statusmonitor;
use app\modules\status\Module;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\modules\status\models\Statusmonitor */

$this->title = $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statusmonitor-view col-lg-5 col-lg-offset-3">

    <h1><span class="glyphicon glyphicon-comment" style='padding-right:10px;'></span><?= Module::t('module', 'STATUS_VIEW') . ' ' . Html::encode($this->title) ?></h1>

    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-tasks"></span>  ' . Module::t('module', 'STATUS_TITLE'), ['index'], ['class' => 'btn btn-warning', 'id' => 'refreshButton']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'STATUS_CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?php

?>

<?php
    // echo Yii::$app->formatter->asDate($model->from, 'php:yy-m-d')
// echo time($model->from, '%y:%m:%d')
    // echo $model->from('yyyy-MM-dd');
?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'from',
            'to',
            'responsible',
            [
                    'class' => SetColumn::className(),
                    'attribute' => 'carstatus', 
                    'value' => $model->getCarWorkStatus(),
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                            'Готово' => 'success',
                            'В работе' => 'danger',
                            'Ожидание' => 'warning',
                        ],
            ],
        ],
    ]) ?>

</div>
