
<!--<meta http-equiv="Refresh" content="30" />-->

<!-- <link rel="stylesheet" href="/css/queryLoader.css" type="text/css"> -->
<!-- <script type='text/javascript' src='/js/queryLoader.js'></script> -->

<?php

use app\components\grid\ActionColumn;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\MonitorSearch;
use app\modules\skoda\models\Servicesheduler;
use app\components\grid\SetColumn;
use app\modules\user\models\User;
use app\modules\references\models\Employees;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\data\SqlDataProvider;
use yii\bootstrap\Progress;
use yii\widgets\Pjax;
use yii\web\View;

$this->title = Yii::t('app', 'STATUSMONITOR_TITLE');

$autoUpdate = file_get_contents('js/modules/skoda/statusmonitor/monitorPjaxUpdate.js');
$this->registerJs($autoUpdate, View::POS_HEAD);


?>

<?php 
    Pjax::begin([
            'id' => 'service_statusmonitor',
        ]) 
?>

<?php // echo Html::a("", ['/skoda/statusmonitor/monitor'], ['class' => 'hidden_button', 'id' => 'service_statusmonitor_refresh']) ?>

<div class="row">

    <?php
        $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');

        $master_cons_today = Servicesheduler::find()
            ->where(['date' => $today])
            ->one();

        echo '<div class="col-lg-12" style="text-align: center"><h1>';
        echo Yii::t('app', 'WELCOME_MSG');
        echo '</h1></div>';
                    
        if(!empty($master_cons_today->responsible)){
            $provider_top = new ActiveDataProvider([
                // 'query' => User::find()->where(['full_name' => $master_cons_today->responsible])
                'query' => Employees::find()->where(['id' => $master_cons_today->responsible])
                    ]);
            
                    echo '<div class="col-lg-12" style="text-align: center; margin-left: 40%;">';
                    echo ListView::widget([
                        'dataProvider' => $provider_top,
                        'layout' => '{items}',
                        'summary' => false,
                        'options' => [
                            'tag' => 'div',
                            'class' => 'tipochegi',
                            'id' => 'list-tipochegi',
                        ],
                        'itemView' => '_mc',
                    ]);                
                    echo '</div>';
        }
//        else {
//            $provider_empty = new ActiveDataProvider([
//                'query' => User::find()->where(['full_name' => ''])
//                    ]);
//                    echo '<div class="col-lg-12" style="text-align: center; margin-left: 40%;">';
//                    echo ListView::widget([
//                        'dataProvider' => $provider_empty,
//                        'layout' => '{items}',
//                        'summary' => false,
//                        'options' => [
//                            'tag' => 'div',
//                            'class' => 'tipochegi',
//                            'id' => 'list-tipochegi',
//                        ],
//                        'itemView' => '_mcempty',
//                    ]);                
//                    echo '</div>';            
//        }

    ?>
</div>

<div class="col-lg-12" style="text-align: center">                
        <?php
            $formatter = new \yii\i18n\Formatter;
            $formatter->timeZone = 'Europe/Minsk';
            $formatter->dateFormat = 'php:d.m.Y';
            $formatter->timeFormat = 'php:H:i:s';
            echo '<h3>' . $formatter->asDateTime('now') . '<h3>'
        ?>
</div>

<br/>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => "",
    'showOnEmpty' => false,
    // 'emptyText' => Yii::t('app', 'NO_RECORDS_FOUND'),
    'emptyText' => ' ',
    // 'emptyTextOptions' => ['class' => 'empty_grid label label-xs label-success col-md-offset-4', 'id' => 'empty_grid', 'style' => 'text-align: center'],
    'showHeader' => false,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'header' => '<h3>№</h3>',
            'contentOptions'=>['class' => 'bold_grid','style'=>'width: 20px;'],
        ],
        [
            'header' => '<h3>'. $searchModel->getAttributeLabel( 'regnumber' ) .'</h3>',
            'attribute'=>'regnumber',
            'contentOptions'=>['class' => 'bold_grid'],

        ],
        [
            'header' => '<h3>'. $searchModel->getAttributeLabel( 'from' ) .'</h3>',
            'attribute'=>'from',
            'contentOptions'=>['class' => 'bold_grid', 'style'=>'width: 200px;'],
            'format' => 'time',

        ],
        [
            'header' => '<h3>'. $searchModel->getAttributeLabel( 'to' ) .'</h3>',
            'attribute'=>'to',
            'contentOptions'=>['class' => 'bold_grid', 'style'=>'width: 200px;'],
            'format' => 'time',

        ],
        [
            'header' => '<h3>'. $searchModel->getAttributeLabel( 'carstatus' ) .'</h3>',
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
            'header' => '<h3>'. $searchModel->getAttributeLabel( 'progress' ) .'</h3>',
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
            'contentOptions'=>['class' => 'bold_grid', 'style'=>'width: 300px;'],
        ],
    ],
    'tableOptions' =>['class' => 'table'],
]); ?>

<?php Pjax::end() ?>

<script>
    // QueryLoader.selectorPreload = "body";
    // QueryLoader.init();
</script>