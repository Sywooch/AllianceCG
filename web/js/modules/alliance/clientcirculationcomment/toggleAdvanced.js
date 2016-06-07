var button = document.getElementById('advanced');

button.onclick = function() {
    var div = document.getElementById('clientcirculation');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};