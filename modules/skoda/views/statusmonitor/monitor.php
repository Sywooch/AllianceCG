
<meta http-equiv="Refresh" content="30" />

<link rel="stylesheet" href="/css/queryLoader.css" type="text/css">
<script type='text/javascript' src='/js/queryLoader.js'></script>

<?php

use app\components\grid\ActionColumn;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\MonitorSearch;
use app\modules\skoda\models\Servicesheduler;
use app\components\grid\SetColumn;
use app\modules\user\models\User;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\skoda\Module;
use yii\data\SqlDataProvider;
use yii\bootstrap\Progress;

$this->title = Module::t('module', 'STATUSMONITOR_TITLE');

?>

<div class="row">

    <?php
        $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');

        $master_cons_today = Servicesheduler::find()
            ->where(['date' => $today])
            ->one();

        if(!empty($master_cons_today->responsible)){
            $provider_top = new ActiveDataProvider([
                'query' => User::find()->where(['full_name' => $master_cons_today->responsible])
                    ]);                          
    
                    echo '<div class="col-lg-12" style="text-align: center"><h1>';
                    echo Module::t('module', 'WELCOME_MSG');
                    echo '</h1></div>';


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
    'emptyText' => Module::t('module', 'NO_RECORDS_FOUND'),
    'emptyTextOptions' => ['class' => 'empty_grid label label-xs label-success col-md-offset-4', 'id' => 'empty_grid', 'style' => 'text-align: center'],
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

<script>
    // QueryLoader.selectorPreload = "body";
    // QueryLoader.init();
</script>