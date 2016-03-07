<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\Module;
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_COMPANIES_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="user-index center-block">

    <p>
        <?= Html::a(Module::t('module', 'ADMIN_COMPANIES_CR'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'company_name',
                'filter' => false,
                'format' => 'raw',  
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
            ],
        ],
    ]); ?>

</div>
