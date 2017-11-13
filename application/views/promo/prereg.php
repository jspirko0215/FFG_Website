

<div id="main" role="main" class="page">
    
    <?php if(isset($success)) { ?>
    <div class="success" style="margin-top:10px;">
        Email saved!
    </div>
   <?php } ?>
   <?php if(!empty($errors)) { ?> 
    <div class="error">
        <?php echo($errors); ?>
    </div>
   <?php } ?> 
    <!-- Header area ================== -->
    <section class="header">

        <div class="container">
            <div class="row-fluid">

                <div class="span12">
                    <h1 class="page-title">Preregistration</h1>

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
                    <div class="row-fluid">
                        <div class="span3" id="hiddenimg">
                            <img src="images/promo/slides/iphone.png" width="200">
                        </div>
                        <div class="span9">
                            <p>Sorry, our mobile application is still in development.<br/>Please leave your name and email address so we can notify you when it becomes available.</p>
                            
                            <form id="prereg" action="/prereg" method="POST">
                                <div class="row-fluid">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" class="span6" value="">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="span6" value="">

                                    <p><br><input type="submit" class="btn" value="Send"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /page -->
            </div>
        </div><!-- /container -->
    </section><!-- /header -->
</div><!-- /main -->