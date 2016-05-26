var button = document.getElementById('toggleProgressBar');

button.onclick = function() {
    var div = document.getElementById('progressbar');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};