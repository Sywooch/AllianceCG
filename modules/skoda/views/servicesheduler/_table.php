<?php

use yii\helpers\Html;
use app\components\grid\LinkColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>


<br/><br/>
<br/><br/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            // 'responsible',    
            [
                'class' => LinkColumn::className(),
                'attribute' => 'responsible',
                'filter' => false,
                'format' => 'raw',  
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
