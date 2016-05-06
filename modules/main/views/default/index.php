<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;


/* @var $this yii\web\View */

$this->title = Yii::$app->name;;
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

<script type="text/javascript">

var setValue = function(elem, value, inc, shift, speed) {
  var interval = false;
  if (inc) {
    interval = setInterval(function() {
      if (elem.innerHTML * 1 + shift >= value) {
        elem.innerHTML = value;
        clearInterval(interval);
      } else {
        elem.innerHTML = elem.innerHTML * 1 + shift;
      }
    }, speed);
  } else {
    interval = setInterval(function() {
      if (elem.innerHTML * 1 - shift <= value) {
        elem.innerHTML = value;
        clearInterval(interval);
      } else {
        elem.innerHTML = elem.innerHTML * 1 - shift;
      }
    }, speed);
  }
};
function dateCounters() {
	var dateCounter = document.getElementById("dateCounter");
	var coffeeCounter = document.getElementById("coffeeCounter");
	var codeCounter = document.getElementById("codeStringsCounter");
	var startdate = new Date("4/1/2016");
	var today = new Date();
	var timeDiff = Math.abs(today.getTime() - startdate.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
	var coffeePerDay = 3;
	var codeStringsPerDay = 30;
	
  	setValue(dateCounter, diffDays, true, 1, 5);
  	setValue(coffeeCounter, diffDays*coffeePerDay, true, 1, 5);
  	setValue(codeCounter, diffDays*codeStringsPerDay, true, 1, 5);
}
function dateText() {
	document.getElementById("dateText").textContent = "Дней в разработке";
}
function coffeeText() {
	document.getElementById("coffeeText").textContent = "Выпито кофе";
}
function codeText() {
	document.getElementById("codeStringsText").textContent = "Кол-во строк кода";
}
window.onload = function() {
	// dateText().done( dateCounters() );
	// dateCounters(dateText);
	dateCounters(), dateText(), coffeeText(), codeText();
}
</script>