<?php if ($this->uri->segment(1) == '') { ?>  
    <!-- Slideshow Wrapper -->
    <div id="slide-wrapper">
        <!-- Slideshow Start -->
        <div id="slider">
            <a href="javascript:void(0)"><img src="/images/promo/s1.png" alt="Renewable Energy" title="Renewable Energy"/></a> <!-- Slide Item #3 -->
            <a href="javascript:void(0)"><img src="/images/promo/s2.png" alt="Social Media" title="Social Media"/></a> <!-- Slide Item #6 -->
            <a href="javascript:void(0)"><img src="/images/promo/s3.png" alt="Friendly Competition" title="Friendly Competition"/></a> <!-- Slide Item #2 -->
        </div>
        <!-- Slideshow End  -->
    </div>
<?php } else { ?>

    <div id="page-heading">
        <img src="/images/promo/page-heading1.jpg" alt="" />
        <?php if (isset($heading_title)) { ?>
            <div class="heading-text">
                <h3><?php echo($heading_title); ?></h3>
                <p><?php echo($heading_text); ?></p>
            </div>
        <?php } ?> 
    </div>
<?php } ?>  
<!-- Slideshow Wrapper End -->