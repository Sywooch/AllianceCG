
function setParams(){
    var keyList = $('#statusmonitor-grid').yiiGridView('getSelectedRows');
    if (keyList=="") {
        $('#Excel').removeAttr('data-params');
        alert("Нет отмеченных записей! Выгруженная таблица будет пуста!");
        return false;
        // window.location.reload();
    }
    else {
        $('#Excel').attr('data-params', JSON.stringify({keyList}));
    }
    // if(keyList != '') {
    //     $('#Excel').attr('data-params', JSON.stringify({keyList}));
    // } else {
    //     $('#Excel').removeAttr('data-params');
    // }
};
