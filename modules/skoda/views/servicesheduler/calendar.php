<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-type: application/javascript");

    use yii\web\AssetBundle;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\ArrayHelper;
    use yii\jui\DatePicker;
    use app\modules\admin\models\User;
    use yii\bootstrap\Modal;
    use yii\helpers\Json;
    use yii\bootstrap\Alert;
    use yii\jui\Dialog;

    $this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
    $this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
    $this->params['breadcrumbs'][] = $this->title;
?>
   
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('file-excel-o') . Module::t('module', 'STATUS_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>

    </p>

<!-- <script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script> -->

                <?php 
                   $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery.min.js'), ['depends' => [
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
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/skoda/servicesheduler/serviceshedulerCalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);    
               ?>

<div id='skoda_calendar'></div>

<script>
    $(document).ready(function(){
        var worker_today = "<?php echo $model->workerevent()?>";
        top.alert(worker_today);
    });
</script>