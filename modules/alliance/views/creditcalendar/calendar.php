<?php

use app\modules\alliance\Module;
use yii\widgets\Pjax;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_submenu', [
    'model' => $model,
]) ?>    

<div class="creditcalendar-index">

<p style="text-align: right">
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_EVENT'), ['create?is_task=0'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_TASK'), ['create?is_task=1'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['calendar'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  
        
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
                
    </p>    
    
    <?php Pjax::begin(); ?>
    
    <?= Html::a("", ['/alliance/creditcalendar/index'], ['class' => 'hidden_button', 'id' => 'creditcalendar_refresh']) ?>
  
<?php
    $this->registerCssFile('css/jqfc/fullcalendar_sk_statusmonitor.css', ['depends' => ['app\assets\AppAsset']]);
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
    $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/creditcalendar.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);    
?>
    
<div id='credit_calendar'></div>  

</div>