<link rel="stylesheet" id="themestyle" href="/js/jQueryTourPlugin/css/theme4/style.css"/>
<script src="/js/jQueryTourPlugin/js/jquery.easing.js"></script>
<script src="/js/jQueryTourPlugin/js/jTour.min.js"></script>


<div>
    <div  id="widget-dock" class="widgets bg09 widget-dock">
        <?php echo $widget_3; ?>
        <?php echo $widget_5; ?>
        <?php echo $widget_6; ?>
        <?php echo $widget_7; ?>
        <?php echo $widget_8; ?>
        <?php echo $widget_9; ?>
    </div>
</div>

<div id="dashboard" style="height:100%;  overflow: visible;height: 400px">
    <div id="pane-center" class="pane ui-layout-center" style=""><div class="widgets ">
            <div style="display:none">&nbps;</div>
        </div></div> 
    <div id="pane-east" class="pane ui-layout-east"><div class="widgets">
            <div style="display:none">&nbps;</div>
        </div></div> 
    <div  id="pane-west" class="pane  ui-layout-west"><div class="widgets">
            <div style="display:none">&nbps;</div>
        </div></div>
</div>

<script type="text/javascript">
           var fba={};
           var fbt=null;
		   var uid=<?php echo $uid;?>;
           
           $(document).ready(function(){
               
                <?php if(isset($_REQUEST['code'])):?>
                $.ajax(
                                    {
                                        type: "POST",
                                        data:
                                            {
                                            'code':<?php echo $_REQUEST['code']; ?>
                                            },
                                        dataType: 'json',
                                        url: "/members/updateAccessToken",
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==true){
                                                alert("Ok");
                                            }
                                            else{
                                                
                                               alert("NO");
                                                
                                            }
                                        }
                                        
                                       });
                <?php endif;?>
               
                $('#posttowall_burger').bind('click', function(ev){
                    var l = $('#ploader1');
                    
                    $.ajax(
                                    {
                                        type: "POST",
                                        data:
                                            {
                                            'memberId':<?php echo $uid; ?>
                                            },
                                        dataType: 'json',
                                        url: "/members/check_fb_assigned",
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==true){
                                                 l.show();
                                                 $.post('/members/posttofb', {message:'burger' }, function(response){l.hide()});
                                            }
                                            else{
                                                
                                                alert("Please assing your Facebook account first. You can do it in your profile settings");
                                                
                                            }
                                        }
                                        
                                       });
                    
                    
                   
                    
                    return false;
                });
                $('#posttowall_bulb').bind('click', function(ev){
                    var l = $('#ploader');
                    
                    $.ajax(
                                    {
                                        type: "POST",
                                        data:
                                            {
                                            'memberId':<?php echo $uid; ?>
                                            },
                                        dataType: 'json',
                                        url: "/members/check_fb_assigned",
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==true){
                                                 l.show();
                                                $.post('/members/posttofb', { message:'bulb' }, function(response){l.hide()});
                                            }
                                            else{
                                                
                                                alert("Please assing your Facebook account first. You can do it in your profile settings");
                                                
                                                
                                            }
                                        }
                                        
                                       });
                        
                   
                    
                    
                    
                    return false;
                })
            });
            
</script>  