<?php

// namespace app\components\grid;

use app\modules\admin\models\User;
use app\modules\user\models\User as Users;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_USERS');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <div class="user-index col-lg-offset-5 col-centered"> -->
    <div class="user-index center-block">

    <?php //Pjax::begin(); ?>

    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'ADMIN_USERS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'ADMIN_USERS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    </p>

    <?php
        // Pjax::begin();
        // $roles = Yii::$app->authManager->getRoles();
        // var_dump($roles);
        // $userroles = Yii::$app->authManager->getRolesByUser('1');
        // var_dump($userroles);
        // $userroles = Yii::$app->getAuthManager()->getRoles();
        // $userroles = Yii::$app->authManager->roles;
        // var_dump($userroles);
        // echo mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('y'));
    ?>

    <?= GridView::widget([
        'id' => 'admin-users-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'summary'=> "{begin} - {end} {count} {totalCount} {page} {pageCount}",
        'showFooter'=>true,
        'showHeader' => true,
        'layout'=>"{summary}\n{items}\n{pager}",
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'attribute' => 'photo',
                'filter' => false,
                'format' => 'raw',
                'value'=>function($data) { return Html::img($data->imageurl,['height' => '50']); },
                'contentOptions'=>['style'=>'width: 60px;'],
                
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'fullname',
                'format' => 'raw',    
                'value' => function ($data) {
                    return $data->getFullname();
                },
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            [
                'attribute' => 'company',
                'contentOptions'=>['style'=>'width: 150px;'],
            ],
            [
                'attribute' => 'position',
                'contentOptions'=>['style'=>'width: 150px;'],
            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'role',
                'filter' => User::getRolesArray(),
                'name' => 'role',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    User::ROLE_MANAGER => 'default',
                    User::ROLE_HEAD => 'success',
                    User::ROLE_ADMIN => 'warning',
                    User::ROLE_ROOT => 'danger',
                ],
            ],
            [
                'class' => SetColumn::className(),
                'filter' => User::getStatusesArray(),
                'attribute' => 'status',
                'name' => 'statusName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    User::STATUS_ACTIVE => 'success',
                    User::STATUS_WAIT => 'warning',
                    User::STATUS_BLOCKED => 'default',
                ],
            ],
            [
                'class' => ActionColumn::className(),
               'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $title = false;
                        $options = []; 
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
        ],
    ]); ?>

<?php 
    // Pjax::end(); 
?>    

</div>
