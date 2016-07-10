<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

$this->title = Yii::t('app', 'Dutylists');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$modal = file_get_contents('js/modules/alliance/dutylist/modal.js');
$this->registerJs($modal);

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Таблица',
            'url' => ['/alliance/dutylist/index'],
            'active' => false
        ],
        [
            'label' => 'Календарь',
            'url' => ['/alliance/dutylist/calendar'],
            'active' => true
        ],
    ]
]);

?>

<br/>

<div class="buttonpane">

    <?php
         $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                                'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/alliance/dutylist/create')
                            ]) : false;
         echo $createButton;    

    ?>

	<?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['calendar'], ['class' => 'btn btn-link animlink']) ?>

	<?= Html::a(Yii::t('app', '{icon} CREDITCALENDAR_EXPORT_EXCEL', ['icon' =>'<i class="fa fa-file-excel-o"></i>'] ), ['export'], [
	        'id' => 'Excel',
	        'class' => 'btn btn-link animlink',
	        'onclick' => 'setParams()',
	        'data' => [
	            'method' => 'post',
	            'confirm' => Yii::t('app', 'CREDITCALENDAR_EXPORT_CONFIRM'),
	        ]
	     ]);
	?>

</div>

<?php Pjax::begin(['id' => 'dutylist']); ?> 


                <?php 
                   $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerCssFile('@web/css/bootstrap-multiselect.css', ['depends' => ['app\assets\AppAsset']]);  
                   $this->registerCssFile('@web/js/jquery-ui-1.11.4/jquery-ui.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);           
                   $this->registerJsFile(Yii::getAlias('@web/js/jquery-ui-1.11.4/jquery-ui.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);    
                   $this->registerJsFile(Yii::getAlias('@web/js/libs/bootstrap-multiselect.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);                
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/moment.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/fullcalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lang/ru.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);  
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/dutylist/calendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]); 
                   // $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/printCalendar.js'), ['depends' => [
                   //     'yii\web\YiiAsset',
                   //     'yii\bootstrap\BootstrapAsset'],
                   // ]);    
               ?>

               <div id="dutylsitCalendar"></div>

<?php Pjax::end();?>


<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>График дежурств</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>

        <?php
            Modal::begin([
                    // 'header' => '<h4>Create</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";
            echo "<div id='dutyForm'></div>";

            Modal::end();
        ?>