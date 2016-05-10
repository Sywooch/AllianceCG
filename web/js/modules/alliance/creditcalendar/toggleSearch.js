var button = document.getElementById('advancedSearch');

button.onclick = function() {
    var div = document.getElementById('creditcalendar-search');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};