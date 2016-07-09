<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
use app\modules\alliance\models\Dutylist;
use app\modules\references\models\Employees;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\DutylistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dutylists');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$modal = file_get_contents('js/modules/alliance/dutylist/modal.js');
$MultipleDeactivate = file_get_contents('js/modules/alliance/dutylist/deleteRestore.js');
$ExportExcel = file_get_contents('js/modules/alliance/dutylist/gridViewExcelExport.js');
$multipleDelete = file_get_contents('js/modules/alliance/dutylist/gridViewMultipleDelete.js');
// $toggleAdvanced = file_get_contents('js/modules/alliance/dutylist/toggleAdvanced.js');
// $this->registerJs($toggleAdvanced, View::POS_END);
$this->registerJs($MultipleDeactivate, View::POS_END);
$this->registerJs($ExportExcel, View::POS_END);
$this->registerJs($multipleDelete, View::POS_END);
$this->registerJs($modal);

?>
<div class="dutylist-index">

<?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Таблица',
                'url' => ['/alliance/dutylist/index'],
                'active' => true
            ],
            [
                'label' => 'Календарь',
                'url' => ['/alliance/dutylist/calendar'],
                'active' => false
            ],
        ]
    ]);
?>

<br/>

    <p class="buttonpane">
        <?php
             $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                                    'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/alliance/dutylist/create')
                                ]) : false;
             echo $createButton;    

        ?>
                
        <?= Html::a(Yii::t('app', '{icon} DEACTIVATE', ['icon' => '<i class="fa fa-remove"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDeactivate']); ?>
                
        <?= Html::a(Yii::t('app', '{icon} ACTIVATE', ['icon' => '<i class="fa fa-upload"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleActivate']); ?>

        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-trash"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']); ?>        

        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>

        <?= Html::a(Yii::t('app', '{icon} CREDITCALENDAR_EXPORT_EXCEL', ['icon' =>'<i class="fa fa-file-excel-o"></i>'] ), ['export'], [
                'id' => 'Excel',
                'class' => 'btn btn-link animlink',
                'onclick' => 'setParams()',
                'data' => [
                    'method' => 'post',
                    'confirm' => Yii::t('app', 'CREDITCALENDAR_EXPORT_CONFIRM'),
                ]
             ]);
        ?>

        <?php // echo Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => '<i class="fa fa-file-excel-o"></i>']), ['class' => 'btn-link animlink', 'id' => 'advancedOperations']) ?>

    </p>

<?php Pjax::begin(['id' => 'dutylist']); ?>    

<div class="panel panel-default">
    <div class="panel-heading" style="padding-top: 25px;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="panel-body">
        <?php 
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' => false,
                'id' => 'dutylist-grid',
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => '№',
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'contentOptions'=>['style'=>'width: 20px;']
                    ],

                    // 'id',
                    // 'employee_id',       
                    // [
                    //     'class' => LinkColumn::className(),
                    //     'attribute' => 'employee',
                    //     'format' => 'raw',
                    //     'attribute' => 'employee',
                    //     'value' => function ($data) {
                    //         return $data->getEmployeeName();
                    //     },
                    // ],     
                    [
                        'attribute' => 'employee',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return'<i class="fa fa-user"></i> ' .  $data->getEmployeeName();
                        },
                    ],
                    // 'date',
                    [ 
                        'attribute' => 'date',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 250px;', 'class' => 'text-center'],
                        'filter' =>  DatePicker::widget([
                                'model' => $model,
                                'type' => DatePicker::TYPE_INPUT,
                                'attribute' => 'date',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayBtn' => true,
                                        'todayHighlight' => true,
                                        'clearButton'    => true,
                                    ],
                            ]),
                        'value' => function ($data) {
                            return '<i class="fa fa-calendar"></i> ' . date("d/m/Y",  strtotime($data->date));
                        },
                    ],
                    [
                        'class' => SetColumn::className(),
                        'filter' => Dutylist::getStatesArray(),
                        'attribute' => 'state',
                        'visible' => Yii::$app->user->can('admin'),
                        'name' => 'statesName',
                        'contentOptions'=>['style'=>'width: 100px;'],
                        'cssCLasses' => [
                            Dutylist::STATUS_ACTIVE => 'success',
                            Dutylist::STATUS_BLOCKED => 'danger',
                        ],
                    ],

                    // [
                    //     'attribute' => 'state',
                    // ],

                    // [
                    //     'class' => 'yii\grid\ActionColumn'
                    // ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Действия',
                        'buttons'=>[
                            'view'=>function($url,$model){
                                    $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/alliance/dutylist/view','id'=>$model->id]);
                                    return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', '#mymodal', [
                                            'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                        ]);
                                },
                            'update'=>function($url,$model){
                                    $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/alliance/dutylist/update','id'=>$model->id]);
                                    return \yii\helpers\Html::a('<i class="fa fa-pencil"></i>', '#mymodal', [
                                            'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                        ]);
                                },
                            'delete' => function ($url, $model) {
                                return Html::a(
                                    '<i class="fa fa-trash"></i>',
                                    $url=Url::to(['/alliance/dutylist/delete','id'=>$model->id], ['data' => ['confirm' => Yii::t('app', 'Delete?'), 'method' => 'post']]),
                                    [
                                        'data-method' => 'post',
                                        'class' => 'btn btn-link animlink',
                                        'data-confirm' => Yii::t('app', 'CONFIRM'),
                                        'data-pjax' => '0',
                                    ]
                                );
                            },
                        ],
                        'template'=>'{view}{update}{delete}',
                        'contentOptions'=>['style'=>'width: 150px;'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                ],
            ]); 
        ?>
  </div>
</div>
<?php Pjax::end(); ?></div>

<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>График дежурств</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>

        <?php
            Modal::begin([
                    // 'header' => '<h4>Create</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";
            echo "<div id='dutyForm'></div>";

            Modal::end();
        ?>
<?php
    // $js = Dutylist::find()->joinWith('employee')->asArray()->all();
    // echo Json::encode($js);
?>