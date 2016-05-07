
$(document).ready(function(){
$('#MultipleDelete').click(function(){
        var PosId = $('#companies-positions-grid').yiiGridView('getSelectedRows');
        if (PosId=="") {
            alert("Нет отмеченных записей!", "Alert Dialog");
        }
        else if (confirm("Удалить отмеченные записи?")) {
          $.ajax({
            type: 'POST',
            url : '/admin/companies/multipledelete',
            data : {row_id: PosId},
          });
        }
});
});