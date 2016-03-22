<?php
 
use yii\helpers\Html;
use app\modules\admin\Module;
use yii\bootstrap\Nav;
 
/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */
 
$this->title = Module::t('module', 'ADMIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index center-block">
    <h1><?= Html::encode($this->title) ?></h1>
 
    <p style="text-align: right">

        <?php 
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-right nav-pills'],
                'encodeLabels' => false,
                'items' => array_filter([
                    [
                        'label' => '<span class="glyphicon glyphicon-user"></span>  ' . Module::t('module', 'ADMIN_USERS'),
                        'url' => '/admin/users/index',
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-briefcase"></span>  ' . Module::t('module', 'ADMIN_POSITIONS'),
                        'url' => '/admin/positions/index',
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-tent"></span>  ' . Module::t('module', 'ADMIN_COMPANIES'),
                        'url' => '/admin/companies/index',
                    ],
                ]),
            ]);
        ?>
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

        var users_create = $.getValues("/src/admin_usercreategraph.php"); 
        // var users_create = $.getValues("admin_usercreategraph.php"); 
        
        var users_by_company = $.getValues("/src/admin_companyusercountgraph.php");

    $('#admin').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'area',
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
        labels: {
            items: [{
                // html: 'Заголовок',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        title: {
            text: 'График регистрации пользователей',
            x: -20 //center
        },
        credits: {
            enabled: true,
            href: "http://www.alians-kmv.ru",
            // position: undefined,
            // style: undefined,
            text: "Alliance Company Group",            
        },
        subtitle: {
            text: '<b>ООО "Альянс"</b>',
            x: -20
        },
        plotOptions: {
            column: {
                depth: 25
            },
            area: {
                pointStart: 0,
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                // threshold: 0,
                // softThreshold: false,
            },
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>:<br/>{point.y} ({point.percentage:.1f} %)',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        xAxis: {
            title: {
                text: '<b>Дата</b>'
            },
            categories: [],
                labels: {
                    style: { color: '#4ba82e' }
            },
        },
        yAxis: {
            // min: 0,
            // max: 100,
            // minRange : 0.1,
            // minPadding: 0, 
            // maxPadding: 0, 
            // startOnTick: false,
            // endOnTick: false,
            title: {
                text: '<b>График регистрации пользователей</b>'
            },
            tickInterval: 1,
            min: 0,
            minRange: 0.1,
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'График регистрации пользователей',
            data: users_create,
            // color: '#4ba82e',
            dataLabels: {
                enabled: true,
                // rotation: -90,
                // color: '#4ba82e',
                // align: 'right',
                x: 5,
                y: -5,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    // textShadow: '0 0 3px black'
                }
            }
        },
        {
            type: 'pie',
            name: 'Кол-во',
            data: users_by_company,
            center: [200, 30],
            size: 100,
            showInLegend: true,
            dataLabels: {
                enabled: true,
            }
        }
        ]
    });
});
</script>

<div class="col-lg-12" id="admin"></div>