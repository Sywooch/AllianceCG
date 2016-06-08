<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use app\modules\alliance\models\Clientcirculationcomment;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Targets;
use app\modules\references\models\ContactType;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\alliance\models\ClientcirculationcommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientcirculationcomments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$deleteRestore = file_get_contents('js/modules/alliance/clientcirculationcomment/deleteRestore.js');
$this->registerJs($deleteRestore, View::POS_END);

?>
<div class="clientcirculationcomment-index">

    <!-- <h1> -->
        <?php // echo Html::encode($this->title) ?>
    <!-- </h1> -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p class="buttonpane"> -->
        <?php // echo Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-animlink']) ?>
        <?php // echo Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-animlink']) ?>
    <!-- </p> -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => '№',
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>['style'=>'width: 20px;']
            ],
            // [
            //     'attribute' => 'clientname',
            //     'format' => 'raw',
            //     'value'=>function ($data) {
            //         return Html::a($data->clientcirculation->name, ['clientcirculation/' . $data->clientcirculation_id]);
            //     },
            // ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'clientname',
                'value' => 'clientcirculation.name',
                'format' => 'raw',
            ],
            [
                'attribute'=> 'contacttypes',
                'filter'=>ArrayHelper::map(ContactType::find()->where(['state' => ContactType::STATUS_ACTIVE])->asArray()->all(), 'contact_type', 'contact_type'),
                // 'filter' => Html::activeDropDownList($searchModel, 'targets', ArrayHelper::map(Targets::find()->asArray()->all(), 'id', 'target'),['class'=>'form-control','prompt' => 'Select Targets']),
                'value' => 'contacttypes.contact_type',
            ],
            [
                'attribute'=> 'targets',
                'filter'=>ArrayHelper::map(Targets::find()->where(['state' => ContactType::STATUS_ACTIVE])->asArray()->all(), 'target', 'target'),
                'value' => 'targets.target',
            ],
            // 'contact_type',
            // 'target',
            // 'car_model',
            [
                'attribute' => 'car_model',
                'value' => function($data){
                    return is_numeric($data->car_model) ? $data->cars->fullModelName : $data->car_model;
                },
            ],
            [
                'class' => SetColumn::className(),
                'filter' => Clientcirculationcomment::getStatesArray(),
                'attribute' => 'state',
                'visible' => Yii::$app->user->can('admin'),
                'name' => 'statesName',
                'contentOptions'=>['style'=>'width: 50px;'],
                'cssCLasses' => [
                    Clientcirculationcomment::STATUS_ACTIVE => 'success',
                    Clientcirculationcomment::STATUS_BLOCKED => 'danger',
                ],
            ],
            [
                'attribute' => 'authorname',
                'value' => 'authorname.full_name',
                'visible' => Yii::$app->user->can('admin'),
            ],
            // 'comment:ntext',
            // 'state',
            // 'created_at',
            // 'updated_at',
            // 'author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
