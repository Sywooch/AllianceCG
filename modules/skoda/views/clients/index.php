<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;
use yii\bootstrap\Tabs;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\skoda\models\Clients;
use app\modules\references\models\Departments;
use yii\db\Expression;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = $this->title;

$modal = file_get_contents('js/modules/skoda/clients/modal.js');
$this->registerJs($modal);

?>
<div class="clients-index">


<?php
    echo Tabs::widget([
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-table"></i> Таблица',
                'url' => ['/skoda/clients/index'],
                'active' => true
            ],
            [
                'label' => '<i class="fa fa-calendar"></i> Календарь',
                'url' => ['/skoda/clients/calendar'],
                'active' => false
            ],
        ]
    ]);
?>

<br/>

    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="panel panel-success">
    <div class="panel-heading">
    

    <p class="buttonpane" style="text-align: left; margin: 0 auto;">
        <?php
             $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                        'class' => 'btn btn-primary animlink', 'style' => 'margin-right: 5px;', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/skoda/clients/create')
                    ]) : false;
             echo $createButton;

        ?>

        <?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-trash"></i>']), ['#'], ['class' => 'btn btn-danger animlink', 'style' => 'margin-right: 5px;', 'id' => 'MultipleDelete']); ?>        

        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-info animlink', 'style' => 'margin-right: 5px;']) ?>

        <?= Html::a(Yii::t('app', '{icon} CREDITCALENDAR_EXPORT_EXCEL', ['icon' =>'<i class="fa fa-file-excel-o"></i>'] ), ['export'], [
                'id' => 'Excel',
                'class' => 'btn btn-warning animlink',
                'style' => 'margin-right: 5px;',
                'onclick' => 'setParams()',
                'data' => [
                    'method' => 'post',
                    'confirm' => Yii::t('app', 'CREDITCALENDAR_EXPORT_CONFIRM'),
                ]
             ]);
        ?>

        <?php // echo Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => '<i class="fa fa-file-excel-o"></i>']), ['class' => 'btn-link animlink', 'id' => 'advancedOperations']) ?>

    </p>

    </div>
    <div class="panel-body">

        <?php Pjax::begin(['id' => 'skodaclients']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'filterModel' => false,
            'layout'=>"{summary}{pager}\n{items}\n{pager}",
            'rowOptions' => function($model){
                if($model->clientBithdayDate == date('Y-m-d')){
                    return ['class' => 'danger'];
                }
                else {
                    return ['class' => 'success'];
                }
            },            
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '№',
                ],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                ],
                [
                    'attribute' => 'clientShortName',
                    // 'filter' => false,
                    'value'=>function ($data) {
                        return $data->getClientshortname();
                    },
                ],
                [
                    'attribute' => 'clientDepartment',
                    // 'filter' => false,
                    'value' => 'department.department_name',
                ],
                [
                    'attribute' => 'clientBithdayDate',
                    // 'filter' => false,
                    'format' => ['date', 'php:d/m/Y'],
                ],
                // 'is_deleted',
                // 'created_by',
                [
                    'class' => SetColumn::className(),
                    // 'filter' => Clients::getStatesArray(),
                    // 'filter' => false,
                    'attribute' => 'is_deleted',
                    'visible' => Yii::$app->user->can('admin'),
                    'name' => 'statesName',
                    'contentOptions'=>['style'=>'width: 100px;'],
                    'cssCLasses' => [
                        Clients::STATUS_ACTIVE => 'success',
                        Clients::STATUS_BLOCKED => 'danger',
                    ],
                ],
                // 'deleted_by',
                // 'deleted_at',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действия',
                    'buttons'=>[
                        'view'=>function($url,$model){
                                $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/skoda/clients/view','id'=>$model->id]);
                                return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', '#mymodal', [
                                        'class' => 'btn btn-success animlink', 'style' => 'margin-right: 5px;', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                    ]);
                            },
                        'update'=>function($url,$model){
                                $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/skoda/clients/update','id'=>$model->id]);
                                return \yii\helpers\Html::a('<i class="fa fa-pencil"></i>', '#mymodal', [
                                        'class' => 'btn btn-primary animlink', 'style' => 'margin-right: 5px;', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                    ]);
                            },
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<i class="fa fa-trash"></i>',
                                $url=Url::to(['/skoda/clients/delete','id'=>$model->id], ['data' => ['confirm' => Yii::t('app', 'Delete?'), 'method' => 'post']]),
                                [
                                    'data-method' => 'post',
                                    'class' => 'btn btn-danger animlink',
                                    'style' => 'margin-right: 5px;',
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

                // ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); 
        ?>
    <?php Pjax::end(); ?>
</div>

</div>
</div>




<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>Клиенты Skoda</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>

        <?php
            Modal::begin([
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";
            echo "<div id='clientsForm'></div>";

            Modal::end();
        ?>