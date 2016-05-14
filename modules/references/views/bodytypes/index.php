<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\references\Module;
use yii\widgets\Pjax;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use app\components\grid\SetColumn;
use app\modules\references\models\Brands;
use app\modules\references\models\Bodytypes;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\BodytypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'BODY_TYPES');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bodytypes-index">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->
    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'bodytypes-grid',
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

            // 'id',
            // 'body_type',
            [
                'class' => LinkColumn::className(),
                'attribute' => 'body_type',
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
                    Bodytypes::STATUS_ACTIVE =>'success',
                    Bodytypes::STATUS_BLOCKED => 'default',
                ],
            ],
            // 'state',
            // 'description:ntext',

            // [
            //     'class' => 'yii\grid\ActionColumn'
            // ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
