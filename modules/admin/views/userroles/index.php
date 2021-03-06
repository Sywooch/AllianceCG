<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use rmrevin\yii\fontawesome\FA;
use app\components\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserrolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'NAV_USERROLES');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-index">

    <!-- <h1> -->
        <?php // ehco Html::encode($this->title) ?>
    <!-- </h1> -->
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="buttonpane">
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm']) ?>
    </p>

    <div class="col-lg-12 alert alert-danger">
        <?= Yii::t('app', 'USERROLES_INFO') ?>
    </div>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'role',

            [
                'class' => LinkColumn::className(),
                'attribute' => 'role',
                'format' => 'raw', 
            ],            
            'role_description:ntext',
            // [
            //     'attribute' => 'userrolescount',
            //     'format' => 'html',
            //     'filter' => false,
            //     'value' => function($model) {
            //         return '<span class="label label-primary">' . Yii::t('app', 'COUNTUSERS') . ': ' . $model->userrolescount . '</span>';
            //     },   
            //     'contentOptions' => ['class'=>'success;'],
            // ],
            [
                'attribute' => 'userroles_count',
                'format' => 'html',
                'filter' => false,
                'value' => function($model) {
                    return '<span class="label label-primary">' . Yii::t('app', 'COUNTUSERS') . ': ' . $model->userrolescount . '</span>';
                },   
                'contentOptions' => ['class'=>'success;'],
            ],
            // 'created_at',
            // 'updated_at',
            // 'author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
