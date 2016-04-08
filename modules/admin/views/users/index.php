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
use rmrevin\yii\fontawesome\FA;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
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
        <?= Html::a(FA::icon('plus') . Module::t('module', 'ADMIN_USERS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(FA::icon('refresh') . Module::t('module', 'ADMIN_USERS_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>
    </p>

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
                'value'=>function($data) { return Html::img($data->imageurl,['height' => '50', 'class'=>'img-rounded']); },
                // 'contentOptions'=>['style'=>'width: 60px;'],
                'contentOptions' =>['class' => 'table_img','style'=>'width: 60px;'],
                
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'fullname',
                'format' => 'raw',    
                'value' => function ($data) {
                    return $data->getFullname();
                },
            ],
            [
                'attribute' => 'company',
                'contentOptions'=>['style'=>'width: 150px;'],
                'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'company', 'company'),
            ],
            [
                'attribute' => 'position',
                'contentOptions'=>['style'=>'width: 150px;'],
                'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'position', 'position'),
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
