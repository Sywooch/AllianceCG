<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use app\components\grid\SetColumn;
use app\modules\references\models\Targets;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\TargetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'TARGETS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="targets-index">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id' => 'targets-grid',
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
                'attribute' => 'target',
                'format' => 'raw',    
                // 'value' => function ($data) {
                //     return $data->getFullname();
                // },
            ],
            [
                'class' => SetColumn::className(),
                'filter' => Targets::getStatesArray(),
                'attribute' => 'state',
                'name' => 'statesName',
                'visible' => Yii::$app->user->can('admin'),
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Targets::STATUS_ACTIVE => 'success',
                    Targets::STATUS_BLOCKED => 'danger',
                ],
            ],
            // 'state',
            // 'id',
            // 'target',

            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header' => 'Действия',
            // ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
