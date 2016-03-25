<?php
	use yii\web\AssetBundle;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;

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
    
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <p style="text-align: right">

        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>  ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>  ' . Module::t('module', 'STATUS_DELETE'), ['#'], ['class' => 'btn btn-danger', 'id' => 'MultipleDelete']) ?>  

    </p>

<?php 
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-left nav-pills'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => Module::t('module', 'SERVICESHEDULER_CALENDAR'),
                'url' => '/skoda/servicesheduler/calendar',
            ],
            [
                'label' => Module::t('module', 'SERVICESHEDULER_TABLE'),
                'url' => '/skoda/servicesheduler',
            ],
        ]),
    ]);
?>

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
            eventRender: function(event, element) {
                  $(element).tooltip({title: event.title});             
            },
			dayClick: function(date, jsEvent, view, resourceObj) {
        		window.location.replace('create');
			},
    		eventClick: function(calEvent, jsEvent, view) {
    		    alert('Ответственный: ' + calEvent.title + '\r\nДата: ' + calEvent.start.format());
    		},
    		eventColor: '#4ba82e',

        });
    });
</script>

<br/><br/><br/><br/>

<div id='calendar'></div>
