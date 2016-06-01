var button = document.getElementById('showclientdata');

button.onclick = function() {
    var div = document.getElementById('detailClientData');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'table';
    }
};