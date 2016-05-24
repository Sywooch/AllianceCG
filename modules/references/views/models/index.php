<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Models;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\ModelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'MODELS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->
    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'models-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],

            [
                'class' => LinkColumn::className(),
                'attribute' => 'fullmodelname',
                'format' => 'raw',    
                // 'value' => function ($data) {
                //     return $data->getFullname();
                // },
            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Models::STATUS_ACTIVE =>'success',
                    Models::STATUS_BLOCKED => 'default',
                ],
            ],

            // [
            //     'class' => 'yii\grid\ActionColumn'
            // ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
