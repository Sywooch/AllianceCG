<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\alliance\Module;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\references\models\Regions;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\ClientCirculationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'CLIENTCIRCULATION');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$deleteRestore = file_get_contents('js/modules/alliance/clientcirculation/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

?>
<div class="client-circulation-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="text-align: right;">
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'REFRESH'), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
        <?php
            if(Yii::$app->user->can('admin')){
                echo Html::a(FA::icon('remove') . ' ' . Module::t('module', 'DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']);
                echo '&nbsp';
                echo Html::a(FA::icon('upload') . ' ' . Module::t('module', 'RESTORE'), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']);
            }
        ?>        
    </p>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'clientcirculation-grid',
        'summary' => false,
        'columns' => [
                [
                    'header' => '№',
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'contentOptions'=>['style'=>'width: 20px;']
                ],

                [
                    'class' => LinkColumn::className(),
                    'attribute' => 'name',
                    'format' => 'raw',
                ],
                'phone',
                'email:email',
                // [
                //     'attribute' => 'authorname',
                //     'value' => 'authorname.full_name',
                // ],
                [
                    'attribute' => 'regions',
                    'value' => 'regions.region_name'
                ],
                [
                    'class' => SetColumn::className(),
                    // 'filter' => Brands::getStatesArray(),
                    'attribute' => 'state',
                    'visible' => Yii::$app->user->can('admin'),
                    'name' => 'statesName',
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                        Regions::STATUS_ACTIVE => 'success',
                        Regions::STATUS_BLOCKED => 'danger',
                    ],
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 

    ?>

<?php Pjax::end(); ?>

</div>
