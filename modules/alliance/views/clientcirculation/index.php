<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
// use app\modules\references\models\Regions;
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

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->



    <?= $this->render('_search', ['model' => $searchModel]); ?>

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
                    'attribute' => 'employees',
                    'value' => 'employees.fullName'
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

</div>
