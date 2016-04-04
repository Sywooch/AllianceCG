<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\Module;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use yii\bootstrap\Progress;
use app\modules\skoda\models\Servicesheduler;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

    <!--<h1><span class="glyphicon glyphicon-comment" style='padding-right:10px;'></span>-->
        <?php Module::t('module', 'STATUS_VIEW') . ' ' . Html::encode($this->title) ?>
    <!--</h1>-->

    <p style="text-align: right">
        <?= Html::a(FA::icon('tasks') . Module::t('module', 'STATUS_TITLE'), ['index'], ['class' => 'btn btn-warning btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('edit') . Module::t('module', 'STATUS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . Module::t('module', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'STATUS_CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'regnumber',
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
