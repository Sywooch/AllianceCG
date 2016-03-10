<?php
	use yii\web\AssetBundle;
?>

<!-- <meta charset='utf-8' /> -->
<!-- <meta charset='utf-8' http-equiv="Refresh" content="15" /> -->

<script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            editable: true,
            eventLimit: true,
            height: 600,
            width: 600,
			header: {
			    left: 'prev,today,next',
			    center: 'title',
			    right: 'month,agendaWeek,agendaDay'
			},
    		// eventSources: [
    		//     $dataProvider,
    		// ],
			lang: 'ru',
			events: "/src/skoda_servicesheduler_cal.php",
			// dayClick: function(date, jsEvent, view, resourceObj) {
   //      		window.location.replace('servicesheduler/create');
			// },
    		eventClick: function(calEvent, jsEvent, view) {		
    		    // alert('Ответственный: ' + calEvent.title + '\r\nДата: ' + calEvent.start.format());
    		    alert('Ответственный: ' + calEvent.title + '\r\nДата: ' + calEvent.start.format());
    		},
    		eventColor: '#4ba82e',

        });
    });
</script>

<br/><br/>
<br/><br/>

<?php

// inlude full calendar as Yii2 extension

 //	echo \yii2fullcalendar\yii2fullcalendar::widget(array(
 //      	'events'=> $events,
 //      	'loading' => 'Загрузка...', 
 //  		  'header' => [
 //  		    'left' => 'prev,today,next',
 //  		    'center' => 'title',
 //  		    'right' => 'month,basicWeek'
 //  		  ],
 //  ));

?>


<div id='calendar'></div>
