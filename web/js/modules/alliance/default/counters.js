

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
	var creditCalendar = document.getElementById("creditCalendar");
	var creditCalendarCount = creditcaledarCountRecords;

  var clientCirculation = document.getElementById("clientCirculation");
  var clientCirculationCount = creditTrafficCountRecords;

  var clientCirculationComment = document.getElementById("clientCirculationCommentCount");
  var clientCirculationCommentCount = clientcirculationcommentcount;
	
  setValue(creditCalendar, creditCalendarCount, true, 1, 5);
  setValue(clientCirculation, clientCirculationCount, true, 1, 5);
  setValue(clientCirculationComment, clientCirculationCommentCount, true, 1, 5);
}

function runCounters() {
  counters();
}

window.addEventListener ? 
window.addEventListener("load",runCounters,false) : 
window.attachEvent && window.attachEvent("onload",runCounters);
