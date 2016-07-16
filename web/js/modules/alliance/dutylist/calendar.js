/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//<script>

    $(document).ready(function() {
        var curSource = "/alliance/dutylist/calendarsearch";
        // var filter = document.getElementById('autor_selector');
        $('#dutylsitCalendar').fullCalendar({
            contentHeight: 800,
            aspectRatio: 8,
            handleWindowResize: true, // Изменять размер календаря пропорционально изменению окна браузера
            editable: false, // Редактирование запрещено, т.к. источник событий json-feed из БД
            isRTL: false, // Отображать календарь в обратном порядке (true/false)
            // hiddenDays: [], // Скрыть дни недели [перечислить номера дней недели ч-з запятую]
            weekMode: 'liquid',
            weekNumbers: true,
            weekends: true,
            defaultView: 'month',          
            selectable: false,
            editable: false,
            // height: 400,
            // width: 400,
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
            // hiddenDays: [ 1, 2, 3, 4, 5 ],
            bussinessHours: {
                start: '9:00', // время начала
                end: '21:00', // время окончания
                dow: [ 6, 7 ]
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
            ],
            header: {
                left: 'prev,today,next',
                center: 'title,filter',
                right: 'month,agendaWeek,agendaDay',
            },
            eventRender: function eventRender(event, eventElement, element, view) {
                if (event.imageurl) {
                    eventElement.find("div.fc-content").prepend("<div class='text-center' style='padding: 1px;'><img class='img-rounded' src='" + event.imageurl +"' width='50' height='50'></div>");
                }
                return ['all', event.title].indexOf($('#employee_filter').val()) >= 0;
            },    
            eventClick:  function(event, jsEvent, view) {
                $('#modalTitle').html(moment(event.start).format('DD/MM/YYYY') + ' - Оперативный дежурный на указанную дату:');
                $('#modalBody').html("<div class='text-center'> <img class='img-rounded text-center' src='" + event.imageurl + "' width='50' height='50'>" + ' <b>' + event.title + '</b></div>');
                $('#eventUrl').attr('href',event.url);
                $('#fullCalModal').modal();
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

    // DatePicker
    

    $('#dutylistDatepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        inline: true,
        showButtonPanel: true,
        changeYear: true,
        changeMonth: true,
        yearRange: '-2:+2',
        altField: '#dutylistDatepicker',
        altFormat: 'dd/mm/yy',
        
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        },
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);

            if (confirm("Перейти к выбранной дате - " + d.toLocaleDateString('en-GB') + " ?")) {
                    $('#dutylsitCalendar').fullCalendar('changeView', 'agendaDay');
                    $('#dutylsitCalendar').fullCalendar('gotoDate', d);
            }
            else {
                // alert(d.toLocaleDateString());
                // $('#datepicker').datepicker('setDate', null);
                // $('#datepicker').val('').datepicker("refresh");
            }
        }
    }); 

    // Опции селектора

    $('#employee_filter').on('change',function(){
        $('#dutylsitCalendar').fullCalendar('rerenderEvents');
    });

    function showOrHide() {
        cb = document.getElementById('checkbox');
        if (cb.checked) hideDays();
        else showDays();
    }

    var hideDays = function()
    {
        $('#dutylsitCalendar').fullCalendar('option', {
            hiddenDays: [1, 2, 3, 4, 5],
        });
    }

    var showDays = function()
    {
        $('#dutylsitCalendar').fullCalendar('option', {
            hiddenDays: [],
        });
    }

    // $('#filterStatus').multiselect({
    //     numberDisplayed: 2,
    //     enableFiltering: false,
    //     includeSelectAllOption: true,
    //     nonSelectedText: 'Статус',
    // });