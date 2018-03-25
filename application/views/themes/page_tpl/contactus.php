
    <?php if(isset($success)) { ?>
    <div class="success">
        Thanks for your message!
    </div>
   <?php } ?>
   <?php if(!empty($errors)) { ?> 
    <div class="error">
        <?php echo($errors); ?>
    </div>
   <?php } ?> 
    

        <!-- Content area ================= -->
        <div id="main" role="main" class="page">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <!-- Map -->
            <!-- <section class="header">

                 <div class="container">
                     <div class="row-fluid">

                         <div class="span12">
                              <h1 class="page-title">Contact Us</h1>

                            <p class="excerpt">
                               
                            </p>
                        </div>

                    </div>
                </div><!-- /container -->

            <!-- </section><!-- /header -->


           <!-- Content area ================== -->
            <section class="content">

                <div class="container">
                    <div class="row-fluid">

                        <aside class="span4" id="sidebar-left">
                            <div class="widget text">
                                <address>
                                    <strong>Fit for Green Corporate</strong><br>
                                     28492 Casanal<br>
                                     Mission Viejo, CA 92692<br>
                                     Phone: (866)936-7831<br>
                                     Email: <a href="mailto:support@fitforgreen">support@fitforgreen.com</a><br>
                                     Web-site: <a href="/">www.fitforgreen.com</a>
                                </address>
                            </div><!-- /widget#1 -->

                            <div class="widget social">
                                <ul>
                                    <li><a href="https://twitter.com/FitforGreen"><i class="icon-twitter"></i> Twitter</a></li>
                                    <li><a href="http://www.facebook.com/pages/Fit-for-Green/196705463732605"><i class="icon-facebook"></i> Facebook</a></li>

                                </ul>
                            </div><!-- /widget#2 -->
                        </aside>

                        <!-- Content ================== -->
                        <div class="span8 page">

                            <h1 class="page-title">Contact us</h1>
                            <p>Please complete the form below and we will respond to your inquiry within 48 hours.</p> 

                            <hr>

                            <form id="contact_form" action="/contactus" method="POST">
                                <div class="row-fluid">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="span12" value="">

                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="span12" value="">

                                <label for="message">Message:</label>
                                <textarea id="message" name="message" rows="8" class="span12"></textarea>


                                <p><br><input type="submit" class="btn" value="Send message"></p>
                                </div>
                            </form>   

                        </div><!-- /page -->
                        
                    </div>
                </div><!-- /container -->

            </section><!-- /header -->
            
        </div><!-- /main -->
