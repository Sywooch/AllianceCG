<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\skoda\Module;
use yii\bootstrap\Nav;
use app\components\grid\LinkColumn;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\modules\skoda\models\Servicesheduler;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $script = <<< JS
// $(document).ready(function() {
//     setInterval(function(){ $("#refreshButton").click(); }, 3000);
// });
// JS;
// $this->registerJs($script);

$this->registerJs(' 

    $(document).ready(function(){
    $(\'#MultipleDelete\').click(function(){
            var PosId = $(\'#servicesheduler-grid\').yiiGridView(\'getSelectedRows\');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Удалить записи?")) {
              $.ajax({
                type: \'POST\',
                url : \'/skoda/servicesheduler/multipledelete\',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });', \yii\web\View::POS_READY);

$this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('masterConsultantDoesNotExistToday')): ?>
    
<?= Alert::widget([
        'options' => [
            'class' => 'alert-danger'
        ],
        'body' => Yii::$app->formatter->asDate('now', 'dd/MM/yyyy') . ' - ' . Module::t('module', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY'),
    ]);

elseif (Yii::$app->session->hasFlash('masterConsultantIs')) : ?>
    
<?= Alert::widget([
        'options' => [
            'class' => 'alert-success'
        ],
        'body' => Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Module::t('module', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsible,
    ]);

endif; ?>

<h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_submenu') ?>

    <p style="text-align: right">

        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

    </p>
    
<?= Yii::$app->session->getFlash('error'); ?>    

    <?= GridView::widget([
        'id' => 'servicesheduler-grid',
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
                'attribute' => 'date',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date',
                        'options' => ['class' => 'form-control']
                    ]),
                'contentOptions'=>['style'=>'width: 150px;']
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'responsible',
                'filter' => ArrayHelper::map(Servicesheduler::find()->asArray()->all(), 'responsible', 'responsible'),
                'format' => 'raw',  
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 80px;'],
            ],
        ],
    ]); ?>


</div>
