<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
            <meta charset="utf-8"/>
            <title>Fit For Green | human energy to generate electricity </title>
            <meta name="description" content="human generated electricity"/>
            <meta name="keywords" content="human energy,power gym,energy gym,green energy,generate electricity,human generated electricity,green gyms,green gym equipment"/>
            <meta name="viewport" content="width=device-width"/>
            <!--[if lte IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
            <link rel="shortcut icon" href="/images/favicon.png"/>
            <link rel="stylesheet" href="/css/promo/main.css"/>
            <link rel="stylesheet" href="/css/promo/style.css"/>

            <link rel="stylesheet" href="/css/promo/prettyPhoto.css"/>
            <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'/>

            <script type="text/javascript" src="/js/promo/jquery.js"></script>

            <script type="text/javascript">
                <?php if($this->uri->segment(1) == '')
                { ?>

                $(document).ready(function(){
                    $counters = $this->config->config->item('counters');
                    $('#energy').acounters({method:'1', number: <?php echo round($counters['wattHoursCount'] / 1000, 2); ?>, suffix: 'kW/h'});
                    $('#social').acounters({method:'2', number: <?php echo $counters['membersCount']; ?>, suffix: 'member'});
                    $('#competitions').acounters({number: <?php echo $counters['teamsCount']; ?>, suffix: 'team', method: '3'});

                });
                <?php } ?>


            </script>

    </head>
    <body onresize="resizeH()" onLoad="resizeH()">
<script type="text/javascript">
    
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-23102242-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Header area ================== -->
        <header id="header">
            <div class="container">
				<a href="/"><img src="images/promo/logo.png" alt="FitForGreen" /></a>

                <?php echo $menu; ?>
                <!--  <?php echo $output;?>  -->

            </div><!-- /container -->
        </header><!-- /header -->
