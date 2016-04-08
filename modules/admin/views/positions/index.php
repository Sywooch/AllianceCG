<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use yii\helpers\Url;
use app\modules\admin\Module;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Positions;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PositionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_POSITIONS');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(' 

    $(document).ready(function(){
    $(\'#MultipleDelete\').click(function(){
            var PosId = $(\'#admin-positions-grid\').yiiGridView(\'getSelectedRows\');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Удалить запись?")) {
              $.ajax({
                type: \'POST\',
                url : \'/admin/positions/multipledelete\',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });', \yii\web\View::POS_READY);


?>

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-briefcase" style='padding-right:10px;'></span>-->
            <?php // Html::encode($this->title) ?>
    <!--</h1>-->
    <?php // $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="positions-index center-block">

    <p style="text-align: right">
        <?= Html::a(FA::icon('plus') . Module::t('module', 'ADMIN_CREATE_POSITIONS'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(FA::icon('refresh') . Module::t('module', 'ADMIN_USERS_REFRESH'), ['index'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('remove') . Module::t('module', 'ADMIN_USERS_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>         
    </p>
    <?= GridView::widget([
        'id' => 'admin-positions-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'summary'=> "{begin} - {end} {count} {totalCount} {page} {pageCount}",
        'showFooter'=>true,
        'showHeader' => true,
        'layout'=>"{summary}\n{items}\n{pager}",
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
                'attribute' => 'position',
                // 'format' => 'raw',
                'filter' => ArrayHelper::map(Positions::find()->asArray()->all(), 'position', 'position'),
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            // 'description:ntext',

            // ['class' => 'yii\grid\ActionColumn'],
            [
               'class' => ActionColumn::className(),
               'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $title = false;
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        // return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
        ],
    ]); ?>
</div>
