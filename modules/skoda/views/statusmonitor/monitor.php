<meta http-equiv="Refresh" content="15" />

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
<div class="col-lg-12" style="text-align: center">
    <h1><?= Module::t('module', 'WELCOME_MSG') ?> </h1>
</div>
<div class="col-lg-12" style="text-align: center; margin-left: 40%;">
        <?php
            $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');

            $master_cons_today = Servicesheduler::find()
                ->where(['date' => $today])
                ->one();

            $provider_top = new ActiveDataProvider([
                'query' => User::find()->where(['full_name' => $master_cons_today->responsible])
                    ]);                          

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
        ?>
</div></div>
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
        // 'showHeader' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'attribute'=>'regnumber',

            ],
            [
                'attribute'=>'from',
                'contentOptions'=>['style'=>'width: 200px;'],
                'format' => 'time',

            ],
            [
                'attribute'=>'to',
                'contentOptions'=>['style'=>'width: 200px;'],
                'format' => 'time',

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
                'contentOptions'=>['style'=>'width: 300px;'],
            ],
        ],
    ]); ?>

<script type='text/javascript'>
    // QueryLoader.init();
</script>