

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
	var dateCounter = document.getElementById("dateCounter");
	var coffeeCounter = document.getElementById("coffeeCounter");
	var codeCounter = document.getElementById("codeStringsCounter");
	var startdate = new Date("4/1/2016");
	var today = new Date();
	var timeDiff = Math.abs(today.getTime() - startdate.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
	var coffeePerDay = 8;
	var codeStringsPerDay = 100;
	
  	setValue(dateCounter, diffDays, true, 1, 5);
  	setValue(coffeeCounter, diffDays*coffeePerDay, true, coffeePerDay, 5);
  	setValue(codeCounter, diffDays*codeStringsPerDay, true, codeStringsPerDay, 5);
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
	// dateText().done( counters() );
	// counters(dateText);
	counters(), dateText(), coffeeText(), codeText();
}
