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
			<h3>Compare my consumption data to all of Fit for Green</h3>
			<h5><?php echo $name.", ".$address;?></h5>
        </div>
        <div id="chart" style="height:250px;background: url(/images/promo/icon3.png) center center no-repeat; margin-top:80px"></div>
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
						renderTo: 'chart'
					},
					title: {
						text: ''
					},
					xAxis: {
						type: 'datetime',
						maxZoom: 864000000
					},
					yAxis: {
						title: {
							text: 'W/h'
						},
						labels: {
							formatter: function() {
								return this.value +'W/h'
							}
						}
					},
					tooltip: {
						formatter: function() {
							var s;
							if (this.point.name) { // the pie chart
								s = ''+
									this.point.name +': '+ this.y +' kW/h';
							} else {
								s = ''+
									this.y +' kW/h';
							}
							return s;
						}
					},
					series: [{
							type: 'column',
							name: 'Fit for Green',
							data: <?php echo $watts; ?>,
							color: '#3CB54F'
						}, {
							type: 'column',
							name: '<?php echo $name?>',
							data: <?php echo $watts_gb; ?>,
							color: '#366CBE'
						},
						{	type: 'pie',
							name: 'Total consumption',
							data: [{
									name: 'Fit for Green',
									y: <?php echo $total_watts; ?>,
									color: '#3CB54F' // Jane's color
								}, {
									name: '<?php echo $name?>',
									y: <?php echo $total_watts_gb; ?>,
									color: '#366CBE' // John's color
								}],
							center: [50, 50],
							size: 100,
							showInLegend: false,
							dataLabels: {
								enabled: false
							}
								
						}]
				});
			}
			drawChart();
					
        </script>
    </body>
</html>