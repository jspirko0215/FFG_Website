<div style="height:100px">
<img src="/images/widgets/bulb.png" style="float:left; margin-right:5px"/><h3><?php echo $totalWatts?  $totalWatts : '0' ;?> watts, lights a typical house bulb for <?php echo round($totalWatts/60,1)?round($totalWatts/60,1):round($totalWatts/60,2);?> hours</h3>
<?php if(!isset($profile)): ?>
<button id="posttowall_bulb" class="fl bfacebook" style="" title="Post to Facebook"><img src="/images/facebook.png" />Post to Facebook <span id="ploader" style="display:none;"><img  src="/images/fb_loader.gif"/></span></button> 
<?php endif; ?>
</div>
