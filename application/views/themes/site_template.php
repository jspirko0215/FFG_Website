<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta name="resource-type" content="document"/>
    <meta name="robots" content="all, index, follow"/>
    <meta name="googlebot" content="all, index, follow"/>
    <?php
    /** -- Copy from here -- */
    if (!empty($meta))
        foreach ($meta as $name => $content) {
            echo "\n\t\t";
            ?>
            <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
        }
    echo "\n";

    if (!empty($canonical)) {
        echo "\n\t\t";
        ?>
        <link rel="canonical" href="<?php echo $canonical ?>" /><?php

    }
    echo "\n\t";

    foreach ($css as $file) {
        echo "\n\t\t";
        ?>
        <link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    }
    echo "\n\t";

    foreach ($js as $file) {
        echo "\n\t\t";
        ?>
        <script src="<?php echo $file; ?>"></script><?php
    }
    echo "\n\t";

    /** -- to here -- */
    ?>

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/promo/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/promo/style.css" rel="stylesheet">


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.png"
          type="image/x-icon"/>
    <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>
    <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>


    <meta charset="utf-8"/>
    <title>Fit For Green | human energy to generate electricity </title>
    <meta name="description" content="human generated electricity"/>
    <meta name="keywords"
          content="human energy,power gym,energy gym,green energy,generate electricity,human generated electricity,green gyms,green gym equipment"/>
    <meta name="viewport" content="width=device-width"/>
    <!--[if lte IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="shortcut icon" href="/images/favicon.png"/>
    <link rel="stylesheet" href="/css/promo/main.css"/>
    <link rel="stylesheet" href="/css/promo/style.css"/>

    <link rel="stylesheet" href="/css/promo/prettyPhoto.css"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'/>

    <script type="text/javascript" src="/js/promo/jquery.js"></script>

</head>

<body onresize="resizeH()" onLoad="resizeH()">

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-23102242-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>


<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <img src="<?php echo base_url(); ?>assets/themes/default/images/logo.png"
                 style="float:left;margin-top:0px;z-index:5" alt="logo"/>
            <div style="height: 0px;" class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="<?php echo site_url(); ?>">HOME</a></li>
                    <li><a href="<?php echo site_url('example/products'); ?>">PRODUCTS</a></li>
                    <!--
                <ul>
                    <li <?php echo 'class="current-menu-item"'; ?>><a href="/products">In-Gym Solution</a></li>
                </ul>
                -->
                    <li><a href="<?php echo site_url('example/about'); ?>">ABOUT</a></li>
                    <li><a href="<?php echo site_url('example/team'); ?>">MANAGEMENT TEAM</a></li>
                    <li><a href="<?php echo site_url('example/contactus'); ?>">CONTACT US</a></li>
                    <li><a href="<?php echo site_url('example/blog'); ?>">BLOG</a></li>
                    <li><a href="<?php echo site_url('example/login'); ?>">LOGIN</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <?php if ($this->load->get_section('text_header') != '') { ?>
        <h1><?php echo $this->load->get_section('text_header'); ?></h1>
    <?php } ?>
    <div class="row">
        <?php echo $output; ?>
        <?php echo $this->load->get_section('sidebar'); ?>
    </div>
</div>

<!-- Footer area ================== -->
<footer id="footer">

    <!-- Call to action ================= -->
    <?php //if($this->uri->segment(1) == '') { ?>
    <!-- Features area ================= -->
    <section class="features">
        <?php $counters = $this->config->item('counters'); ?>

        <div class="container">
            <div class="row-fluid">

                <div class="span4 widget feature">
                    <a href="#">
                        <i class="icon-feature" id="feat1"></i>
                        <h3>Total Workout Energy</h3>
                        <h2><?php echo round($counters['wattHoursCount'] / 1000, 2); ?> kW/h</h2>
                    </a>
                </div><!-- /feature#1 -->
                <div class="span4 widget feature">
                    <a href="#">
                        <i class="icon-feature" id="feat2"></i>
                        <h3>Social Media</h3>
                        <h2><?php echo $counters['membersCount']; ?> members</h2>
                    </a>
                </div><!-- /feature#2 -->
                <div class="span4 widget feature">
                    <a href="#">
                        <i class="icon-feature" id="feat3"></i>
                        <h3>Friendly Competition</h3>
                        <h2><?php echo $counters['teamsCount']; ?> teams</h2>
                    </a>
                </div><!-- /feature#3 -->

            </div>
        </div><!-- /container -->

    </section><!-- /features -->
    <?php //} ?>


    <!-- Content ================= -->
    <section class="content">

        <div class="container">

            <div class="row-fluid">

                <div class="span3 widget">
                    <h4>About Fit For Green</h4>
                    <ul class="unstyled">
                        <li>
                            <a href="https://www.youtube.com/watch?v=bFseO2wBkTI">Introductory video </a>
                        </li>
                    </ul>
                </div>

                <div class="span3 widget">
                    <h4>Contact</h4>
                    <address>
                        <strong>Fit for Green, Inc.</strong><br>
                        28492 Casanal<br/>
                        Mission Viejo, CA 92692<br/>
                        Phone: (866)936-7831<br/>
                        Email: support@fitforgreen.com
                    </address>
                </div>

                <div class="span3 widget">
                    <h4>Social Links</h4>
                    <ul class="unstyled">
                        <li><a href="http://www.facebook.com/pages/Fit-for-Green/196705463732605">Facebook</a></li>
                        <li><a href="https://twitter.com/FitforGreen">Twitter</a></li>
                        <li><a href="http://www.youtube.com/user/fitforgreen">YouTube</a></li>
                    </ul>
                </div>
                <div class="span3 widget">
                    <h4>Site Map</h4>
                    <ul class="unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Products</a></li>
                        <li><a href="/social">About</a></li>
                        <li><a href="/contactus">Contact us</a></li>
                    </ul>
                </div>

            </div>
        </div><!-- /container -->

    </section>


    <!-- Footer bottom ================= -->
    <section class="bottom">

        <div class="container">
            <div class="row-fluid">

                <p class="span12 copyright">Copyright &copy; Fit for Green. All rights reserved</p>

            </div>
        </div><!-- /container -->

    </section>

</footer><!-- /footer -->


<!-- Load scripts ================= -->

<script src="/js/promo/vendor/modernizr-2.6.1.min.js"></script>

<script type="text/javascript" src="/js/promo/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/js/promo/cufon.js"></script>
<script type="text/javascript" src="/js/promo/fonts/ColaborateLight.js"></script>
<script type="text/javascript" src="/js/promo/functions.js"></script>
<script type="text/javascript" src="/js/promo/tooltip.js"></script>
<script type="text/javascript" src="/js/promo/jquery.acounters.js"></script>


<script type="text/javascript" src="/js/promo/plugins.js"></script>
<script type="text/javascript" src="/js/promo/main.js"></script>


<script type="text/javascript">
    $('.fullwidthbanner').revolution({
        delay: 9000,
        startwidth: 940,
        startheight: 460,

        onHoverStop: "on",                       // Stop Banner Timet at Hover on Slide on/off

        hideThumbs: 200,
        navigationType: "bullet",                  //bullet, thumb, none, both  (No Shadow in Fullwidth Version !)
        navigationArrows: "verticalcentered",        //nexttobullets, verticalcentered, none
        navigationStyle: "square",                //round,square,navbar

        touchenabled: "on",                      // Enable Swipe Function : on/off

        navOffsetHorizontal: 0,
        navOffsetVertical: 20,

        stopAtSlide: -1,                         // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
        stopAfterLoops: -1,                      // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

        fullWidth: "on",

        shadow: 0                               //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
    });
</script>

<div id="fb-root"></div>

<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=284269505019152";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
