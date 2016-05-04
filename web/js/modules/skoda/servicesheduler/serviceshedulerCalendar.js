

    $(document).ready(function() {
        $('#skoda_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            eventLimit: true,            
            selectable: false,
            height: 600,
            width: 600,
            lang: 'ru',
            events: {
                url: "/skoda/servicesheduler/calendarsearch",
                cache: true 
            },            
			header: {
			    left: 'prev,today,next',
			    center: 'title',
			    right: 'month,agendaWeek,agendaDay'
			},

//            dayRender: function(date, cell){            
//                if (moment().diff(date,'days') > 0){
//                    cell.css("background-color","silver");
//                } else if (moment().diff(date,'days') < 0){
//                    cell.css("background-color","#ededed");
//                } else{
//                    cell.css("background-color","white");
//                }
//            },
            eventRender: function(event, element) {
                  $(element).tooltip({title: event.title});             
            },
            dayClick: function(date, calEvent, jsEvent, view, resourceObj) {            
                if (moment().diff(date,'days') > 0){
                    alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
//                    var modal_dismiss = '<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>';
//                    var d = document.getElementById("modal-body");
//                    d.className = " alert alert-info";
//                    $('#modal-header').html('Дата: ' + jsEvent.start.format("DD/MM/YYYY"));
//                    $('#modal-body').html('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
//                    $('#modal-footer').html(modal_dismiss);
//                    $('#skoda_servicesheduler_modal').modal();
                } else{
                    var datesend = date.format();
                    window.location = 'create?date=' + datesend;
                }        		
			},
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    alert('Дата: ' + calEvent.start.format("DD/MM/YYYY") + '\n\t' + 'Мастер-консультант: ' + calEvent.title);
                    $(this).css('border-color', 'red');
                    return false;
                }
                $(this).css('border-color', 'red');
//                if (calEvent.url) {
//                    var link_to_record = '<a id="eventUrl" target="_blank class="btn btn-success" role="button">К записи</a>';                    
//                    var modal_dismiss = '<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>';
//                    var d = document.getElementById("modal-body");
//                    d.className = " alert alert-success";
//                    $('#modal-header').html('Дата: ' + calEvent.start.format("DD/MM/YYYY"));
//                    $('#modal-body').html('Мастер-консультант: ' + calEvent.title);
//                    // $('#modal-footer').html(link_to_record + modal_dismiss);
//                    $('#modal-footer').html(modal_dismiss);
//                    $('#skoda_servicesheduler_modal').modal();                    
//                    return false;
//                }             
            },
    		eventColor: '#4ba82e',

        });
    });

