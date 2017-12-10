<div id="wrap">
        <?php  echo $slider; ?>
         
        <!-- Content area ================= -->    
        <div id="main" role="main">
        <!-- Call to action ================= -->
            <section class="call-to-action">
                <div class="container">
                    <div class="row-fluid">

                        <div class="widget call-to-action">
                            <div class="span9">
                                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Contact Fit for Green for
                                    More Information</p>
                            </div>
                            <div class="span3">
                                <a href="/prereg" class="btn btn-cta">Contact Now &raquo;</a>
                            </div>
                        </div><!-- /call-to-action -->

                    </div>
                </div><!-- /container -->
            </section><!-- /call-to-action -->

        </div><!-- /main -->
        <div style="float: left; height: 40px; width: 100%;"></div>
    </div>

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
            $(document).ready(function(){
                //$('#mainmenu > ul > li > ul').css('top', '-130px');
               //$('body').css('background', '#78BA37');
            });
            
            $('.fullwidthbanner').revolution({
                delay:9000,
                startwidth:940,
                startheight:460,

                onHoverStop:"on",                       // Stop Banner Timet at Hover on Slide on/off

                hideThumbs:200,
                navigationType:"bullet",                  //bullet, thumb, none, both  (No Shadow in Fullwidth Version !)
                navigationArrows:"verticalcentered",        //nexttobullets, verticalcentered, none
                navigationStyle:"square",                //round,square,navbar

                touchenabled:"on",                      // Enable Swipe Function : on/off

                navOffsetHorizontal:0,
                navOffsetVertical:20,

                stopAtSlide:-1,                         // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                stopAfterLoops:-1,                      // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

                fullWidth:"on",

                shadow:0                               //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)    
            });
        </script>
    </body>
</html>