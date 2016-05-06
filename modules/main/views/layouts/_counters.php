<?php

use rmrevin\yii\fontawesome\FA;

?>

<div class="counters">    
    <div class="container">
		<div class="row">
		    <div class="col-md-4" id="centerFA">
		        <?= FA::icon('clock-o')->size(FA::SIZE_5X) ?>
		        <div id="dateCounter"></div>    
		    </div>
		    <div class="col-md-4" id="centerFA">
		        <?= FA::icon('coffee')->size(FA::SIZE_5X) ?>
		        <div id="dateCounter"></div>    
		    	
		    </div>
		    <div class="col-md-4">
		    	
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