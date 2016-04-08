<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\Positions;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view col-lg-10 col-lg-offset-1">
<!-- <div class="user-view"> -->

    <h1><?= Html::img($model->getImageUrl(),['height' => '80', 'class'=>'img-rounded']) . ' &nbsp; ' . Html::encode($model->getAllname()) ?></h1>
    
    <p style="text-align: right;">
        <?= Html::a(FA::icon('list-ol') . Module::t('module', 'ADMIN_USERS'), ['/admin/users'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('pencil') . Module::t('module', 'ADMIN_USER_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . Module::t('module', 'ADMIN_USER_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'ADMIN_USER_DELETE_CONFIRM'),
                'method' => 'post',
            ],
        ]) ?>        
    </p>    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [  
            // [
            //     'attribute'=>'photo',
            //     'value'=>$model->getImageurl(),
            //     'format' => ['image',['height'=>'80']],
            // ],
            'username',
            'position',
            'company',
            [
                'attribute' => 'email',
                'format' => 'email',
                // 'value' => $model->getEmailStatus(),
            ],
            [
                'attribute' => 'role',
                'value' => $model->getRolesName(),
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusName(),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
        ],
    ]) ?>

</div>
