<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;


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
   $this->registerCssFile('@web/css/animations/slideDown.css', ['depends' => ['app\assets\AppAsset']]);
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
			    	<i class="fa fa-pencil fa-5x"></i>
			    </div>
			    <div class="col-md-4" id="centerFA">
			    	<i class="fa fa-clock-o fa-5x"></i>
			    </div>
			    <div class="col-md-4" id="centerFA">
			    	<i class="fa fa-coffee fa-5x"></i>			    	
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