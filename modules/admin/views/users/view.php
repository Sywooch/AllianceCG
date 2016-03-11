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
<div class="user-view col-lg-5 col-lg-offset-3">

    <h1>
        <?php
            // Html::encode($this->title) 
        ?>
    </h1>

    
<table style="margin-bottom: 30px;">
  <tr>
    <th colspan="2"><h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= Html::encode($model->getAllname()) ?></h1></th>
  </tr>
  <tr>
    <td><?= Module::t('module', 'ADMIN_WHERE_USER_CREATED') ?></td>
    <td><?= Yii::$app->formatter->asDate($model->created_at, 'dd/MM/yyyy'); ?></td>
  </tr>
</table>
    
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
            // 'id',
            // 'created_at',
            // 'updated_at',   
            [
                'attribute'=>'photo',
                'value'=>$model->getImageurl(),
                'format' => ['image',['height'=>'80']],
            ],
            'username',
            'position',
            'company',
            // [
            //     'attribute' => 'position',
            //     'value' => $model->getPositionByPk(),
            // ],
            // 'auth_key',
            // 'email_confirm_token:email',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            [
                'attribute' => 'email',
                'format' => 'email',
                // 'value' => $model->getEmailStatus(),
            ],
            // 'status',
            [
                'attribute' => 'role',
                'value' => $model->getRolesName(),
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusName(),
            ],
        ],
    ]) ?>

</div>
