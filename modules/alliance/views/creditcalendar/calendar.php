<?php

use app\modules\alliance\Module;
use yii\widgets\Pjax;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Module::t('module', 'ALLIANCE_CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_submenu', [
    'model' => $model,
]) ?>    

<div class="creditcalendar-index">

<p style="text-align: right">
        
        <?php // Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_EVENT'), ['create?is_task=0'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>
        
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREDITCALENDAR_TASK'), ['create?is_task=1'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'CREDITCALENDAR_REFRESH'), ['calendar'], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('trash') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['#'], ['class' => 'btn btn-danger btn-sm', 'id' => 'MultipleDelete']) ?>  
        
        <?= Html::a(FA::icon('file-excel-o') . ' ' . Module::t('module', 'CREDITCALENDAR_EXPORT_EXCEL'), ['export'], ['class' => 'btn btn-warning btn-sm']) ?>
                
    </p>    
    
    <?php Pjax::begin(); ?>
    
    <?= Html::a("", ['/alliance/creditcalendar/index'], ['class' => 'hidden_button', 'id' => 'creditcalendar_refresh']) ?>
    
<script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar_sk_statusmonitor.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script>

<script>

    $(document).ready(function() {
        $('#credit_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            defaultView: 'month',
            eventLimit: true,            
            selectable: false,
            editable: false,
            height: 800,
            width: 600,
            lang: 'ru',
            events: [{
//                title: "ololo",
//                start: '2016-04-16 10:00',
//                end:   '2016-04-17 23:00',
//                dow: [],
//                allDay: true,
            }],
            events: {
                url: "/alliance/creditcalendar/calendarsearch",
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
//            eventRender: function(event, element) {
//                  $(element).tooltip({title: event.title});             
//            },
//            dayClick: function(date, calEvent, jsEvent, view, resourceObj) {            
//                if (moment().diff(date,'days') > 0){
//                    alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
//                } else{
//                    var datesend = date.format("YYYY-MM-DD H:mm:ss");
//                    window.location = 'create';
//                }        		
//			},    eventRender: function (event, element) {
 
//            eventRender: function(calEvent, element) {
//               element.qtip({
//                   content: calEvent.title
//               });
//            },
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    window.open(calEvent.url);
//                    alert('Дата: ' + calEvent.start.format("DD/MM/YYYY H:mm:ss") + '\n\t' + 'Гос. рег. номер: ' + calEvent.title);
//                    $(this).css('border-color', 'red');
                    return false;
                }
//                $(this).css('border-color', 'red');
            },
//    		eventColor: '#4ba82e',

        });
    });
</script>

<div id='credit_calendar'></div>  

</div>