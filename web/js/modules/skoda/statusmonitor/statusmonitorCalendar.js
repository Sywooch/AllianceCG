// <script>

    $(document).ready(function() {
        $('#skoda_statusmonitor_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            eventLimit: true,            
            selectable: false,
            editable: false,
            height: 600,
            width: 600,
            lang: 'ru',
            events: {
                url: "/skoda/statusmonitor/calendarsearch",
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
//                    cell.css("background-color","white");
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
                } else{
//                    var datesend = date.format("YYYY-MM-DD H:mm:ss");
                    window.location = 'create';
                }        		
			},
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    alert('Дата: ' + calEvent.start.format("DD/MM/YYYY H:mm:ss") + '\n\t' + 'Гос. рег. номер: ' + calEvent.title);
//                    $(this).css('border-color', 'red');
                    return false;
                }
//                $(this).css('border-color', 'red');
            },
    		eventColor: '#4ba82e',

        });
    });
// </script>