<?php

    header("Content-type: application/javascript");

	use yii\web\AssetBundle;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Nav;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\ArrayHelper;
    use yii\jui\DatePicker;
    use app\modules\admin\models\User;
    use yii\bootstrap\Modal;

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
    
    <?php 
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-left nav-pills'],
            'encodeLabels' => false,
            'items' => array_filter([
                [
                    'label' => FA::icon('calendar') . Module::t('module', 'SERVICESHEDULER_CALENDAR'),
                    'url' => '/skoda/servicesheduler/calendar',
                ],
                [
                    'label' => FA::icon('table') . Module::t('module', 'SERVICESHEDULER_TABLE'),
                    'url' => '/skoda/servicesheduler',
                ],
            ]),
        ]);
    ?>

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?php Html::a(FA::icon('trash') . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

    </p>

<script src='/js/jqfc/lib/jquery.min.js'></script>
<script src='/js/jqfc/lib/moment.min.js'></script>
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='/css/jqfc/fullcalendar.print.css' media='print' />
<script src='/js/jqfc/fullcalendar.js'></script>
<script src='/js/jqfc/lang/ru.js'></script>

<!-- Modal Window View Record -->
<div id="ViewCalEvent" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body alert alert-success"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button class="btn btn-success"><a id="eventUrl" target="_blank">К записи</a></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Window View Info -->
<div id="CalendarInfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalInfoTitle" class="modal-title"></h4>
            </div>
            <div id="modalInfoBody" class="modal-body alert alert-info"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Window Actions -->
<!-- <div id="EventsActions" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalActionsTitle" class="modal-title"></h4>
            </div>
            <div id="modalActionsBody" class="modal-body"> -->
                <!--  -->
                <?php // $this->render('_form', [
                    // 'model' => $model,
                    // ]) 
                ?>
                <!--  -->
<!--             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php // FA::icon('times') . Module::t('module', 'CALENDAR_CANCEL') ?></button>
                <button type="button" class="btn btn-success" id="skoda_calendar_add" data-dismiss="modal"><?php // FA::icon('save') . Module::t('module', 'CALENDAR_SAVE') ?></button>
            </div>
        </div>
    </div>
</div> -->

<script>

    // $(function() {
    //     $("button#skoda_calendar_add").click(function(){
    //         $.ajax({
    //             type: "POST",
    //             url: "create",
    //             dataType: "json",
    //             data: $('#Skoda_calendar').serialize(),
    //             success: function(){
    //                 $("#EventsActions").modal('hide');
    //                 $.skoda_calendar.fullCalendar('refetchEvents');
    //             },
                // error: function(){
                //     alert("failure");
                // }
    //        });
    //     });
    // });

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
                url: "/src/skoda/servicesheduler_calendar/index.php",   
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
                    $('#modalInfoTitle').html('Дата: ' + jsEvent.start.format("DD/MM/YYYY"));
                    $('#modalInfoBody').html('Выбранная дата меньше текущей! Не рекомендуется добавлять записи задним числом!');
                    $('#CalendarInfo').modal();
                } else{
                    var datesend = date.format();
                    window.location = 'create?date=' + datesend;
                    // window.location.replace('create');
                    // var today = new Date();
                    // var curdate = today.getDate()+'/'+today.getMonth()+'/'+today.getFullYear();
                    // document.getElementById("servicesheduler-date").value = date.format();
                    // $('#modalActionsTitle').html(curdate + ' Добавить запись.');
                    // $('#EventsActions').modal();                    
                }        		
			},
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.url) {
                    // alert('Ответственный: ' + calEvent.title + '\r\nДата: ' + calEvent.start.format());
                    $('#modalTitle').html('Дата: ' + calEvent.start.format("DD/MM/YYYY"));
                    $('#modalBody').html('Мастер-консультант: ' + calEvent.title);
                    $('#ViewCalEvent').modal();
                    return false;
                }             
            },
    		eventColor: '#4ba82e',

        });
    });
</script>

<!-- <br/><br/><br/><br/> -->
<div id='skoda_calendar'></div>
