<?php

use app\modules\status\models\Statusmonitor;
use app\modules\user\models\User;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);

$mc_id_sql = 'SELECT responsible FROM `sk_statusmonitor` where DATE(`from`)=CURDATE() or DATE(`to`)=CURDATE();';
$sm = Statusmonitor::findBySql($mc_id_sql)->one();

// $mc_data_sql = 'SELECT * FROM `sk_user` where id = '. $sm->responsible . ';';
// $mc = User::findBySql($mc_data_sql)->one();


$dataProvider = new ActiveDataProvider([
    'query' => User::find()->where(['id' => (string)$sm->responsible]),
    'pagination' => [
        'pageSize' => 20,
    ],
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
                <h2>
                    <?php echo Html::img('@web/img/logo/logo.png', ['width'=>'70']) ?>
                </h2>
            </div>
            <div class="col-lg-5" style="text-align: center">
                    <?php
                    
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
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

<div class="jumbotron col-lg-5 col-lg-offset-3" style="margin-top: 1px">

<?php

    // echo ListView::widget([
    //     'dataProvider' => $dataProvider,
    //     'layout' => '{items}',
    //     'summary' => false,
    //     'options' => [
    //         'tag' => 'div',
    //         'class' => 'list-wrapper',
    //         'id' => 'list-wrapper',
    //     ],
    //     'itemView' => '_mc',
    // ]);

// <---->

// echo ListView::widget([
//         'dataProvider' => $mc,
//         'layout' => '{items}',
//         'summary' => false,
//         'options' => [
//             'tag' => 'div',
//             'class' => 'list-wrapper',
//             'id' => 'list-wrapper',
//         ],
//     ]);

?>

</div>

<?php Pjax::end(); ?>