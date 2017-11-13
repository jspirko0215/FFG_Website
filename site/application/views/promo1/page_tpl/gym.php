<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta name="title" content="" />
        <meta name="description" content="" />
        <title>Fir for Green</title>

        <!-- Stylesheets Start //-->
        <link rel="shortcut icon" href="/images/favicon.png"/>
        <link href="/css/promo/style.css"       type="text/css" rel="stylesheet"  />
        <link href="/css/promo/prettyPhoto.css" type="text/css" rel="stylesheet"  />
        <link href="/css/promo/nivo-slider.css" type="text/css" rel="stylesheet"  />
        <link href="/css/promo/noscript.css"    type="text/css" rel="stylesheet"  media="screen,all" id="noscript" />

        
    <!-- Javascript Start //-->
    <script type="text/javascript" src="/js/promo/jquery.js"></script>
    <script type="text/javascript" src="/js/promo/cufon.js"></script>
    <script type="text/javascript" src="/js/promo/fonts/ColaborateLight.js"></script>
    <script type="text/javascript" src="/js/promo/functions.js"></script>
    <script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
        <script type="text/javascript" src="/js/promo/jquery.prettyPhoto.js"></script>
    
    <script type="text/javascript">
      Cufon.replace('h1')('h2')('h3')('h4')('h5')('#myslidemenu a',{hover: 'true'})('#myslidemenu li li a',{textShadow: '1px 1px #ffffff',hover: 'true'})('a.button', {hover: 'true'})('.nivo-caption p');
    </script>
    
    </head>
    <body style="background: none">
        <div>
            <img src="/images/promo/stickers/1_43.png" style="width:100px; float:right"/>
        <h3><?php echo $gymName; ?></h3>
        <h5><?php echo $gymAddress; ?></h5>
        </div>
        <div id="chart" style="height:250px;background: url(/images/promo/icon3.png) center center no-repeat; margin-top:50px"></div>
        <script type="text/javascript">
            Highcharts.setOptions({
                global: {
                    useUTC: false
                }
            });
            
            var chart;
            function drawChart()
            {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'chart',
                        defaultSeriesType: 'spline',
                        marginRight: 10
                    },
                    title: {
                        text: 'Daily Statistics'
                    },
                    xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150
                    },
                    yAxis: {
                        title: {
                            text: 'Watt'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                                Highcharts.dateFormat('%m/%d/%Y', this.x) +' : '+ 
                                Highcharts.numberFormat(this.y, 2)+'W/h';
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    exporting: {
                        enabled: false
                    },
                    plotOptions: {
                         areaspline: {
                            fillColor: {
                               linearGradient: [0, 0, 0, 300],
                               stops: [
                                  [0, '#008206'],
                                  [1, 'rgba(0,100,0,0)']
                               ]
                            },
                            lineWidth: 1,
                            marker: {
                               enabled: false,
                               states: {
                                  hover: {
                                     enabled: true,
                                     radius: 5
                                  }
                               }
                            },
                            shadow: false,
                            states: {
                               hover: {
                                  lineWidth: 1                  
                               }
                            }
                         }
                      },
                    series: [{
                            name: 'Live Perfomance',
                            type: 'areaspline',
                            data:  <?php echo $watts;?>
                        }]
                });
            }
            drawChart();
            
        </script>
    </body>
</html>