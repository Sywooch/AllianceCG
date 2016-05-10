/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



    // $(document).ready(function(){
    // $('#ExportExcel').click(function(){
    //         var PosId = $('#creditcalendar-grid').yiiGridView('getSelectedRows');
    //         if (PosId=="") {
    //             alert("Нет отмеченных записей!", "Alert Dialog");
    //         }
    //         else if (confirm("Выгрузить в Excel отмеченные записи?")) {
    //           $.ajax({
    //             type: 'POST',
    //             url : '/alliance/creditcalendar/export',
    //             data : {row_id: PosId},
    //             success : function() {
    //                 // alert("successfully!!!");
    //                 // window.location.href = '/alliance/creditcalendar/export';
    //             }
    //           });
    //           // window.location.href = '/alliance/creditcalendar/export';
    //         }
    // });
    // });
    
function setParams(){
    var keyList = $('#creditcalendar-grid').yiiGridView('getSelectedRows');
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
