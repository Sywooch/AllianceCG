<?php

// namespace app\components\grid;

use app\modules\admin\models\User;
use app\modules\admin\models\Userroles;
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
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-user" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <div class="user-index col-lg-offset-5 col-centered"> -->
    <div class="user-index center-block">

    <?php //Pjax::begin(); ?>


    <?= GridView::widget([
        'id' => 'admin-users-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'summary'=> "{begin} - {end} {count} {totalCount} {page} {pageCount}",
        'showFooter'=>true,
        'showHeader' => true,
        'summary' => false,
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
            // [
            //     'attribute' => 'company',
            //     'contentOptions'=>['style'=>'width: 150px;'],
            //     'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'company', 'company'),
            // ],
            [
                'attribute' => 'company',
                'value' => 'companies.company_name',
            ],
            // [
            //     'attribute' => 'position',
            //     'contentOptions'=>['style'=>'width: 150px;'],
            //     'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'position', 'position'),
            // ],
            [
                'attribute' => 'position',
                'value' => 'positions.position',
            ],
            // [
            //     'attribute' => 'role',
            //     'filter'=>ArrayHelper::map(Userroles::find()->asArray()->all(), 'role', 'role_description'),
            //     'contentOptions'=>['style'=>'width: 50px;'],  
            // ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'user_roles',
                'value' => 'userroles.role_description',
                'contentOptions'=>['style'=>'width: 50px;'],
                'filter'=>ArrayHelper::map(Userroles::find()->asArray()->all(), 'role_description', 'role_description'),    
                'cssCLasses' => 'success',
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
