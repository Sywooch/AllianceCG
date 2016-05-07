<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\Module;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserrolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'NAV_USERROLES');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userroles-index">

    <!-- <h1> -->
        <?php // ehco Html::encode($this->title) ?>
    <!-- </h1> -->
    

    <p style="text-align: right;">
        <?php // Html::a(Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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
            //         return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS') . ': ' . $model->userrolescount . '</span>';
            //     },   
            //     'contentOptions' => ['class'=>'success;'],
            // ],
            [
                'attribute' => 'userroles_count',
                'format' => 'html',
                'filter' => false,
                'value' => function($model) {
                    return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS') . ': ' . $model->userrolescount . '</span>';
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
