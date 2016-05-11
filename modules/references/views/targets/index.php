<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\references\Module;
use app\components\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\TargetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'TARGETS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['references']];
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
            ['class' => 'yii\grid\SerialColumn'],
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
