<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use app\modules\skoda\Module;
// use app\components\grid\LinkColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="servicesheduler-index center-block">

    <p style="text-align: right">

        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

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
                'events' => $events, 
            ]),
            'active' => true
        ],
        [
            'label' => Module::t('module', 'SERVICESHEDULER_TABLE'),
            // 'content' => 'Tab 1',
            'content' => $this->render('_table', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
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
