<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-type: application/javascript");
    use yii\web\AssetBundle;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\Json;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    
    $this->title = Module::t('module', 'STATUSMONITOR_INDEX');
    $this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
    $this->params['breadcrumbs'][] = $this->title;

?>

    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

    </p>
    
<script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar_sk_statusmonitor.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script>

<script>

    $(document).ready(function() {
        $('#skoda_statusmonitor_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            eventLimit: true,            
            selectable: false,
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

            dayRender: function(date, cell){            
                if (moment().diff(date,'days') > 0){
                    cell.css("background-color","silver");
                } else if (moment().diff(date,'days') < 0){
                    cell.css("background-color","white");
                } else{
                    cell.css("background-color","white");
                }
            },
            eventRender: function(event, element) {
                  $(element).tooltip({title: event.title});             
            },
            dayClick: function(date, calEvent, jsEvent, view, resourceObj) {            
                if (moment().diff(date,'days') > 0){
                    alert('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
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
            },
    		eventColor: '#4ba82e',

        });
    });
</script>

<div id='skoda_statusmonitor_calendar'></div>    

<script>
    $(document).ready(function(){
        var worker_today = "<?php echo $model->workerevent()?>";
        top.alert(worker_today);
    });
</script>