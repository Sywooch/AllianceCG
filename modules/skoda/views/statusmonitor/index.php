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
use app\modules\skoda\Module as curmodule;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\status\models\StatusmonitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = curmodule::t('module', 'STATUS_TITLE');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(' 

    $(document).ready(function(){
    $(\'#MultipleDelete\').click(function(){
            var PosId = $(\'#statusmonitor-users-grid\').yiiGridView(\'getSelectedRows\');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Are you sure you want to delete this?")) {
              $.ajax({
                type: \'POST\',
                url : \'/skoda/statusmonitor/multipledelete\',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });', \yii\web\View::POS_READY);


?>

    <h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">
    <!-- <div class="statusmonitor-index"> -->


    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . curmodule::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . curmodule::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . curmodule::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

        <?= Html::a('<span class="glyphicon glyphicon-screenshot"></span>  ' . curmodule::t('module', 'STATUS_SHOW_MONITOR'), ['monitor'], ['class' => 'btn btn-info']) ?>

    </p>

    <?= Yii::$app->session->getFlash('error'); ?>


    <?php // Pjax::begin(); ?>    
    <?= 
        GridView::widget([
            'id' => 'statusmonitor-users-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
                    'class' => LinkColumn::className(),
                    'attribute' => 'regnumber',
                    'filter' => false,
                    'format' => 'raw',  
                    // 'contentOptions'=>['style'=>'width: 100px;'],
                ],
                [
                    'attribute' => 'from',
                    'filter' => false,    
                    'format' => ['date', 'php:H:i:s d/m/Y'],
                    'contentOptions'=>['style'=>'width: 200px;'],                    
                ],
                [
                    'attribute' => 'to',
                    'filter' => false,      
                    'format' => ['date', 'php:H:i:s d/m/Y'],                 
                    'contentOptions'=>['style'=>'width: 200px;'],                    
                ],
                [
                    'attribute' => 'worker',
                    'filter' => false,
                    'format' => 'raw',    
                    'value' => function ($data) {
                        return $data->getResponsible();
                    },

                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'carstatus',
                    'filter' => false,
                    'format' => 'raw',    
                    'value' => function ($data) {
                        return $data->getCarWorkStatus();
                    },
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                            'Готово' => 'success',
                            'В работе' => 'danger',
                            'Ожидание' => 'warning',
                        ],
                ],
                [
                    'attribute' => 'progress',
                    'content' => function($data) {
                        return Progress::widget([
                            'percent' => $data->getPercentStatusBar(),
                            'label' => $data->getPercentStatusBar(),
                            'barOptions' => [
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
        ]); 
    ?>
    
    <?php // Pjax::end(); ?>
    </div>