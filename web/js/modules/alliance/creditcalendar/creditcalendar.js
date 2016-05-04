/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//<script>

    $(document).ready(function() {
        var source = "/alliance/creditcalendar/calendarsearch";
        var filter = document.getElementById('autor_selector')
        $('#credit_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            defaultView: 'month',
            eventLimit: true,            
            selectable: false,
            editable: false,
            height: 800,
            width: 800,
            lang: 'ru',
            
//            Статичное событие
//            Аттрибут allDay - повторять ежедневно
//            Аттрибут dow - повторять по дням недели (№ дня недели)
//                    
           // events: [{
           //     title: "ololo",
           //     start: '10:00',
           //     end:   '23:00',
           //     dow: [1,4],
           //     // allDay: true,
           // }],
//            
//          Статичный цвет события
//           
//          eventColor: '#4ba82e',
//
//            Цвет дня в календаре:
//            
//            dayRender: function(date, cell){            
//                if (moment().diff(date,'days') > 0){
//                    cell.css("background-color","silver");
//                } else if (moment().diff(date,'days') < 0){
//                    cell.css("background-color","white");
//                } else{
//                    cell.css("background-color","white");
//                }
//            },
//            
//            Действие при клике 
//            
//            dayClick: function(date, calEvent, jsEvent, view, resourceObj) {            
//                if (moment().diff(date,'days') > 0){
//                    alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
//                } else{
//                    var datesend = date.format("YYYY-MM-DD H:mm:ss");
//                    window.location = 'create';
//                }        		
//              }, 
//              

           dayClick: function(date, calEvent, jsEvent, view, resourceObj) {
                   var datesend = date.format("YYYY-MM-DD H:mm:ss");
                   if (confirm('Добавить новую запись?'))window.location = 'create';
             }, 


            events: {
                // url: "/alliance/creditcalendar/calendarsearch",
                url: source,
                cache: true 
            },
            header: {
                left: 'prev,today,next',
                center: 'title,filter',
                right: 'month,agendaWeek,agendaDay'
            },

            eventRender: function eventRender( event, element, view ) {
                return ['all', event.author].indexOf($('#author_selector').val()) >= 0
            },
            
//            Tooltip/QTip:
//            
//            eventRender: function(event, element) {
//                    $(element).tooltip({title: event.title});          
//            },

            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    if (confirm('Перейти на страницу записи "' + calEvent.title + '"?'))window.open(calEvent.url);
                    return false;
                }
            },
        });
    });

    // $('#status_selector').on('change',function(){
    //     $('#credit_calendar').fullCalendar('rerenderEvents');
    // });

    $('#author_selector').on('change',function(){
        $('#credit_calendar').fullCalendar('rerenderEvents');
    });

//</script>