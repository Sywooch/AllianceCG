/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
function setParams(){
    var keyList = $('#dutylist-grid').yiiGridView('getSelectedRows');
    if (keyList=="") {
        $('#Excel').removeAttr('data-params');
        alert("Нет отмеченных записей! Выгруженная таблица будет пуста!");
        return false;
    }
    else {
        $('#Excel').attr('data-params', JSON.stringify({keyList}));
    }
};
