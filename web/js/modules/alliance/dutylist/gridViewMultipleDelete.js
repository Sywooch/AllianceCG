/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



    $(document).ready(function(){
    $('#MultipleDelete').click(function(){
            var PosId = $('#dutylist-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!", "Alert Dialog");
            }
            else if (confirm("Удалить отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/dutylist/multipledelete',
                data : {row_id: PosId},
                success : function() {
                    alert("successfully!!!");
                }
              });
            }
    });
    });