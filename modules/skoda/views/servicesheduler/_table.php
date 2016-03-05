<?php

use yii\helpers\Html;
use app\components\grid\LinkColumn;
use app\components\grid\ActionColumn;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>


<br/><br/>
<br/><br/>

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
                'filter' => false,  
                'format' => ['date', 'php:d/m/Y'],
                'contentOptions'=>['style'=>'width: 100px;']
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'responsible',
                'filter' => false,
                'format' => 'raw',  
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $title = false;
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        // return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
        ],
    ]); ?>
