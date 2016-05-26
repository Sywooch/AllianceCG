var button = document.getElementById('excelOperations');

button.onclick = function() {
    var div = document.getElementById('excel');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};