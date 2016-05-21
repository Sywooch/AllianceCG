<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\Positions;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view col-lg-10 col-lg-offset-1">
<!-- <div class="user-view"> -->

    <!--<h1>-->
        <?php // Html::img($model->getImageUrl(),['height' => '80', 'class'=>'img-rounded']) . ' &nbsp; ' . Html::encode($model->getAllname()) ?>
    <!--</h1>-->
    
    <p style="text-align: right;">
        <?= Html::a(FA::icon('list-ol') . ' ' . Yii::t('app', 'ADMIN_USERS'), ['/admin/users'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Yii::t('app', 'CREATE'), ['/admin/users/create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('pencil') . ' ' . Yii::t('app', 'ADMIN_USER_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Yii::t('app', 'ADMIN_USER_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Yii::t('app', 'ADMIN_USER_DELETE_CONFIRM'),
                'method' => 'post',
            ],
        ]) ?>        
    </p>    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [  
             [
                 'attribute'=>'photo',
                 'value'=>$model->getImageurl(),
                 'format' => ['image',['height'=>'80']],
             ],
            'username',
            // 'position',
            // [
            //     'attribute' => 'position',
            //     'value' => isset($model->positions->position) ? $model->positions->position : false,
            // ],
            [
                'attribute' => 'position',
                'format'=>'raw',
                'value' => $model->getPositionlink(),
                'visible' => !empty($model->positions->position) ? true : false,
            ],
            // [
            //     'attribute' => 'department',
            //     'value' => isset($model->departments->department_name) ? $model->departments->department_name : false,
            // ],
            [
                'attribute' => 'department',
                'format'=>'raw',
                'value' => $model->getDepartmentlink(),
                'visible' => !empty($model->departments->department_name) ? true : false,
            ],
            // [
            //     'attribute' => 'company',
            //     'value' => isset($model->companies->company_name) ? $model->companies->company_name : false,
            // ],
            [
                'attribute' => 'companies',
                'format'=>'raw',
                'value' => $model->getCompanylink(),
                'visible' => !empty($model->companies->company_name) ? true : false,
            ],
            // 'company',
            [
                'attribute' => 'email',
                'format' => 'email',
                // 'value' => $model->getEmailStatus(),
            ],
            [
                'attribute' => 'role',
                'value' => isset($model->userroles->role_description) ? $model->userroles->role_description : false,
                'visible' => isset($model->userroles->role_description) ? true : false,
                // 'value' => Yii::$app->user->identity->getRoleName(),
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
