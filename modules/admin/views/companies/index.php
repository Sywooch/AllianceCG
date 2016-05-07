<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\Module;
use app\components\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Companies;
use app\components\grid\LinkColumn;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_COMPANIES_TITLE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJs(' 

//     $(document).ready(function(){
//     $(\'#MultipleDelete\').click(function(){
//             var PosId = $(\'#companies-positions-grid\').yiiGridView(\'getSelectedRows\');
//             if (PosId=="") {
//                 alert("Нет отмеченных записей!", "Alert Dialog");
//             }
//             else if (confirm("Удалить?")) {
//               $.ajax({
//                 type: \'POST\',
//                 url : \'/admin/companies/multipledelete\',
//                 data : {row_id: PosId},
//                 success : function() {
//                     alert("successfully!!!");
//                 }
//               });
//             }
//     });
//     });', \yii\web\View::POS_READY);
?>

    <!--<h1>-->
        <!--<span class="glyphicon glyphicon-user" style='padding-right:10px;'></span>-->
        <?php // Html::encode($this->title) ?>
    <!--</h1>-->

    <?= $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="user-index center-block">

    <?php
        // bootstrap label of summary widget
        // $begin_end = '<span class="label label-success">{begin} - {end}</span>';
        // $count = '<span class="label label-danger">{count}</span>';
        // $totalCount = '<span class="label label-primary">{totalCount}</span>';
        // $page = '<span class="label label-primary">{page}</span>';
        // $pageCount = '<span class="label label-primary">{pageCount}</span>';
    ?>

    <?= GridView::widget([
        'id' => 'companies-positions-grid',
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'layout'=>"{pager}\n{summary}\n{items}",
        'summary' => false,
        // Виджет суммарных результатов с использованием bootstrap label
        // 'summary' => "Показаны записи $begin_end из $count . Всего $totalCount . Стр. $page из $pageCount" . '<br/><br/>',
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
                'attribute' => 'company_brand',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_brand', 'company_brand'),
                'value'=>function($data) { return Html::img($data->getSingleLogo(),['height' => '50']); },
                'contentOptions'=>['style'=>'width: 60px;'],
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'company_name',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'company_name', 'company_name'),
                'format' => 'raw',  
                // 'contentOptions'=>['style'=>'width: 100px;'],
            ],
            [
                'attribute' => 'userscount',
                'format' => 'html',
                'filter' => false,
                'value' => function($model) {
                    return '<span class="label label-primary">' . Module::t('module', 'COUNTUSERS'  ) . ': ' . $model->userscount . '</span>';
                },   
                'contentOptions' => ['class'=>'success;'],
            ], 
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
            ],
        ],
    ]); ?>

</div>
