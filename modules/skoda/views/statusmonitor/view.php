<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\Module;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Statusmonitor */

$this->title = $model->regnumber;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'STATUS_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statusmonitor-view col-lg-5 col-lg-offset-3">

    <h1><span class="glyphicon glyphicon-comment" style='padding-right:10px;'></span><?= Module::t('module', 'STATUS_VIEW') . ' ' . Html::encode($this->title) ?></h1>

    <p style="text-align: right">
        <?= Html::a('<span class="glyphicon glyphicon-tasks"></span>  ' . Module::t('module', 'STATUS_TITLE'), ['index'], ['class' => 'btn btn-warning', 'id' => 'refreshButton']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'STATUS_CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?php

?>

<?php
    // echo Yii::$app->formatter->asDate($model->from, 'php:yy-m-d')
// echo time($model->from, '%y:%m:%d')
    // echo $model->from('yyyy-MM-dd');
    // // 
    // $formatter = new \yii\i18n\Formatter;
    // $formatter->timeZone = 'UTC';

// echo date_default_timezone_get() . '<br/>';
// echo Yii::$app->formatter->asDateTime('2014-01-01 10:24:00', 'long') . '<br/>';
// echo date() . '<br/>';

    // echo Yii::$app->getFormatter()->asDatetime(time()) . '<br/>';
    // 
    // echo Yii::$app->formatter->asDatetime(date('Y-m-d h:i:s')) . '<br/>';
    // echo Yii::$app->getFormatter()->asDatetime($model->from) . '<br/>';
    // echo Yii::$app->getFormatter()->asDatetime($model->to) . '<br/>';



        // $today = Yii::$app->getFormatter()->asDatetime(time());
        
        // $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        // echo $today . '<br/>';

        // if (strtotime($today) < strtotime($model->from)){
        //     $percent = '0';
        // }
        // elseif (strtotime($today) >= strtotime($model->from) && strtotime($today) < strtotime($model->to)) {
        //     $datetime1 = $model->from;
        //     $datetime2 = $model->to;
        //     $diff1 = strtotime($datetime2) - strtotime($datetime1);
        //     $diff2 = strtotime($today) - strtotime($datetime1);            
        //     $percent = intval(($diff2 / $diff1) * 100);

        // }
        // elseif (strtotime($today) >= strtotime($model->to)) {
        //     $percent = '100';
        // }    

        // echo $percent;    


// $time = new \DateTime('now');
// $today = $time->format('Y-m-d');
// echo $today;
// $programs = Programs::find()->where(['>=', 'close_date', $today])->all();

?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'from',
            'to',
            // 'responsible',
            [
                'attribute' => 'responsible',
                'value' => $model->getUserNameById(),
            ],
            [
                    'class' => SetColumn::className(),
                    'attribute' => 'carstatus', 
                    'value' => $model->getCarWorkStatus(),
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                            'Готово' => 'success',
                            'В работе' => 'danger',
                            'Ожидание' => 'warning',
                        ],
            ],
        ],
    ]) ?>

</div>
