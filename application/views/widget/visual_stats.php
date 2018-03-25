<?php if($total['sumCalories']>=100):?>
<?php
for($i=0;$i<$total['sumCalories'];$i+=100):
?>
<img src="/images/icons/burger-48px.png"/>
<?php endfor;?>
<br>
<?php
for($i=0;$i<$total['sumWattHours'];$i+=60):
?>
<img src="/images/icons/bulb-48px.png"/>
<?php endfor;?>
<?php else:?>
Nothing here yet
<?php endif;?>