<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\models\Statusmonitor;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use yii\bootstrap\Progress;
use app\modules\skoda\models\Servicesheduler;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

    <p style="text-align: right">
        <?= Html::a(FA::icon('tasks') . ' ' . Yii::t('app', 'STATUS_TITLE'), ['calendar'], ['class' => 'btn btn-warning btn-sm', 'id' => 'refreshButton']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Yii::t('app', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Yii::t('app', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php 
            // Html::a(FA::icon('remove') . Yii::t('app', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger btn-sm',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'STATUS_CONFIRM_DELETE'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'regnumber',
            'from',
            'to',
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
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'authorname',
                'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>
