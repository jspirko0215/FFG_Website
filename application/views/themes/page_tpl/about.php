<script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/js/highcharts/themes/grid.js"></script>

<script type="text/javascript">
    var chart;
    var chart1;
    $(document).ready(function () {

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chart',
                defaultSeriesType: 'spline'
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
                    text: 'Perfomance'
                },
                labels: {
                    formatter: function () {
                        return this.value + 'W/h'
                    }
                },
                min: 0
            },
            tooltip: {
                formatter: function () {
                    if (this.y == 0)
                        return false;
                    return '' +
                        Highcharts.dateFormat('%A %B %e %Y', this.x) + ': ' + this.y +
                        (this.series.name == 'Daily' ? ' W/h' : ' W/h');
                }
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    },
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                symbol: 'circle',
                                radius: 5,
                                lineWidth: 1
                            }
                        }
                    }
                }

            },
            series: [{
                name: 'Comulative',
                color: '#4572A7',
                type: 'spline',
                data: <?php echo $wattsComulative;?>

            }]
        });


        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'chart1'
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
                    formatter: function () {
                        return this.value + 'W/h'
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    var s;
                    if (this.point.name) { // the pie chart
                        s = '' +
                            this.point.name + ': ' + this.y + ' kW/h';
                    } else {
                        s = '' +
                            this.y + ' kW/h';
                    }
                    return s;
                }
            },
            series: [{
                type: 'column',
                name: 'UCI Rec Center',
                data: <?php echo $watts;?>
            }, {
                type: 'spline',
                name: 'FFG Average',
                data: <?php echo $watts;?>
            }/*, {
         type: 'pie',
         name: 'Total consumption',
         data: [{
            name: 'US Gym',
            y: 13,
            color: highchartsOptions.colors[0] // Jane's color
         }, {
            name: 'CA Sports',
            y: 23,
            color: highchartsOptions.colors[1] // John's color
         }, {
            name: 'BearGym',
            y: 19,
            color: highchartsOptions.colors[2] // Joe's color
         }],
         center: [100, 80],
         size: 100,
         showInLegend: false,
         dataLabels: {
            enabled: false
         }
      }*/]
        });

    });

</script>

<div id="main" role="main" class="page">


    <!-- Header area ================== -->
    <section class="header">

        <div class="container">
            <div class="row-fluid">

                <div class="span12">
                    <h1 class="page-title">Renewable Energy</h1>

                    <p class="excerpt">

                    </p>
                </div>

            </div>
        </div><!-- /container -->

    </section><!-- /header -->

    <!-- Content area ================== -->
    <section class="content">

        <div class="container">
            <div class="row-fluid">

                <!-- Content ================== -->
                <div class="span12 page">
                    <img src="/images/promo/team/UCClassPic.jpg" class="alignleft"/>
                    <h3 class="aligncenter">Who is Fit for Green</h3>
                    <p>Fit for Green is a provider of commercial cardio equipment for Fitness Centers. Our equipment is
                        unique because it engages participants in sustainability.
                        <br/>&nbsp;&nbsp;&nbsp; Workouts on Fit for Green Equipment:<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Impacts Climate Change - By creating clean energy from exercise
                        and feeding it back into the gym's power grid<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Impacts Natural Resource Preservation – By generating funds for
                        charities that protect them<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Impacts Cardiovascular Fitness - By exercising as you would on
                        any cardiovascular machine <br/>
                        The global impact of the offering is especially exciting for participants when considering there
                        are over 6 million units in use throughout the world. The clean energy and funding potential are
                        quite significant and the only requirement is that people continue to exercise as they do today
                        to be part of it!
                    </p>

                </div>
                <br/>
                <h3 class="aligncenter">Daily Progress</h3>
                <div id="chart">
                </div>
                <br/>
                <div class="feature-block">
                    <img src="/images/promo/stickers/1_16.png" class="alignleft"/>

                    <h3>Something New in the World of Green Energy</h3>
                    <p>Fit for Green will increase healthily planet awareness. As people exercise and generate power it
                        will not only be about them creating enough energy to light a bulb or charge an iPod but it will
                        also be about realizing what energy is and how difficult it is to create it. Just imagine, after
                        a grueling 1 hour cardio workout you look on the screen and see 150 watt-hours generated. Next
                        you relate that work you did to something real, “I can light a 75 watt bulb for two hours”.
                        Finally, take the work you did and realize that each time you leave that 75 watt bulb burning
                        needlessly the same burden is put on your planet mostly by burning coal.</p>

                </div>
                <br/>
                <h3 class="aligncenter">Top Gyms</h3>
                <div id="chart1">
                </div>

            </div><!-- /page -->

        </div>
</div><!-- /container -->

</section><!-- /header -->
</div><!-- /main -->