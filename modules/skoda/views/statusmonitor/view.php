<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\Module;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use yii\bootstrap\Progress;
use app\modules\skoda\models\Servicesheduler;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

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
    // $to_date = Yii::$app->formatter->asDate($model->to, 'yyyy-MM-dd');
    // $wcs = Servicesheduler::find()
    //     ->where(['date' => $to_date])
    //     ->one();

    // $exc = new \yii\web\NotFoundHttpException('User not found');
    // $request = !empty($wcs->responsible) ? 'Yes' : $exc;
    // echo $request;

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'from',
            'to',
            // 'responsible',
            // [
            //     'attribute' => 'responsible',
            //     'value' => $model->getUserNameById(),
            // ],
            [
                'attribute' => 'worker',
                'value' => $model->getResponsible(),
            ],
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
