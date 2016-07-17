/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//<script>

    $(document).ready(function() {
        var curSource = "/alliance/dutylist/calendarsearch";
        $('#dutylsitCalendar').fullCalendar({
            contentHeight: 600,
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
            businessHours: {
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

            dayClick: function(date, jsEvent, view) {
                var d = new Date(date);

                if (confirm("Перейти к выбранной дате - " + d.toLocaleDateString('en-GB') + " ?")) {
                        $('#dutylsitCalendar').fullCalendar('changeView', 'agendaDay');
                        $('#dutylsitCalendar').fullCalendar('gotoDate', d);
                }
                // alert('Clicked on: ' + date.format());
                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                // alert('Current view: ' + view.name);
            },
            
            // Цвет дня в календаре:
            
            // dayRender : function(date, cell) {
            //                             var idx = null;
            //                             var today = new Date().toDateString();
            //                             var ddate = date.toDate().toDateString();

            //                             if (ddate == today) {
            //                                 idx = cell.index() + 1;
            //                                 cell.css("background-color", "azure");
            //                                 $(
            //                                         ".fc-time-grid .fc-bg table tbody tr td:nth-child("
            //                                                 + idx + ")").css(
            //                                         "background-color", "azure");

            //                             }

            //                         },

            dayRender: function (date, cell) {
                
                var today = new Date().toDateString();
                var end = new Date();
                end.setDate(today+7);
                
                if (date.toDate().toDateString() === today) {
                    cell.css("background-color", "#5cb85c");
                }
                
                if(date.toDate().toDateString() > today && date.toDate().toDateString() <= end) {
                    cell.css("background-color", "yellow");
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

    function hideSideBar() {
        document.getElementById("sidebar").style.display = "none";
    }


    // $('#filterStatus').multiselect({
    //     numberDisplayed: 2,
    //     enableFiltering: false,
    //     includeSelectAllOption: true,
    //     nonSelectedText: 'Статус',
    // });