<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\Servicesheduler;
use app\modules\admin\models\User;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\skoda\Module;
use yii\bootstrap\Progress;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\status\models\StatusmonitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'STATUS_TITLE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
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

<?php if (Yii::$app->session->hasFlash('masterConsultantDoesNotExistToday')): ?>

    <div class="alert alert-danger">
        <?= Yii::$app->formatter->asDate('now', 'dd/MM/yyyy') . ' - ' . Module::t('module', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY') ?>
    </div>

<?php //endif; ?>

<?php elseif (Yii::$app->session->hasFlash('masterConsultantIs')) : ?>

    <div class="alert alert-success">
        <?= Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Module::t('module', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsible ?>
    </div>

<?php endif; ?>

    <h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    <?php // $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">
    <!-- <div class="statusmonitor-index"> -->


    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

        <?= Html::a('<span class="glyphicon glyphicon-screenshot"></span>  ' . Module::t('module', 'STATUS_SHOW_MONITOR'), ['monitor'], ['class' => 'btn btn-info']) ?>

    </p>

    <?= Yii::$app->session->getFlash('error'); ?>


    <?php // Pjax::begin(); ?>    
    <?= 
        GridView::widget([
            'id' => 'statusmonitor-users-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            // 'layout'=>"{pager}\n{summary}\n{items}\n{pager}",
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
                    'format' => 'raw',  
                    // 'contentOptions'=>['style'=>'width: 100px;'],
                ],
                [
                    'attribute' => 'from',
                    'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'from',
                            'options' => ['class' => 'form-control']
                        ]),
                    'format' => ['date', 'php:H:i:s d/m/Y'],
                    'contentOptions'=>['style'=>'width: 200px;'],                    
                ],
                [
                    'attribute' => 'to',
                    'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'to',
                            'options' => ['class' => 'form-control']
                        ]),   
                    'format' => ['date', 'php:H:i:s d/m/Y'],                 
                    'contentOptions'=>['style'=>'width: 200px;'],                    
                ],
                [
                    'attribute' => 'worker',
                    'format' => 'raw',
                    'filter' => ArrayHelper::map(Servicesheduler::find()->asArray()->all(), 'responsible', 'responsible'),
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
                            'options' => [
                                'class' => $data->getStatusBarAnimation(),
                            ]
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