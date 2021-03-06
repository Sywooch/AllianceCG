/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//<script>

    $(document).ready(function() {

        // var statusAtwork = (document.getElementById('statusFinished').checked) ? document.getElementById('statusAtwork').value : '';
        // var statusClarify = (document.getElementById('statusFinished').checked) ? document.getElementById('statusClarify').value : '';
        // var statusFinished = (document.getElementById('statusFinished').checked) ? document.getElementById('statusFinished').value : '';

        // var curSource = "/alliance/creditcalendar/calendarsearch?status[]=0&status[]=1&status[]=2";
        // var curSource = '/alliance/creditcalendar/calendarsearch?status[]=' +  statusAtwork + '&status[]=' + statusClarify + '&status[]=' + statusFinished;
        var curSource = "/alliance/creditcalendar/calendarsearch";
        var filter = document.getElementById('autor_selector');
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
            theme:true,
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
                    // if (confirm('Добавить новую запись?'))window.location = 'create';
                    if (moment().diff(date,'days') > 0){
                        alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
                    } else{
                        var datesend = date.format("YYYY-MM-DD H:mm:ss");
                        if (confirm('Добавить новую запись?'))window.location = 'create';
                    }                     
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
            },

            // eventSources: [curSource[0],curSource[1]],
            eventSources: [
                {
                    url: curSource,
                    cache: true,
                    error: function() {
                        alert("Ошибка получения источника событий");
                    },
                },
                // {
                //     url: curSource[1],
                //     cache: true,
                //     error: function() {
                //         alert("Ошибка получения источника событий №2");
                //     },
                // },
            ],
            // events: {
            //     url: source,
            //     cache: true, 
            //     error: function() {
            //         alert('Ошибка получения источника событий');
            //     },
            // },
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
                // 
                // Предварительный просмотр в jQuery Dialog
                // element.attr('href', 'javascript:void(0);');
                // element.click(function() {
                //     $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
                //     $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
                //     $("#eventInfo").html(event.description);
                //     $("#eventLink").attr('href', event.url);
                //     $("#eventContent").dialog({ modal: true, title: event.title, width:350});
                // });
                // 
               
                // Popover при наведении      
                $(element).popover({title: event.title, content: event.description, trigger: 'hover', placement: 'auto right', delay: {"hide": 300 }});
                // return ['all', event.status].indexOf($('#status_selector').val()) >= 0
                return ['all', event.author].indexOf($('#author_selector').val()) >= 0 && ['all', event.status].indexOf($('#status_selector').val()) >= 0 && ['all', event.priority].indexOf($('#priority_selector').val()) >= 0;
            },
            // Действие при клике на событие
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    if (confirm('Перейти на страницу записи "' + calEvent.title + '"?'))window.open(calEvent.url);
                    return false;
                }
            }, 

            // eventMouseover: function(calEvent, jsEvent) {
            //     // var tooltip = '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' + calEvent.title + '</div>';
            //     var tooltip = '<div class="tooltip">' + calEvent.title + '</div>';
            //     $("body").append(tooltip);
            //     $(this).mouseover(function(e) {
            //         $(this).css('z-index', 10000);
            //         $('.tooltip').fadeIn('500');
            //         $('.tooltip').fadeTo('10', 1.9);
            //     }).mousemove(function(e) {
            //         $('.tooltip').css('top', e.pageY + 10);
            //         $('.tooltip').css('left', e.pageX + 20);
            //     });
            // },

            // eventMouseout: function(calEvent, jsEvent) {
            //      $(this).css('z-index', 8);
            //      $('.tooltip').remove();
            // },

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

    // DatePicker

    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        inline: true,
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true,
        yearRange: '-2:+2',
        altField: '#datepicker',
        altFormat: 'dd/mm/yy',
        
        // showOn: 'both',
        // buttonText: "<i class='fa fa-calendar'></i>",
        // buttonImageOnly:  false,
        // buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif',
        
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        },
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);

            if (confirm("Перейти к выбранной дате - " + d.toLocaleDateString('en-GB') + " ?")) {
                    $('#credit_calendar').fullCalendar('changeView', 'agendaDay');
                    $('#credit_calendar').fullCalendar('gotoDate', d);
            }
            else {
                // alert(d.toLocaleDateString());
                // $('#datepicker').datepicker('setDate', null);
                // $('#datepicker').val('').datepicker("refresh");
            }
        }
    }); 

    // Опции селектора

    $('#author_selector, #status_selector, #priority_selector').on('change',function(){
        $('#credit_calendar').fullCalendar('rerenderEvents');
    });

    // $('#status_selector').on('change',function(){
    //     $('#credit_calendar').fullCalendar('rerenderEvents');
    // });    

    $('#filterStatus').multiselect({
        numberDisplayed: 2,
        enableFiltering: false,
        includeSelectAllOption: true,
        // includeDeSelectAllOption: true,
        nonSelectedText: 'Статус',
    });


