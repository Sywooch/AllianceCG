<?php

// namespace app\components\grid;

use app\modules\admin\models\User;
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
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <div class="user-index col-lg-offset-5 col-centered"> -->
    <div class="user-index center-block">

    <?php //Pjax::begin(); ?>

    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'ADMIN_USERS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'ADMIN_USERS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'ADMIN_USERS_DELETE'),'users/massdelete', [
                'class' => 'btn btn-danger',
                'title' => Module::t('module', 'Close'),
                    'onclick'=>"$('#close').dialog('open');
                    $.ajax({
                    type     :'POST',
                    cache    : false,
                    url  : 'users/massdelete',
                    success  : function(response) {
                        $('#close').html(response);
                    }
                    });return false;",
            ]);
        ?>            

    </p>

    <?php
        // Pjax::begin();
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
            // [
            //     'filter' => DatePicker::widget([
            //         'model' => $searchModel,
            //         'attribute' => 'date_from',
            //         'attribute2' => 'date_to',
            //         'type' => DatePicker::TYPE_RANGE,
            //         'separator' => '-',
            //         'pluginOptions' => ['format' => 'yyyy-mm-dd']
            //     ]),
            //     'attribute' => 'created_at',
            //     'format' => 'datetime',
            //     'contentOptions'=>['style'=>'max-width: 100px;'],
            // ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'fullname',
                'filter' => false,
                'format' => 'raw',    
                'value' => function ($data) {
                    // return Html::img(Yii::$app->request->BaseUrl.'/'.$data->photo,
                    // ['width' => '50px']);
                    // return Html::img($data->getFullname(), ['class' => 'user_title_grid']);
                    return $data->getFullname();
                },
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            [
                'attribute' => 'photo',
                'filter' => false,
                'format' => 'raw',
                'value'=>function($data) { return Html::img($data->imageurl,['height' => '50']); },
                'contentOptions'=>['style'=>'width: 60px;'],
                
            ],
            // 'position',
            [
                'attribute' => 'position',
                'filter' => false,   
                'contentOptions'=>['style'=>'width: 50px;'],
            ],
            [
                'class' => SetColumn::className(),
                // 'filter' => User::getStatusesArray(),
                'filter' => false,
                'attribute' => 'status',
                'name' => 'statusName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    User::STATUS_ACTIVE => 'success',
                    // User::STATUS_WAIT => 'warning',
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
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        // return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php 
    // Pjax::end(); 
?>    

</div>
