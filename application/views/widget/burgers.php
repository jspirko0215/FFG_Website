<div style="height:100px;">
<img src="/images/widgets/burger.png" style="float:left; margin-right:5px"/><h3><?php echo cal($totalWatts);?> calories, burns the equivalent of <?php echo round(cal($totalWatts)/350,1);?> ¼ lb hamburgers</h3>
<?php if(!isset($profile)): ?>
<button id="posttowall_burger" class="fl bfacebook" style="" title="Post to Facebook"><img src="/images/facebook.png" />Post to Facebook <span id="ploader1" style="display:none;"><img  src="/images/fb_loader.gif"/></span></button> 
<?php endif; ?>
</div>
