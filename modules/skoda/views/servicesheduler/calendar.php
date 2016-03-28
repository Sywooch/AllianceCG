<?php

    header("Content-type: application/javascript");

    use yii\web\AssetBundle;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\ArrayHelper;
    use yii\jui\DatePicker;
    use app\modules\admin\models\User;
    use yii\bootstrap\Modal;
    use yii\helpers\Json;

    $this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
    $this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('masterConsultantDoesNotExistToday')): ?>

    <div class="alert alert-danger">
        <?= Yii::$app->formatter->asDate('now', 'dd/MM/yyyy') . ' - ' . Module::t('module', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY') ?>
    </div>

<?php //endif; ?>

<?php elseif (Yii::$app->session->hasFlash('masterConsultantIs')) : ?>

    <div class="alert alert-success">
        <?= Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Module::t('module', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsible ?>
    </div>

<?php endif; ?>

<h1><span class="glyphicon glyphicon-wrench" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?php Html::a(FA::icon('trash') . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>

    </p>

<?php
    Modal::begin([
        'id' => 'skoda_servicesheduler_modal',
        'header' => '',
        'headerOptions' => ['id' => 'modal-header'],
        'footer' => '',
        'footerOptions' => ['id' => 'modal-footer'],
    ]);
    
    echo '<div id=modal-body>';
    echo '</div>';
     
    Modal::end();
?>

    <?php
//        echo $searchModel->calendarSearch();
    ?>

<script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script>

<script>

    $(document).ready(function() {
        $('#skoda_calendar').fullCalendar({
            editable: true,
            weekMode: 'liquid',
            eventLimit: true,            
            selectable: false,
            height: 600,
            width: 600,
            lang: 'ru',
            events: {
//                url: "/src/skoda/servicesheduler_calendar/index.php",
                url: "/skoda/servicesheduler/calendarsearch",
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
                    cell.css("background-color","#ededed");
                } else{
                    cell.css("background-color","white");
                }
            },
            eventRender: function(event, element) {
                  $(element).tooltip({title: event.title});             
            },
			dayClick: function(date, calEvent, jsEvent, view, resourceObj) {            
                if (moment().diff(date,'days') > 0){                    
                    var modal_dismiss = '<button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>';
                    var d = document.getElementById("modal-body");
                    d.className = " alert alert-info";
                    $('#modal-header').html('Дата: ' + jsEvent.start.format("DD/MM/YYYY"));
                    $('#modal-body').html('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
                    $('#modal-footer').html(modal_dismiss);
                    $('#skoda_servicesheduler_modal').modal();
                } else{
                    var datesend = date.format();
                    window.location = 'create?date=' + datesend;
                }        		
			},
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    var link_to_record = '<a id="eventUrl" target="_blank class="btn btn-success" role="button">К записи</a>';                    
                    var modal_dismiss = '<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>';
                    var d = document.getElementById("modal-body");
                    d.className = " alert alert-success";
                    $('#modal-header').html('Дата: ' + calEvent.start.format("DD/MM/YYYY"));
                    $('#modal-body').html('Мастер-консультант: ' + calEvent.title);
                    // $('#modal-footer').html(link_to_record + modal_dismiss);
                    $('#modal-footer').html(modal_dismiss);
                    $('#skoda_servicesheduler_modal').modal();                    
                    return false;
                }             
            },
    		eventColor: '#4ba82e',

        });
    });
</script>

<div id='skoda_calendar'></div>
