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
            contentHeight: 600,
            aspectRatio: 8,
            handleWindowResize: true, // Изменять размер календаря пропорционально изменению окна браузера
            editable: false, // Редактирование запрещено, т.к. источник событий json-feed из БД
            isRTL: false, // Отображать календарь в обратном порядке (true/false)
            hiddenDays: [], // Скрыть дни недели [перечислить номера дней недели ч-з запятую]
            weekMode: 'liquid',
            weekNumbers: true,
            weekends: true,
            defaultView: 'month',          
            selectable: false,
            editable: false,
            height: 400,
            width: 400,
            lang: 'ru',
            more: 3,
            firstday: 1,
            buttonIcons: {
                prev: 'left-single-arrow',
                next: 'right-single-arrow',
                prevYear: 'left-double-arrow',
                nextYear: 'right-double-arrow'
            },
            themeButtonsIcons: {
                prev: 'circle-triangle-w',
                next: 'circle-triangle-e',
                prevYear: 'seek-prev',
                nextYear: 'seek-next'
            },
            // eventLimitClick
            // "popover" — показывает всплывающую панель со списком всех событий (по умолчанию)
            // "week" — переходит на вид недели, оглашенный в параметре header
            // "day" — переходит на вид дня, оглашенный в параметре header
            // название вида — текстовое название вида из списка доступных видов
            // функция — callback-функция для выполнения произвольного кода

            eventLimit: true,  
            eventLimitClick: 'popover',            
            views: {
                agenda: {
                    eventLimit: 15,
                }
            },
            dayClick: function(date, calEvent, jsEvent, view, resourceObj) {
                    var datesend = date.format("YYYY-MM-DD H:mm:ss");
                    if (confirm('Добавить новую запись?'))window.location = 'create';
                    // if (moment().diff(date,'days') > 0){
                    //     alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
                    // } else{
                    //     var datesend = date.format("YYYY-MM-DD H:mm:ss");
                    //     window.location = 'create';
                    // }                     
             },
            // Статичное событие
            // Аттрибут allDay - повторять ежедневно
            // Аттрибут dow - повторять по дням недели (№ дня недели)
            // events: [{
            //     title: "ololo",
            //     start: '10:00',
            //     end:   '23:00',
            //     dow: [1,4],
            //     allDay: true,
            // }],
            // Статичны йцвет события          
            // eventColor: '#4ba82e',
            bussinessHours: {
                start: '9:00', // время начала
                end: '21:00', // время окончания

                dow: [ 1, 2, 3, 4, 5, 6, 7 ]
                // days of week. an array of zero-based day of week integers (0=Sunday) дни недели, начиная с 0 (0-ВСК)
            }            ,
            events: {
                url: source,
                cache: true, 
                error: function() {
                    alert('Ошибка получения источника событий');
                },
            },
            header: {
                left: 'prev,today,next',
                center: 'title,filter',
                right: 'month,agendaWeek,agendaDay',
            },
            eventRender: function eventRender( event, element, view ) {
                // Описание под темой (необходимо возвращать description в запросе)
                // element.find('.fc-title').append("<br/>" + event.description);
                // Tooltip при наведении
                // $(element).tooltip({title: event.title}); 
                return ['all', event.author].indexOf($('#author_selector').val()) >= 0
            },
            // Действие при клике на событие
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    if (confirm('Перейти на страницу записи "' + calEvent.title + '"?'))window.open(calEvent.url);
                    return false;
                }
            }, 
            // Цвет дня в календаре:
            dayRender: function(date, cell){            
                if (moment().diff(date,'days') > 0){
                    cell.css("background-color","silver");
                } else if (moment().diff(date,'days') < 0){
                    cell.css("background-color","white");
                } else{
                    cell.css("background-color","white");
                }
            },
        });
    });


    // Опции селектора

    $('#author_selector').on('change',function(){
        $('#credit_calendar').fullCalendar('rerenderEvents');
    });

    // $('#status_selector').on('change',function(){
    //     $('#credit_calendar').fullCalendar('rerenderEvents');
    // });


    jquery('#datepicker').datepicker({
        inline: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#credit_calendar').fullCalendar('gotoDate', d);
        }
    }); 

    // $('#datepicker').datepicker({
    //     inline: true,
    //     onSelect: function(dateText, inst) {
    //         var d = new Date(dateText);
    //         $('#credit_calendar').fullCalendar('gotoDate', d);
    //     }
    // });