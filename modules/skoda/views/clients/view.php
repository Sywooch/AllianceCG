<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Clients */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-view">

    <p>
        <?php
            // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) 
        ?>
        <?php
            // Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'Confirm'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'clientFullName',
                'value' => $model->getClientfullname(),
            ],
            // 'clientName',
            // 'clientSurname',
            // 'clientPatronymic',
            'clientPhone',
            'clientEmail:email',
            'clientDepartment',
            // 'clientBithdayDate',
            [
                'attribute' => 'clientBithdayDate',
                'format' => ['date', 'php:d/m/Y']
            ],
            // 'state',
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d/m/Y H:m:i'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d/m/Y H:m:i'],
            ],
            [
                'attribute' => 'author',
                'value' => $model->authorname->full_name,
            ],
            // 'author',
        ],
    ]) ?>

</div>
