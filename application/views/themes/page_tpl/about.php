
<script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/js/highcharts/themes/grid.js"></script>
<link rel="shortcut icon" href="/images/favicon.png"/>

<script type="text/javascript">
    var wattsChart;
    var memChart;
    $(document).ready(function () {

        wattsChart = new Highcharts.Chart({
            chart: {
                renderTo: 'wattsChart',
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
                    text: 'Fit for Green Lights'
                },
                labels: {
                    formatter: function () {
                        return this.value + ' Lights'
                    }
                },
                min: 0
            },
            tooltip: {
                formatter: function () {
                    if (this.y == 0)
                        return false;
                    return '' +
                        Highcharts.dateFormat('%B %Y', this.x) + ': ' + Highcharts.numberFormat(this.y, 1) +
                        (this.series.name == 'Daily' ? ' Lights' : ' Lights');
                }
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#5ac85a',
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
                name: 'Total Fit for Green Lights Over Time',
                color: '#5ac85a',
                type: 'spline',
                data: <?php echo $lightsCumulative;?>

            }]
        });

        memChart = new Highcharts.Chart({
            chart: {
                renderTo: 'memChart',
                type: 'column'
            },

            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 864000000
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' Members',
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                formatter: function () {
                    if (this.y == 0)
                        return false;
                    return '' +
                        Highcharts.dateFormat('%b %Y', this.x) + ': ' + Highcharts.numberFormat(this.y, 0) +
                        (this.series.name == 'Monthly' ? ' members' : ' Total Members');
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.01,
                    borderWidth: 0
                }
            },

            credits: {
                enabled: false
            },
            series: [{
                name: 'Member Growth Over Time',
                data: <?php echo $membersCumulative;?>
            }]
        });

        charityChart = new Highcharts.Chart({
            chart: {
                renderTo: 'charityChart'
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
                    text: 'US Dollars '
                },
                labels: {
                    formatter: function () {
                        return '$' + this.value
                    }
                },
                min: 0
            },
            tooltip: {
                formatter: function () {
                    var s;
                    if (this.point.name) {
                        s = '' +
                            this.point.name + ': ' + this.y + ' $ USD';
                    } else {
                        s = '' + '$' +
                            this.y;
                    }
                    return s;
                }
            },
            plotOptions: {
                line: {
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
                type: 'line',
                color: '#c8b400',
                name: "US Dollars Pledeged for Donation Over Time",
                data: <?php echo $charityCumulative;?>
            }]
        });

    });
</script>

