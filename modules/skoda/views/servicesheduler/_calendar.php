
<br/><br/>
<br/><br/>

<?php
	// echo 'Calendar Tab';
?>

<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      	'events'=> $events,
      	'loading' => 'Загрузка...', 
  		  'header' => [
  		    'left' => 'prev,today,next',
  		    'center' => 'title',
  		    'right' => 'month,basicWeek'
  		  ],
  ));