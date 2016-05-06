<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;


/* @var $this yii\web\View */

$this->title = Yii::$app->name;;
?>

<?php 
   $this->registerCssFile('@web/css/counters.css', ['depends' => ['app\assets\AppAsset']]);    
   $this->registerJsFile(Yii::getAlias('@web/js/modules/main/default/counters.js'), ['depends' => [
       'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset'],
   ]); 
?>

<div class="counters">    
    <div class="container">
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
