
<!-- <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script> -->
<!-- <link rel="stylesheet" href="/css/queryLoader.css" type="text/css" /> -->
<!-- <script type='text/javascript' src='/js/queryLoader.js'></script> -->

<?php

use yii\helpers\Html;
use app\modules\skoda\Module;

$this->title = Module::t('module', 'ŠKODA');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index center-block">
    <h1><?= Html::encode($this->title) ?></h1>
 
    <p style="text-align: right">
        <?php echo Html::a('<span class="glyphicon glyphicon-calendar"></span>  ' . Module::t('module', 'SERVICESHEDULER'), ['servicesheduler/index'], ['class' => 'btn btn-success']) ?>
        
        <?php echo Html::a('<span class="glyphicon glyphicon-wrench"></span>  ' . Module::t('module', 'STATUSMONITOR'), ['statusmonitor/index'], ['class' => 'btn btn-success']) ?>
    </p>    
    
</div>

<script src='/js/highcharts/highcharts.js'></script>
<script>
$(function () {

        jQuery.extend({
            getValues: function(url) {
                var result = null;
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        result = data;
                    }
                });
               return result;
            }
        });

        var myServerData = $.getValues("/src/skoda_statusmonitorgraph.php"); 

    $('#skoda').highcharts({
        chart: {
            type: 'column',
            renderTo: 'container',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'График нагрузки (текущий месяц)',
            x: -20 //center
        },
        credits: {
            enabled: true,
            href: "http://www.alians-kmv.ru",
            position: undefined,
            style: undefined,
            text: "Alliance CG",            
        },
        subtitle: {
            text: 'ООО "СтрелаАвто"',
            x: -20
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            title: {
                text: 'Дата'
            },
            categories: [],
                labels: {
                    style: { color: '#4ba82e' }
            },
        },
        yAxis: {
            title: {
                text: 'Кол-во автомобилей в день'
            },
            tickInterval: 1,
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Кол-во автомобилей в день',
            data: myServerData,
            color: '#4ba82e',
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                x: 4,
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    });
});
</script>

<div id="skoda" style="width:70%; height:300px;" align="center"></div>


<!--script type='text/javascript'>
    QueryLoader.init();
</script-->