/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



    $(document).ready(function(){
    $('#ExportExcel').click(function(){
            var PosId = $('#creditcalendar-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Выгрузить в Excel отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/creditcalendar/export',
                data : {row_id: PosId},
                success : function() {
                    // alert("successfully!!!");
                    // window.location.href = '/alliance/creditcalendar/export';
                }
              });
              // window.location.href = '/alliance/creditcalendar/export';
            }
    });
    });