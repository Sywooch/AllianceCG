<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\skoda\Module;
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

$this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_submenu') ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']); ?>
        
        <?= Html::a(FA::icon('upload') . ' ' . Module::t('module', 'RESTORE'), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']); ?>
        
        <?= Html::a(FA::icon('file-excel-o') . Module::t('module', 'STATUS_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>

    </p>
    
<?= Yii::$app->session->getFlash('error'); ?>    
    
    <?= GridView::widget([
        'id' => 'servicesheduler-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
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
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 80px;'],
            ],
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