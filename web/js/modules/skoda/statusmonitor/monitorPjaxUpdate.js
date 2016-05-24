function refreshDiv(){
            $.pjax.reload({container: '#service_statusmonitor'});
            refrint = setTimeout(refreshDiv, 5000); 
        } var refrint = setTimeout(refreshDiv, 5000);