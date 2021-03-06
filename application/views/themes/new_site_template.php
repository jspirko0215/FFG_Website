<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
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
    <script type="text/javascript">

    </script>

    <!-- <body onresize="resizeH()" onLoad="resizeH()"> -->
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

<!-- Header area ================== -->
<header id="header">
    <div class="container" STYLE="height: 40px;">
        <a href="/"><img src="/assets/themes/default/images/logo.png" alt="FitForGreen"/></a>

        <nav id="mainmenu" class="menu" STYLE="height: 40px; margin: 5px;">
            <ul>
                <li <?php if ($_SESSION['current'] == 'Home') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/">Home</a></li>
                <li <?php if ($_SESSION['current'] == 'About') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/about">About</a></li>
                <li <?php if ($_SESSION['current'] == 'Products') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/products">Products</a></li>
                <li <?php if ($_SESSION['current'] == 'Team') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/team">Team</a></li>
                <li <?php if ($_SESSION['current'] == 'Contact') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/contactus">Contact</a></li>
                <li <?php if ($_SESSION['current'] == 'Blog') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/blog">Blog</a>
                <li <?php if ($_SESSION['current'] == 'Members') {
                    echo 'class="current-menu-item"';
                } ?>><a href="/members">Login</a></li>
            </ul>
        </nav>
    </div><!-- /container -->
</header><!-- /header -->
</head>

<?php echo $output; ?>

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
                    <a href="about/#AboutPowerGeneration">
                        <i class="icon-feature" id="feat1"></i>
                        <h3>Power Generation</h3>
                        <h2><?php echo round($counters['wattHoursCount'] / 200000, 3); ?>M Lights</h2>
                    </a>
                </div><!-- /feature#1 -->
                <div class="span4 widget feature">
                    <a href="about/#AboutSocialEngagement">
                        <i class="icon-feature" id="feat2"></i>
                        <h3>Social Engagement</h3>
                        <h2><?php echo $counters['membersCount']; ?> members</h2>
                    </a>
                </div><!-- /feature#2 -->
                <div class="span4 widget feature">
                    <a href="about/#AboutCharitableGiving">
                        <i class="icon-feature" id="feat3"></i>
                        <h3>Environmental Charity</h3>
                        <h2>$<?php echo $counters['totalDonation']; ?> </h2>
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
                    <a href="https://www.youtube.com/watch?v=bFseO2wBkTI">Watch Product Intro video </a>
                </div>

                <div class="span3 widget">
                    <h4>Contact</h4>
                    <address>
                        <strong>Fit for Green, Inc.</strong><br>
                        28492 Casanal<br/>
                        Mission Viejo, CA 92692<br/>
                        Phone: (800)479-2148<br/>
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
    }(document, 'script', 'facebook-jssdk'));</script>


</html>
