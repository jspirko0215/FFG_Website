<div class="maincontent <?php echo( (!empty($sidebar))? 'main1': '' );  ?>">

    <?php echo $content; ?>        

</div>


<?php
   if(isset($sidebar)) 
    echo $sidebar; 
?>
                    