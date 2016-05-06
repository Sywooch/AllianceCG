<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;


/* @var $this yii\web\View */

$this->title = Yii::$app->name;;
?>

<!-- include in header -->
<!-- <link rel="stylesheet" href="css/queryLoader.css" type="text/css">
<script type='text/javascript' src='js/jquery-2.2.1.min.js'></script>
<script type='text/javascript' src='js/libs/queryLoader.js'></script>


<script type='text/javascript'>
    QueryLoader.init();
</script> -->
<!-- include in footer -->

<?php 
   $this->registerCssFile('@web/css/counters.css', ['depends' => ['app\assets\AppAsset']]);    
   $this->registerCssFile('@web/css/slideDown.css', ['depends' => ['app\assets\AppAsset']]);  
   // $this->registerCssFile('@web/css/animation.css', ['depends' => ['app\assets\AppAsset']]);
   $this->registerJsFile(Yii::getAlias('@web/js/modules/main/default/counters.js'), ['depends' => [
       'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset'],
   ]); 
?>

<div class="counters" id="counters">    
    <div class="counterscontainer" id="counterscontainer">
    	<div class="col-md-12">
			<div class="row">
			    <div class="col-md-4" id="centerFA">
			    	<?= FA::icon('pencil')->size(FA::SIZE_5X) ?>
			    </div>
			    <div class="col-md-4" id="centerFA">
			        <?= FA::icon('clock-o')->size(FA::SIZE_5X) ?>
			    </div>
			    <div class="col-md-4" id="centerFA">
			        <?= FA::icon('coffee')->size(FA::SIZE_5X) ?>			    	
			    </div>
			</div>
		</div>
    	<div class="col-md-12">
			<div class="row">
			    <div class="col-md-4">
			    	<div id="codeStringsCounter"></div>
			    </div>
			    <div class="col-md-4" id="centerFA">
			        <div id="dateCounter"></div>
			    </div>
			    <div class="col-md-4" id="centerFA">
					<div id="coffeeCounter"></div>
			    </div>
			</div>
		</div>
    	<div class="col-md-12">
			<div class="row">
			    <div class="col-md-4">
			    	<div id="codeStringsText"></div>
			    </div>
			    <div class="col-md-4" id="centerFA">
			        <div id="dateText"></div>
			    </div>
			    <div class="col-md-4" id="centerFA">
					<div id="coffeeText"></div>
			    </div>
			</div>
		</div>
    </div>
</div>

<!-- #5cb85c -->
<!-- <div id="337ab7"></div> -->