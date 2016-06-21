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
$js=<<<JS
$(document).on("click","[data-remote]",function(e) {
    e.preventDefault();
    $("div#mymodal .modal-body").load($(this).data('remote'));
});
$('#Assigs').on('hidden.bs.modal', function (e) {
  $("div#mymodal .modal-body").html('');
}); 
JS;

$this->registerJs($js);
?>

<div class="summertable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="buttonpane">
        <?php
             // $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-sm btn-success']) : false;
             $createButton = Yii::$app->user->can('admin') ? Html::button('Create', ['value' => Url::to('/main/summertable/create'), 'class' => 'btn btn-success btn-sm', 'id' => 'modalButton']) : false;
             echo $createButton;
        ?>
        <?php
            Modal::begin([
                    // 'header' => '<h4>Create</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";

            Modal::end();
        ?>
    </p>
<?php // Pjax::begin(); ?>    
<?php 
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
            ],
            // ['class' => 'yii\grid\CheckboxColumn',],

            // 'id',
            // 'model', 
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
            // 'discount',
            [
            'attribute' => 'discount',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->discount);
            }
            ],
            // 'discount_percent',
            [
            'attribute' => 'discount_percent',
            'content'=>function($data){
                $formatter = \Yii::$app->formatter;
                return $formatter->asPercent($data->discount_percent);
            }
            ],
            // 'price',
            [
            'attribute' => 'price',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->price);
            }
            ],
            // 'price_discount',
            [
            'attribute' => 'price_discount',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->price_discount);
            }
            ],
            // 'payment',
            [
            'attribute' => 'payment',
            'content'=>function($data){
                $fmt = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
                $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '&#8381;');
                return $fmt->format($data->payment) . '/мес';
            }
            ],
            // [
            //     'attribute' => 'payment',
            //     'label' => 'Ежемесячный <br/> платеж по кредиту',
            // ],

            // ['class' => 'yii\grid\ActionColumn'],
            
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
                            '<i class="fa fa-remove"></i>',
                            // Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->intPropertyId], ['data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),'method' => 'post',],]); 
                            $url=Url::to(['/main/summertable/delete','id'=>$model->id], ['data' => ['confirm' => Yii::t('app', 'Delete?'), 'method' => 'post']]),
                            // $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/main/summertable/delete','id'=>$model->id], [
                            //     // 'class' => 'btn btn-danger',
                            //     'data' => [
                            //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            //         'method' => 'post',
                            //     ],
                            //     ],
                            // )
                            [
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
                'template'=>'{view}{update}{delete}',
                'contentOptions'=>['style'=>'width: 150px;'],
                'visible' => Yii::$app->user->can('admin'),
            ],
            ['class' => 'yii\grid\ActionColumn', 
                'buttons'=>[
                    'reserv'=>function($url,$model){
                            $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/main/summertable/testdriverequest','id'=>$model->id]);
                            return \yii\helpers\Html::a(Yii::t('app', '{icon} TESTDRIVEREQUEST', ['icon' => '<i class="fa fa-send"></i>']), '#mymodal', [
                                    'class' => 'btn btn-primary btn-sm', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                                ]);
                        },
                ],
                'template'=>'{reserv}',
                'visible' => Yii::$app->user->can('admin'),
            ],
            // ],
        ],
    ]);
 ?>

<?php // Pjax::end(); ?></div>
<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>Зарезервировать автомобиль</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>
