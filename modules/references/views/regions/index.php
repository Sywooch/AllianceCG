<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\references\models\Regions;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'REGIONS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'regions-grid',
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

            // 'region_name',
            [
                'class' => LinkColumn::className(),
                'attribute' => 'regionandcodes',
                'format' => 'raw',
            ],
            // [
            //     'class' => LinkColumn::className(),
            //     'attribute' => 'region_name',
            //     'format' => 'raw',
            // ],
            // 'region_code',
            // 'state',
            'created_at:datetime',
            'updated_at:datetime',
            // 'author',
            [
                'attribute' => 'authorname',
                'value' => 'authorname.full_name',
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
    ]); ?>
<?php Pjax::end(); ?></div>
