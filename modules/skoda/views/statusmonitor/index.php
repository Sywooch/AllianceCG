<?php

use yii\helpers\Html;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\StatusmonitorSearch;
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
use yii\jui\AutoComplete;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\bootstrap\Alert;

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
            else if (confirm("Удалить отмеченные записи?")) {
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

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span>-->
            <?php Html::encode($this->title) ?>
    <!--</h1>-->
    <?php // $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">
    <!-- <div class="statusmonitor-index"> -->


    <p style="text-align: right">
        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('trash') . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  

        <?= Html::a(FA::icon('bar-chart') . Module::t('module', 'STATUS_SHOW_MONITOR'), ['monitor'], ['class' => 'btn btn-info btn-sm']) ?>

    </p>

    <?= Yii::$app->session->getFlash('error'); ?>
    
    <?php // Pjax::begin(); ?>    
    <?= 
        GridView::widget([
            'id' => 'statusmonitor-users-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model){
                $curdate = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
                $begindate = Yii::$app->formatter->asDate($model->from, 'yyyy-MM-dd');
                if($begindate >= $curdate){
                    return ['class' => 'success'];
                }
                else {
                    return ['class' => 'danger'];
                }
            },
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
                    'filter' => AutoComplete::widget([   
                                'model' => $searchModel,
                                'attribute' => 'regnumber',             
                                'clientOptions' => [
                                        'source' => $searchModel->rnautocomplete(),
                                ],
                                'options'=>[
                                    'class'=>'form-control'
                                ]
                            ]),
                     'contentOptions'=>['style'=>'width: 130px;'],
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
                    'template' => '{view}{update}{delete}',
                ],
            ],
        ]); 
    ?>
    
    <?php // Pjax::end(); ?>
    </div>
    
    
<script>
    $(document).ready(function(){
        var worker_today = "<?php echo $model->workerevent()?>";
        top.alert(worker_today);
    });
</script>