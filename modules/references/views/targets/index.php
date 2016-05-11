<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\references\Module;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\TargetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Targets');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="targets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Targets'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'target',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
