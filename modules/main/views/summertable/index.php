<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\SummertableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = Yii::t('app', 'Summertables');
// $this->params['breadcrumbs'][] = $this->title;

$js1=<<<JS
$(document).on("click","[data-remote]",function(e) {
    e.preventDefault();
    $("div#mymodal .modal-body").load($(this).data('remote'));
});
$('#Assigs').on('hidden.bs.modal', function (e) {
  $("div#mymodal .modal-body").html('');
}); 
JS;

$this->registerJs($js1);
?>

<div class="summertable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="buttonpane">
        <?php
             // $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-sm btn-success']) : false;
             // $createButton = Yii::$app->user->can('admin') ? Html::button('<i class="fa fa-plus"></i> Добаввить', ['value' => Url::to('/main/summertable/create'), 'class' => 'btn btn-success btn-sm', 'id' => 'modalButton']) : false;
             $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                                    'class' => 'btn btn-success btn-sm', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/main/summertable/create')
                                ]) : false;
             echo $createButton;
        ?>
    </p>
<?php Pjax::begin(['id' => 'testdirveRequest']); ?>    
<?php 
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'testdireverequest-grid',
        'summary' => false,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
            ],
            // ['class' => 'yii\grid\CheckboxColumn',],

            [
                'attribute' => 'model',
                'visible' => !Yii::$app->user->can('admin'),
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'model',
                'visible' => Yii::$app->user->can('admin'),
                'format' => 'raw',
                'contentOptions'=>['style'=>'width: 300px;'],
            ],
            'body_color',
            [
            'attribute' => 'discount',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->discount);
            }
            ],
            [
            'attribute' => 'discount_percent',
            'content'=>function($data){
                $formatter = \Yii::$app->formatter;
                return $formatter->asPercent($data->discount_percent);
            }
            ],
            [
            'attribute' => 'price',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->price);
            }
            ],
            [
            'attribute' => 'price_discount',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->price_discount);
            }
            ],
            [
            'attribute' => 'payment',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->payment) . '/мес';
            }
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'buttons'=>[
                    'view'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/main/summertable/view','id'=>$model->id]);
                            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', '#mymodal', [
                                    'class' => 'btn btn-link', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                    'update'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/main/summertable/update','id'=>$model->id]);
                            return \yii\helpers\Html::a('<i class="fa fa-pencil"></i>', '#mymodal', [
                                    'class' => 'btn btn-link', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<i class="fa fa-trash"></i>',
                            $url=Url::to(['/main/summertable/delete','id'=>$model->id], ['data' => ['confirm' => Yii::t('app', 'Delete?'), 'method' => 'post']]),
                            [
                                'data-method' => 'post',
                                'class' => 'btn btn-link',
                                'data-confirm' => Yii::t('app', 'CONFIRM'),
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
                'template'=>'{view}{update}{delete}',
                'contentOptions'=>['style'=>'width: 250px;'],
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'class' => 'yii\grid\ActionColumn', 
                'buttons'=>[
                    'reserv'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/main/summertable/testdriverequest','id'=>$model->id]);
                            return \yii\helpers\Html::a(Yii::t('app', '{icon} TESTDRIVEREQUEST', ['icon' => '<i class="fa fa-send"></i>']), '#mymodal', [
                                    'class' => 'btn btn-primary btn-sm', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                ],
                'template'=>'{reserv}',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
        ],

            // ['class' => 'yii\grid\ActionColumn'],
    ]);
 ?>

<?php Pjax::end(); ?></div>

<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>Зарезервировать автомобиль</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>

        <?php
            Modal::begin([
                    // 'header' => '<h4>Create</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";

            Modal::end();
        ?>