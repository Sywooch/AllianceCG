/**
 * Created by user on 4/29/16.
 */
$(function(){
   // alert('ololo');
    $('#modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});