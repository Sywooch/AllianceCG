<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use app\modules\skoda\Module;
// use app\components\grid\LinkColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Serviceshedulers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicesheduler-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Servicesheduler'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="servicesheduler-tabs">
    <?php

echo Tabs::widget([
    'items' => [
        [
            'label' => Module::t('module', 'SERVICESHEDULER_CALENDAR'),
            'content' => $this->render('_calendar', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
        ],
        [
            'label' => Module::t('module', 'SERVICESHEDULER_TABLE'),
            // 'content' => 'Tab 1',
            'content' => $this->render('_table', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
            'active' => true
        ],
    ]
]);    

    ?>

    </div>

    <?php 
        // GridView::widget([
        //     'dataProvider' => $dataProvider,
        //     'filterModel' => $searchModel,
        //     'columns' => [
        //         ['class' => 'yii\grid\SerialColumn'],
    
        //         'id',
        //         'date',
        //         'responsible',
    
        //         ['class' => 'yii\grid\ActionColumn'],
        //     ],
        // ]); 
    ?>

</div>
