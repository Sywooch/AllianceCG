var button = document.getElementById('advancedOperations');

button.onclick = function() {
    var div = document.getElementById('advanced');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};