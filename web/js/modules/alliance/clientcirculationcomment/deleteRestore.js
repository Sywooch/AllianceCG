/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $(document).ready(function(){
    $('#MultipleDelete').click(function(){
            var PosId = $('#clientcirculation-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!");
            }
            else if (confirm("Удалить отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/clientcirculation/multipledelete',
                data : {row_id: PosId},
              });
            }
    });
    $('#MultipleRestore').click(function(){
            var PosId = $('#clientcirculation-grid').yiiGridView('getSelectedRows');
            if (PosId=="") {
                alert("Нет отмеченных записей!");
            }
            else if (confirm("Восстановить отмеченные записи?")) {
              $.ajax({
                type: 'POST',
                url : '/alliance/clientcirculation/multiplerestore',
                data : {row_id: PosId},
              });
            }
    });    
    
    });