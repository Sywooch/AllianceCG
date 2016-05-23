<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-type: application/javascript");
    use yii\web\AssetBundle;
    use yii\helpers\Html;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\Json;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    
    $this->title = Yii::t('app', 'STATUSMONITOR_INDEX');
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
    $this->params['breadcrumbs'][] = $this->title;

?>

    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

    <p style="text-align: right">

        <?= Html::a(Yii::t('app', '{icon} STATUS_CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(Yii::t('app', 'STATUS_REFRESH', ['icon' => FA::icon('refresh')]), ['calendar'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(Yii::t('app', '{icon} STATUS_EXPORT_EXCEL', ['icon' => FA::icon('file-excel-o')]), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>

    </p>
    
<?php 
   $this->registerCssFile('@web/css/jqfc/fullcalendar_sk_statusmonitor.css', ['depends' => ['app\assets\AppAsset']]);    
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
   $this->registerJsFile(Yii::getAlias('@web/js/modules/skoda/statusmonitor/statusmonitorCalendar.js'), ['depends' => [
       'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset'],
   ]);    
?>

<div id='skoda_statusmonitor_calendar'></div>    

<script>
  var worker_today = "<?php echo $model->workerevent()?>";
  top.alert(worker_today);
</script>