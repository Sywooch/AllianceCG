<?php

use yii\helpers\Html;
use app\modules\status\models\Statusmonitor;
use rmrevin\yii\fontawesome\FA;
use app\modules\main\Module;


/* @var $this yii\web\View */

$this->title = Yii::$app->name;;
?>
<div class="row">
    <div class="col-md-4">
        <?php // FA::icon('home')->size(FA::SIZE_5X) ?>    
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>

<?php // Yii::$app->user->identity->usercompany; ?>

<div id="dateCounter"></div>

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
function counters() {
	var result = document.getElementById("dateCounter");
	var startdate = new Date("4/1/2016");
	var today = new Date();
	var timeDiff = Math.abs(today.getTime() - startdate.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
	
  	setValue(result, diffDays, true, 1, 5);
}
window.onload = function() {
   counters();
}
</script>
