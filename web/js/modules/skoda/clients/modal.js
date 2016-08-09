$(document).on("click","[data-remote]",function(e) {
    e.preventDefault();
    $("div#mymodal .modal-body").load($(this).data('remote'));
});
$('#Assigs').on('hidden.bs.modal', function (e) {
  $("div#mymodal .modal-body").html('');
}); 