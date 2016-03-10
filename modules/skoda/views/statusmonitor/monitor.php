
<!-- <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script> -->
<!-- <link rel="stylesheet" href="css/queryLoader.css" type="text/css" /> -->
<!-- <script type='text/javascript' src='js/queryLoader.js'></script> -->

<meta http-equiv="Refresh" content="15" />

<?php

use app\components\grid\ActionColumn;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\MonitorSearch;
use app\modules\skoda\models\Servicesheduler;
use app\components\grid\SetColumn;
use app\modules\user\models\User;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\skoda\Module;
use yii\data\SqlDataProvider;
use yii\bootstrap\Progress;

$this->title = Module::t('module', 'STATUSMONITOR_TITLE');

// echo Yii::$app->controller->module->id;

// $script = <<< JS
// $(document).ready(function() {
//     setInterval(function(){ $("#refreshButton").click(); }, 120000);
// });
// JS;
// $this->registerJs($script);

?>

<?php Pjax::begin(); ?>
<?= Html::a("Refresh", ['index'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton', 'style' => 'display: none']) ?>

        <div class="row">
            <div class="col-lg-4" style="text-align: center">
                <h2>
                    <?= Yii::$app->params['org'] . '' ?>
                </h2>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h2>
                    <?= Yii::$app->formatter->asDate('now', 'php:d.m.Y'); ?>
                </h2>

                <h2>
                    <?php
                        $formatter = new \yii\i18n\Formatter;
                        $formatter->dateFormat = 'php:H:i';
                        $formatter->timeZone = 'Europe/Minsk';
                        echo $formatter->asTime('now');
                    ?>
                </h2>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h2>
                    <?= Yii::$app->params['brand'] . '' ?>
                </h2>
                <!-- <h2> -->
                    <?php // echo Html::img('@web/img/logo/logo.png', ['width'=>'70']) ?>
                <!-- </h2> -->
            </div>
            </div><div class="row">
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
                'contentOptions'=>['style'=>'width: 60px;'],
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

<div class="jumbotron col-lg-5 col-lg-offset-3" style="margin-top: 1px">



</div>

<?php Pjax::end(); ?>


<script type='text/javascript'>
    // QueryLoader.init();
</script>