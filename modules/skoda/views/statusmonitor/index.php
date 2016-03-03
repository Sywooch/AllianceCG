<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\admin\models\User;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\skoda\Module;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\status\models\StatusmonitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'STATUS_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">
    <!-- <div class="statusmonitor-index"> -->


    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'STATUS_DELETE'),'users/massdelete', [
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

// if (Yii::$app->user->can('admin')) {
//     echo 'Hello, Admin!';
// } 
// elseif (Yii::$app->user->can('head')) {
//     echo 'Hello, Head!';
// } 
// elseif (Yii::$app->user->can('root')) {
//     echo 'Hello, root!';
// } 
// elseif (Yii::$app->user->can('manager')) {
//     echo 'Hello, manager!';
// }
// else {
//     echo 'unknown role!';
// }    
echo Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
    ?>

    <?php Pjax::begin(); ?>    
    <?= 
        GridView::widget([
            'id' => 'statusmonitor-users-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
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
                    'class' => LinkColumn::className(),
                    'attribute' => 'regnumber',
                    'filter' => false,
                    'format' => 'raw',  
                    // 'contentOptions'=>['style'=>'width: 100px;'],
                ],
                [
                    'attribute' => 'from',
                    'filter' => false,                    
                    'contentOptions'=>['style'=>'width: 130px;'],                    
                ],
                [
                    'attribute' => 'to',
                    'filter' => false,                    
                    'contentOptions'=>['style'=>'width: 130px;'],                    
                ],
                // [
                //     'attribute' => 'worker',
                //     'filter' => false,
                //     'format' => 'raw',    
                //     'value' => function ($data) {
                //         return $data->getResponsible();
                //     },

                // ],
                [
                    'attribute' => 'responsible',
                    'filter' => false,
                    'format' => 'raw',    
                    'value' => function ($data) {
                        return $data->getUserNameById();
                    },
                ],
                // [
                //     'class' => SetColumn::className(),
                //     'filter' => false,
                //     'attribute' => 'status',
                //     'name' => 'statusName',
                //     'contentOptions'=>['style'=>'width: 50px;'],
                //     'cssCLasses' => [
                //         Statusmonitor::STATUS_FINISHED => 'success',
                //         Statusmonitor::STATUS_ATWORK => 'danger',
                //         Statusmonitor::STATUS_WAIT => 'default',
                //     ],
                // ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'carstatus',
                    'filter' => false,
                    'format' => 'raw',    
                    'value' => function ($data) {
                        // return Html::img(Yii::$app->request->BaseUrl.'/'.$data->photo,
                        // ['width' => '50px']);
                        // return Html::img($data->getFullname(), ['class' => 'user_title_grid']);
                        return $data->getCarWorkStatus();
                    },
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                            'Готово' => 'success',
                            'В работе' => 'danger',
                            'Ожидание' => 'warning',
                        ],
                    // 'contentOptions'=>['style'=>'width: 100px;'],
                ],
                [
                    'attribute' => 'progress',
                    'content' => function($data) {
                        return Progress::widget([
                            // 'percent' => 60,
                            'percent' => $data->getPercentStatusBar(),
                            'label' => $data->getPercentStatusBar(),
                            'barOptions' => [
                                // 'class' => 'progress-bar-danger',
                                'class' => $data->getColorStatusBar(),
                            ],
                        ]);
                    },
                    'contentOptions'=>['style'=>'width: 100px;'],
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
            ],
        ]); 
    ?>
    
    <?php Pjax::end(); ?>
    </div>