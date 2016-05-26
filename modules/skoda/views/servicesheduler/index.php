<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\modules\skoda\models\Servicesheduler;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Alert;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $script = <<< JS
// $(document).ready(function() {
//     setInterval(function(){ $("#refreshButton").click(); }, 3000);
// });
// JS;
// $this->registerJs($script);

// $this->registerJs(' 

//     $(document).ready(function(){
//     $(\'#MultipleDelete\').click(function(){
//             var PosId = $(\'#servicesheduler-grid\').yiiGridView(\'getSelectedRows\');
//             if (PosId=="") {
//                 alert("Нет отмеченных записей!", "Alert Dialog");
//             }
//             else if (confirm("Удалить записи?")) {
//               $.ajax({
//                 type: \'POST\',
//                 url : \'/skoda/servicesheduler/multipledelete\',
//                 data : {row_id: PosId},
//                 success : function() {
//                     alert("successfully!!!");
//                 }
//               });
//             }
//     });
//     });', \yii\web\View::POS_READY);


$deleteRestore = file_get_contents('js/modules/skoda/servicesheduler/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

$this->title = Yii::t('app', 'SERVICESHEDULER_INDEX');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_submenu') ?>

    <p style="text-align: right">

        <?= Html::a(Yii::t('app', '{icon} STATUS_CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(Yii::t('app', '{icon} STATUS_REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']); ?>
        
        <?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']); ?>
        
        <?php // echo Html::a(Yii::t('app', '{icon} STATUS_EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>

    </p>
    
<?= Yii::$app->session->getFlash('error'); ?>    
    
    <?= GridView::widget([
        'id' => 'servicesheduler-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'summary' => false,
        'rowOptions' => function($model, $key, $index, $grid){
            $curdate = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
            if($model->date >= $curdate){
                return [
                    'class' => 'success',
//                    'id' => $model['date'] . ' - ' . $model['responsible'],
//                    'onclick' => 'alert(this.id);', 
                ];
            }
            else {
                return [
                    'class' => 'danger',
//                    'id' => $model['date'] . ' - ' . $model['responsible'],
//                    'onclick' => 'alert(this.id);',                    
                ];
            }
        },
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
                'attribute' => 'responsibles',
                // 'filter' => ArrayHelper::map(Servicesheduler::find()->asArray()->all(), 'responsible', 'responsible'),
                'format' => 'raw',
                'value' => 'responsibles.fullName',
            ],
            [
                'class' => SetColumn::className(),
                // 'filter' => Brands::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Servicesheduler::STATUS_ACTIVE => 'success',
                    Servicesheduler::STATUS_BLOCKED => 'danger',
                ],
            ],
            // [
            //     'class' => ActionColumn::className(),
            //     'contentOptions'=>['style'=>'width: 80px;'],
            // ],
        ],
//        'rowOptions' => function ($model, $key, $index, $grid) {
//            return [
//                    'id' => $model['date'] . ' - ' . $model['responsible'],
//                    'onclick' => 'alert(this.id);',
//                ];
//        },
//Onclick alert        
//        'rowOptions' => function ($model, $key, $index, $grid) {
//             return ['id' => $model['id'], 'onclick' => 'alert(this.id);'];
//        },
        
    ]); ?>

<script>
    var worker_today = "<?php echo $model->workerevent()?>";
    top.alert(worker_today);
</script>