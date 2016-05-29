<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\references\models\ContactType;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\references\models\ContactTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-type-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->

    <?= $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'id' => 'contacttypes-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'summary' => false,
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
                'attribute' => 'contact_type',
                'format' => 'raw',  
            ],
            'created_at:datetime',
            'updated_at:datetime',
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
                    ContactType::STATUS_ACTIVE => 'success',
                    ContactType::STATUS_BLOCKED => 'danger',
                ],
            ],
        ],
    ]); 
?>
<?php Pjax::end(); ?></div>
