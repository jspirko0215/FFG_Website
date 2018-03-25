<div id="<?php echo $widget_id; ?>" <?php if($profile_view==true) echo'style="width:470px;float:left;"'; ?> class="<?php echo $class;?>" 
<?php
foreach ($widget_settings as $key=>$val):
    echo $key.'="'.$val.'" ';
?>
<?php endforeach; ?>
         >
        <h3 class="handle"><?php echo $widget_title; ?></h3>
        <div class="widget-content">
<?php echo $widget_content; ?>
        </div>
        <div class="widget-preview" style="background: url(/images/widgets/<?php echo $widget_preview; ?>) center center no-repeat #fafafa;">
        </div>
</div>
<?php if($profile_view==true) echo '<div style="display:block;width:20px;float:left;">&nbsp;</div>';?>