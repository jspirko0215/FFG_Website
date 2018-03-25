<html lang="en">

<!-- <title>ResponsiveSlides.js &middot; Responsive jQuery slideshow</title> -->
<meta name="viewport" content="width=device-width,initial-scale=1">

<!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> -->
<script src="/js/promo/responsiveslides.min.js"></script>
<link rel="stylesheet" href="../css/promo/responsiveslides.css">


<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow
        $("#slider").responsiveSlides({
            speed: 800
        });
    });
</script>

<!-- Slideshow src="https://www.youtube.com/watch?v=bFseO2wBkTI&t=17s" <button id="play_video" </button> -->


<ul class="rslides" id="slider">
    <li>
        <img src="images/promo/slides/bikegridandcharity.png" alt="">
    </li>
    <li>
        <img src="images/promo/slides/bikewithrider.png" alt="">
        <!-- <p class="caption">This is a caption</p> -->
    </li>
    <li>
        <img src="images/promo/slides/studentsonellipticals.png" alt="">
    </li>
</ul>

</html>
