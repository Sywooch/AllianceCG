/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $(document).ready(function(){
    $('#MultipleDeactivate').click(function(){
            var PosId = $('#dutylist-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!");
            }
            else if (confirm("Деактивировать отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/dutylist/multipledeactivate',
                data : {row_id: PosId},
              });
            }
    });
    $('#MultipleActivate').click(function(){
            var PosId = $('#dutylist-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!");
            }
            else if (confirm("Активировать отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/dutylist/multipleactivate',
                data : {row_id: PosId},
              });
            }
    });    
    
    });