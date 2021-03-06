<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\components\grid\SetColumn;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use app\components\grid\LinkColumn;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
// \Yii::$app->language = 'ru-RU';
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Source Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-index">

    <div class="form-group buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?php // echo Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => FA::icon('file-excel-o')]), ['class' => 'btn-link animlink', 'id' => 'advancedOperations']) ?>
    </div>

    <!-- <h1> -->
    <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

<div class="panel panel-default">
    <div class="panel-heading" style="height: 50px;">
        
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    </div> <!-- panelHeading End -->
    
    <div class="panel-body">

    <div class="col-lg-12 alert alert-danger">

        <?php echo Yii::t('app', 'MESSAGE_TRANSLATION_INFO'); ?>

    </div>  <!-- col-lg-12 End -->

        <?php Pjax::begin(); ?>    

        <?php 
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'summary' => false,
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
                        'attribute' => 'message',
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'translation',
                        'value' => function($model) {
                             return implode(', ', ArrayHelper::map($model->messages, 'id', 'translation'));
                        }                
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'contentOptions'=>['style'=>'width: 20px;'],
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $title = false;
                                $options = []; 
                                $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                $label = $icon;
                                $url = Url::toRoute(['update', 'id' => $model->id]);
                                $options['tabindex'] = '-1';
                                return Html::a($label, $url, $options) .''. PHP_EOL;
                            },
                        ],
                    ],
                    // [
                    //     'attribute' => 'language',
                    //     'value' => function($model) {
                    //          return implode(', ', ArrayHelper::map($model->messages, 'id', 'language'));
                    //     }                
                    // ],

                    // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); 
        ?>
        <?php Pjax::end(); ?>
 
            </div> <!-- panelBody End -->
        </div> <!-- panelDefault End -->
</div> <!-- sourceMessageIndexEnd -->