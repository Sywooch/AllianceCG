
$(document).ready(function(){
$('#MultipleDelete').click(function(){
        var PosId = $('#admin-positions-grid').yiiGridView('getSelectedRows');
        if (PosId=="") {
            alert("Нет отмеченных записей!", "Alert Dialog");
        }
        else if (confirm("Удалить отмеченные записи?")) {
          $.ajax({
            type: 'POST',
            url : '/admin/positions/multipledelete',
            data : {row_id: PosId},
            success : function() {
                alert("successfully!!!");
            }
          });
        }
});
});