<section id="main" role="main" class="page">


    <!-- Content area ================== -->
    <section class="content">

        <div class="container">
            <div class="row-fluid">

                <!-- Content ================== -->
                <div class="span12 page">

                    <iframe class="aligncenter" width="560" height="315" src="https://www.youtube.com/embed/bFseO2wBkTI"
                            frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <h2 class="aligncenter">Who is Fit for Green?</h2>
                    <p>Fit for Green provides a new generation of cardiovascular gym equipment. Our equipment is
                        unique because it engages participants and their social groups in sustainability. We do this by
                        converting the calories being burned during exercise into something useful for the environment.
                        The result is that you feel much better about working out and have a more meaningful and
                        rewarding
                        exercise experience!
                        <br/><br/>Exercising on Fit for Green Equipment has triple the impact:<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Impacts Climate Change - By generating power from exercise and
                        feeding it back into the power grid<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Impacts Natural Resource Preservation – By generating funds for
                        environmental charities<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Impacts Cardiovascular Fitness - By exercising as you would on
                        any cardiovascular machine <br/><br/>
                        Your impact potential becomes especially exciting when considering the global potential across
                        the
                        world's 7 million exercise machines that may someday be converted. Over time they could all be
                        clean
                        energy generators.
                        <br/><br/>
                        The clean energy and funding potential are significant and the only requirement is that people
                        continue
                        to exercise as they do today in order to be part of it! Its a super low friction way to support
                        sustainability. At Fit for Green We believe its the small things like this that will help us to
                        find
                        our way to a place where we aren't jeopardizing the future of our planet.
                    </p>

                </div>
                <div class="feature-block">
                    <a name="AboutPowerGeneration"></a>
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat1"></i>
                        </a>
                    </div><!-- /feature#1 -->
                    <h2 class="aligncenter">Power Generation</h2>
                    <p>Power being generated is measured during every workout on Fit for Green equipment! Users are
                        aware of
                        how much power they've generated through the amount of Fit for Green lights they see flowing
                        back into
                        the grid. There is also a "lights generated" indicator on every screen. Every 5 lights a user
                        generates
                        is equal to 1 watt hour of power.
                        <br/><br/>
                        The power generated is converted into AC electricity and is put into the grid through the power
                        outlet
                        that the machine is plugged into. This is how the person exercising helps to power the grid and
                        reduce
                        the need to draw power from the local power company. A Fit for Green machine can make as much as
                        a
                        typical home solar panel. The chart shown below shows Fit for Green's cumulative power lights
                        generated
                        since inception.
                    </p>
                    <br/>
                    <div id="wattsChart">
                    </div>
                    <br/>
                </div>
                <a name="AboutSocialEngagement"></a>
                <div class="feature-block">
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat2"></i>
                        </a>
                    </div><!-- /feature#2 -->
                    <h2 class="aligncenter">Social Engagement</h2>
                    <p> To add to the fun, motivation and challenge, the Fit for Green Platform enables users to join
                        with
                        the social groups that they hold dear. For example, their favorite sports team, their college,
                        or even
                        their favorite political party. Each month, based on the amount of power created, a single
                        entity
                        within each social group will be named the victor! A Fit for Green user may be associated with
                        more
                        than 1 group but can not register for more than 1 entity in any of the groups.
                        <br/><br/>
                        Susie may have San Diego Chargers as her favorite football team and University of California
                        Irvine as
                        her college. If Susie worked out and generated 50 lights worth of power, San Diego Chargers
                        would get
                        50 points and University of California Irvine would get 50 points. The chart below shows the
                        accumulation
                        of registered Fit for Green users over time.
                    </p>
                    <br/>
                    <div id="memChart">
                    </div>
                    <br/>

                </div>
                <a name="AboutCharitableGiving"></a>
                <div class="feature-block">
                    <div class="span2 widget feature">
                        <a href="#">
                            <i class="icon-feature" id="feat3"></i>
                        </a>
                    </div><!-- /feature#3 -->
                    <h2 class="aligncenter">Environmental Charity</h2>
                    <p> The most recent addition to the Fit for Green platform is a set of features that will drive
                        Charitable
                        contributions to sustainable causes. The thinking is that since the workout is about engaging in
                        the
                        act of sustainability we would create a smart way to make each workout a charitable event that
                        furthered
                        sustainable causes.
                        <br/><br/>
                        The pledging people or companies agree to donating a set amount per Fit for Green Power unit.
                        For example,
                        lets say that Acme Inc. agreed to donate $0.01 for each light worth of power during the month of
                        June to a
                        Fit for Green community approved sustainable charity of their choice. On June 1st Joe walks into
                        his campus
                        gym and generates 75 lights worth of power. During Joe's workout a notice flashes on the screen
                        indicating
                        that his workout is sponsored by Acme Inc. and which Fit for Green community approved
                        sustainable charity
                        is the beneficiary.
                        <br/><br/>
                        At the conclusion of Joe's workout it will tell him how much he raised for the charity and tell
                        him how much
                        was raised in total for this particular campaign. The chart below shows the total amount of
                        money pledged
                        to sustainable charities since inception.
                    </p>
                    <br/>
                    <div id="charityChart">
                    </div>
                    <br/>
                </div>
            </div>
        </div><!-- /container -->
    </section>
</section><!-- /main -->