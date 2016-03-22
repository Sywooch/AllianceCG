<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\Positions;
use app\modules\admin\Module;

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
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span>  ' . Module::t('module', 'ADMIN_USERS'), ['/admin/users'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span>  ' . Module::t('module', 'ADMIN_USER_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>  ' . Module::t('module', 'ADMIN_USER_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
            'created_at:datetime',
        ],
    ]) ?>

</div>
