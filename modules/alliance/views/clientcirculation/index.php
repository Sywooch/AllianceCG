<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
// use app\modules\references\models\Regions;
use yii\widgets\MaskedInput;
use app\modules\alliance\models\Clientcirculation;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\ClientCirculationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CLIENTCIRCULATION');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$deleteRestore = file_get_contents('js/modules/alliance/clientcirculation/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

?>
<div class="client-circulation-index">

<p class="buttonpane">
    <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-link animlink']) ?>
    <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-link animlink']) ?>
    <?php
        if(Yii::$app->user->can('admin')){
            echo Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']);
            echo '&nbsp';
            echo Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleRestore']);
        }
    ?>    
    <?php // echo Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => FA::icon('list')]), ['class' => 'btn-link animlink', 'id' => 'advanced']) ?>    
</p>

  <div class="panel panel-default"> <!-- panelStart -->
    <div class="panel-heading" style="height: 70px;"><!-- panelHeaderBegin -->

        <?= $this->render('_search', ['model' => $searchModel]); ?>

    </div> <!-- panelHeadingEnd -->  
    <div class="panel-body"><!-- panelBodyBegin -->

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
                [
                    'attribute' => 'phone',                
                    'filter' => MaskedInput::widget([
                            'model' => $searchModel,
                            'attribute' => 'phone',
                            // 'name' => 'ClientcirculationSearch[phone]',
                            'mask' => '+7 (999) 999-99-99',
                        ]),
                    'contentOptions'=>['style'=>'width: 150px;'],
                ],
                // 'phone',
                'email:email',
                // [
                //     'attribute' => 'authorname',
                //     'value' => 'authorname.full_name',
                // ],
                // [
                //     'attribute' => 'regions',
                //     'value' => 'regions.region_name'
                // ],
                [
                   'attribute'=>'regions',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return $data->getRegionslink();
                    },
                ],
                [
                    'class' => SetColumn::className(),
                    'filter' => Clientcirculation::getStatesArray(),
                    'attribute' => 'state',
                    'visible' => Yii::$app->user->can('admin'),
                    'name' => 'statesName',
                    'contentOptions'=>['style'=>'width: 50px;'],
                    'cssCLasses' => [
                        Clientcirculation::STATUS_ACTIVE => 'success',
                        Clientcirculation::STATUS_BLOCKED => 'danger',
                    ],
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 

    ?>

<?php Pjax::end(); ?>


    </div><!-- panelBodyEnd -->
  </div><!-- panelEnd -->

</div>
