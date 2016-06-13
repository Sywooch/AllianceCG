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

        // var users_create = $.getValues("/admin/adminquery/userscreated"); 
        var creditlastcount = $.getValues("/alliance/default/creditlastcount");

    $('#creditlastcount').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: 'container',
            width: null,
            height: null,
            spacingBottom: 0,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,

            // margin: 75,
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
                    left: '0',
                    top: '0',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        title: {
            text: '',
            x: -20 //center
        },
        shadow: {
            color: 'yellow',
            width: 10,
            offsetX: 10,
            offsetY: 10
        },
        credits: {
            enabled: false,
            // href: "/alliance/creditcalendar/calendar",
            // position: undefined,
            // style: undefined,
            // text: "ОКиС Календарь",            
        },
        // subtitle: {
        //     text: '<b>ООО "Альянс"</b>',
        //     x: -20
        // },
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
                    enabled: false,
                },
                // dataLabels: {
                //     enabled: false,
                //     format: '<b>{point.name}</b>:<br/>{point.y} ({point.percentage:.1f} %)',
                //     style: {
                //         color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                //     }
                // }
            }
        },
        xAxis: {
            categories: [],
                labels: {
                    style: { color: '#337ab7' }
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
                text: ''
            },
            tickInterval: 1,
            min: 0,
            minRange: 0.1,
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'bottom',
            format: '<b>{point.name}</b>:<br/>{point.y} ({point.percentage:.1f} %)',
            borderWidth: 0,
            x: 0,
            y: 10,
            useHTML: true,
            labelFormatter: function() {
                // return '<div style="text-align: left; width:130px;float:left;">' + this.name + '</div><div style="width:40px; float:left;text-align:right;">' + this.y + '%</div>';
                return this.name + ' ' + this.y + '%';
            }

        },
        series: [
        // {
        //     name: '',
        //     data: creditlastcount,
        //     // color: '#4ba82e',
        //     dataLabels: {
        //         enabled: true,
        //         // rotation: -90,
        //         // color: '#4ba82e',
        //         // align: 'right',
        //         x: 5,
        //         y: -5,
        //         style: {
        //             fontSize: '13px',
        //             fontFamily: 'Verdana, sans-serif',
        //             // textShadow: '0 0 3px black'
        //         }
        //     }
        // },
        //Pie
        {
            type: 'pie',
            name: 'Кол-во',
            data: creditlastcount,
            center: [80, 50],
            size: 130,
            showInLegend: true,
            dataLabels: {
                enabled: false,
            }
        }
        ]
    });
});