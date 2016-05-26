<meta charset="UTF-8">

<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;

$this->title = Yii::t('app', 'ŠKODA');
$this->params['breadcrumbs'][] = $this->title;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SKODA'), 'url' => ['/skoda']];
?>
<div class="admin-default-index center-block">
    <!--<h1>-->
        <?php // Html::encode($this->title) ?>
    <!--</h1>-->
    
<div class="col-md-12 buttonpane">
   
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

</div>
    
</div>

<?php
    $this->registerJsFile(Yii::getAlias('@web/js/libs/highcharts/highcharts.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]); 
    $this->registerJsFile(Yii::getAlias('@web/js/modules/skoda/statusmonitor/graph.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);         
?>

<div class="col-lg-12" id="skoda"></div>

<script>
  var worker_today = "<?php echo $model->workerevent()?>";
  top.alert(worker_today);
</script>