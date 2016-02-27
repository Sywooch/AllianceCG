
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>
<link rel="stylesheet" href="css/queryLoader.css" type="text/css" />
<script type='text/javascript' src='js/queryLoader.js'></script>

<meta http-equiv="Refresh" content="15" />

<?php

use app\components\grid\ActionColumn;
use app\modules\status\models\Statusmonitor;
use app\modules\status\models\StatusmonitorSearch;
use app\components\grid\SetColumn;
use app\modules\user\models\User;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\status\Module;
use yii\data\SqlDataProvider;
use yii\bootstrap\Progress;

// $script = <<< JS
// $(document).ready(function() {
//     setInterval(function(){ $("#refreshButton").click(); }, 120000);
// });
// JS;
// $this->registerJs($script);


$mc_id_sql = 'SELECT responsible FROM `sk_statusmonitor` where DATE(`from`)=CURDATE() or DATE(`to`)=CURDATE();';
$sm = Statusmonitor::findBySql($mc_id_sql)->one();

// $mc_data_sql = 'SELECT * FROM `sk_user` where id = '. $sm->responsible . ';';
// $mc = User::findBySql($mc_data_sql)->one();


$listData = new ActiveDataProvider([
    'query' => User::find()->where(['id' => (string)$sm->responsible]),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

$cars = new SqlDataProvider([
    'sql' => 'SELECT * FROM `sk_statusmonitor` where DATE(`from`)=CURDATE() or DATE(`to`)=CURDATE();',
    // 'params' => [':author' => 'Arno Slatius'],
]);

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
                    <?= Yii::$app->formatter->asTime('now', 'php:H:i:s'); ?>
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
            <div class="col-lg-5" style="text-align: center">
                    <?php
                    
                        echo ListView::widget([
                            'dataProvider' => $listData,
                            'layout' => '{items}',
                            'summary' => false,
                            'options' => [
                                'tag' => 'div',
                                'class' => 'list-wrapper',
                                'id' => 'list-wrapper',
                            ],
                            'itemView' => '_mc',
                        ]);
                    ?>
            </div>
        </div>

<br/>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "",
        'showHeader' => false,
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
                // 'format' => $data->getFromDateFormat(),

                // 'format' => function ($data) {
                //     return $data->getFromDateFormat();
                // },

            ],
            [
                'attribute'=>'to',
                'contentOptions'=>['style'=>'width: 200px;']

            ],
            // 'from',
            // 'to',
            // 'carstatus',
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
                        // 'percent' => 60,
                        'percent' => $data->getPercentStatusBar(),
                        'label' => $data->getPercentStatusBar(),
                        'barOptions' => [
                            // 'class' => 'progress-bar-danger',
                            'class' => $data->getColorStatusBar(),
                        ],
                    ]);
                },
                'contentOptions'=>['style'=>'width: 300px;'],
            ],
        ],
    ]); ?>

<div class="jumbotron col-lg-5 col-lg-offset-3" style="margin-top: 1px">



</div>

<?php Pjax::end(); ?>


// <script type='text/javascript'>
// QueryLoader.init();
// </script>