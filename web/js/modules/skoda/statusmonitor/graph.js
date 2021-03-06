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

        var serviceLoad = $.getValues("/skoda/skodaquery/statusmonitorgraph"); 
        var workerLoad = $.getValues("/skoda/skodaquery/workerloadgraph"); 

    $('#skoda').highcharts({
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
            text: 'График нагрузки (текущий месяц)',
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
            text: '<b>ООО "СтрелаАвто"</b>',
            x: -20
        },
        noData: {
            // Custom positioning/aligning options
            position: {	
                align: 'right',
                verticalAlign: 'bottom'
            },
            // Custom svg attributes
            attr: {
                'stroke-width': 1,
                stroke: '#cccccc'
            },
            // Custom css
            style: {                    
                fontWeight: 'bold',     
                fontSize: '15px',
                color: '#202030'        
            }
        },
        plotOptions: {
            column: {
                depth: 25
            },
            area: {
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
                threshold: null,
                softThreshold: true,
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
            title: {
                text: '<b>Кол-во автомобилей на дату</b>'
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
            name: 'Кол-во автомобилей на дату',
            data: serviceLoad,
            color: '#4ba82e',
            dataLabels: {
                enabled: true,
                // rotation: -90,
                color: '#4ba82e',
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
            data: workerLoad,
            center: [200, 30],
            size: 100,
            showInLegend: true,
            dataLabels: {
                enabled: true,
            }
        }]
    });
});