<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\references\models\Regions;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$deleteRestore = file_get_contents('js/modules/references/regions/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

$toggleSearch = file_get_contents('js/modules/references/regions/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

$this->title = Yii::t('app', 'REGIONS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="regions-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_search', ['model' => $searchModel]); ?>

<div class="buttonpane">

<?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']); ?>
        
<?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => FA::icon('remove')]), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']); ?>
        
<?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => FA::icon('upload')]), ['#'], ['class' => 'btn btn-warning btn-sm', 'id' => 'MultipleRestore']); ?>

<?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
<?= Html::button(Yii::t('app', '{icon} EXCEL_OPERATIONS', ['icon' => FA::icon('file-excel-o')]), ['class' => 'btn-link btn-sm', 'id' => 'excelOperations']) ?>

</div>

<div class="col-sm-12 bs-callout bs-callout-info" id="excel" style="display: none">

    <div class="col-sm-6">
    </div>
    <div class="col-sm-6">
        <?= Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('upload')]), ['upload'], ['class' => 'btn btn-link btn-sm']) ?>
        <?php // echo Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['import'], ['class' => 'btn btn-link btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-link btn-sm']) ?>
    </div>
</div>            

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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
