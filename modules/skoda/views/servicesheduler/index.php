<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\skoda\Module;
use yii\bootstrap\Nav;
use app\components\grid\LinkColumn;
use app\components\grid\ActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\skoda\models\ServiceshedulerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $script = <<< JS
// $(document).ready(function() {
//     setInterval(function(){ $("#refreshButton").click(); }, 3000);
// });
// JS;
// $this->registerJs($script);

$this->registerJs(' 

    $(document).ready(function(){
    $(\'#MultipleDelete\').click(function(){
            var PosId = $(\'#servicesheduler-grid\').yiiGridView(\'getSelectedRows\');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Удалить записи?")) {
              $.ajax({
                type: \'POST\',
                url : \'/skoda/servicesheduler/multipledelete\',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });', \yii\web\View::POS_READY);

$this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <p style="text-align: right">

        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

    </p>

<?= Yii::$app->session->getFlash('error'); ?>    

    <?php
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-left nav-pills'],
            'encodeLabels' => false,
            'items' => array_filter([
                [
                    'label' => Module::t('module', 'SERVICESHEDULER_CALENDAR'),
                    'url' => '/skoda/servicesheduler/calendar',
                ],
                [
                    'label' => Module::t('module', 'SERVICESHEDULER_TABLE'),
                    'url' => '/skoda/servicesheduler',
                ],
            ]),
        ]);
    ?>

    <br/><br/><br/>

    <?= GridView::widget([
        'id' => 'servicesheduler-grid',
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
                'attribute' => 'date',
                'format' => ['date', 'php:d/m/Y'],
                'contentOptions'=>['style'=>'width: 100px;']
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'responsible',
                'format' => 'raw',  
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions'=>['style'=>'width: 20px;'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $title = false;
                        $options = [];
                        $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                        $label = $icon;
                        $url = Url::toRoute(['update', 'id' => $model->id]);
                        $options['tabindex'] = '-1';
                        return Html::a($label, $url, $options) .''. PHP_EOL;
                    },
                ],
            ],
        ],
    ]); ?>


</div>
