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
        'items' => [
            [
                'label' => 'Таблица',
                'url' => ['/skoda/clients/index'],
                'active' => true
            ],
            [
                'label' => 'Календарь',
                'url' => ['/skoda/clients/calendar'],
                'active' => false
            ],
        ]
    ]);
?>

<br/>

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p class="buttonpane">
        <?php
             $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                        'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/skoda/clients/create')
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

<?php Pjax::begin(['id' => 'skodaclients']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'clientShortName',
                'value'=>function ($data) {
                    return $data->getClientshortname();
                },
            ],
            // 'clientName',
            // 'clientSurname',
            // 'clientPatronymic',
            // 'clientPhone',
            // 'clientAddress',
            // 'clientEmail:email',
            'clientDepartment',
            // 'clientBithdayDate',
            [
                'attribute' => 'clientBithdayDate',
                'format' => ['date', 'php:d/m/Y'],
            ],
            // 'state',
            [
                'class' => SetColumn::className(),
                'filter' => Clients::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 100px;'],
                'cssCLasses' => [
                    Clients::STATUS_ACTIVE => 'success',
                    Clients::STATUS_BLOCKED => 'danger',
                ],
            ],
            // 'created_at',
            // 'updated_at',
            // 'author',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'buttons'=>[
                    'view'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/skoda/clients/view','id'=>$model->id]);
                            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', '#mymodal', [
                                    'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                    'update'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/skoda/clients/update','id'=>$model->id]);
                            return \yii\helpers\Html::a('<i class="fa fa-pencil"></i>', '#mymodal', [
                                    'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<i class="fa fa-trash"></i>',
                            $url=Url::to(['/skoda/clients/delete','id'=>$model->id], ['data' => ['confirm' => Yii::t('app', 'Delete?'), 'method' => 'post']]),
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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
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