function refresh() {
     $.pjax.reload({container:"#creditcalendar"});
     setTimeout(refresh, 5000);
 }
 refresh();