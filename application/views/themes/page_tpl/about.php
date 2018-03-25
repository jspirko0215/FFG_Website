
<script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/js/highcharts/themes/grid.js"></script>
<link rel="shortcut icon" href="/images/favicon.png"/>

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
                    text: 'Power Generated'
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
                name: 'Cumulative',
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
    <!--<section class="header">

        <div class="container">
            <div class="row-fluid">

                <div class="span12">
                    <h1 class="page-title">About Us</h1>

                    <p class="excerpt">

                    </p>
                </div>

            </div>
        </div><!-- /container -->

    <!--</section><!-- /header -->

    <!-- Content area ================== -->
    <section class="content">

        <div class="container">
            <div class="row-fluid">

                <!-- Content ================== -->
                <div class="span12 page">

                    <img src="/images/promo/team/UCClassPic.jpg" class="alignleft"/>
                    <h2 class="aligncenter">Who is Fit for Green?</h2>
                    <p>Fit for Green is a provider of cardiovascular gym equipment for fitness centers and homes
                        throughout the world.
                        Our equipment is unique because it engages participants in sustainability and in doing so, makes
                        them a member
                        of a community of like minded people.
                        <br/><br/>Exercising on Fit for Green Equipment has a triple impact:<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Impacts Climate Change - By generating power from exercise and
                        feeding it back into the gym's power
                        grid<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Impacts Natural Resource Preservation – By generating funds for
                        environmental charities<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Impacts Cardiovascular Fitness - By exercising as you would on
                        any cardiovascular machine <br/>
                        &nbsp;&nbsp;<br/>
                        Fit for Green's global impact is especially exciting when considering the potential in the 7
                        million units in
                        use throughout the world. Over time those could all be clean energy generators. The clean energy
                        and
                        funding potential are significant and the only requirement is that people continue to exercise
                        as they do today
                        in order to be part of it!
                    </p>

                </div>
                <div class="feature-block">
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat1"></i>
                        </a>
                    </div><!-- /feature#1 -->
                    <h2 class="aligncenter">Power Generation</h2>
                    <p>Power is generated and captured from every Fit for Green workout! The power captured is turned
                        into grid power
                        and is returned right back into the power outlet that the machine is plugged into. This is how
                        the person
                        exercising helps to power the gym so there is less of a need to draw power from the power
                        company. In many
                        cases 1 Fit for Green machine can make as much as a typical home solar panel. The chart shown
                        below shows Fit
                        for Green's cumulative power generation since inception.
                    </p>
                    <br/>
                    <div id="chart">
                    </div>
                    <br/>
                </div>
                <div class="feature-block">
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat2"></i>
                        </a>
                    </div><!-- /feature#2 -->
                    <h2 class="aligncenter">Community and Network Effect</h2>
                    <p> As the Fit for Green community grows in people and the number of enabled machines the impact
                        obviously becomes
                        more significant. The chart below shows the results with less than 50 machines connected. </p>
                </div>
                <div class="feature-block">
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat3"></i>
                        </a>
                    </div><!-- /feature#3 -->
                    <h2 class="aligncenter">Charity and Giving Back</h2>
                    <p>Power is captured from every Fit for Green workout! The power captured is turned into grid power
                        and it flows right back into the power outlet that the machine is plugged into. When nobody is
                        exercising the screen draws a small amount of power from the the wall outlet but as soon as the
                        machine is in motion power flows the other way. In other words the exerciser helps to power the
                        gym so they draw less power from the power company. In many cases 1 Fit for Green machine can
                        make as much as a typical home solar panel. </p>
                </div>


            </div>
            <br/>
            <h3 class="aligncenter">Community</h3>
            <div id="chart">
            </div>
            <br/>


        </div>
        <br/>
        <h3 class="aligncenter">Teaming</h3>
                <div id="chart1">
                </div>

            </div><!-- /page -->

        </div>
</div><!-- /container -->

</section><!-- /header -->
</div><!-- /main -->