<?php if($competitions):?>
<div class="tab ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
        <?php foreach($competitions as $competition):?>
            <li class="ui-state-default ui-corner-top"><a href="#tabs-<?php echo $competition['competitionID'];?>"><?php echo $competition['competitionName'];?></a></li>
        <?php endforeach;?>
    </ul>
    <?php foreach($competitions as $competition):?>
    <div style="" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-<?php echo $competition['competitionID'];?>">
        <h5 style="text-align:center">TOP Teams</h5>
        <table style="background-image: none">
            <!--<thead>
                <tr>
                    <td>
                        Team
                    </td>
                    <td>
                        w/H Total
                    </td>
                </tr>
            </thead>-->
            <tbody>
                <?php foreach($competition['stats'] as $stats):?>
                    <tr>
                        <td><?php echo $stats['teamName'];?></td>
                        <td><?php echo $stats['wattHours'];?> W/h</td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>        
        <h5 style="text-align:center">TOP Members</h5>
        <ul class="gallery">
            <?php foreach($competition['members'] as $member):?>
            <li><a href="/profile/<?php echo $member['username'];?>" rel="wl_gallery">
            <?php if($member['avatar']):?>
            <img style="max-height:84px!important;max-width:84px!important;" alt="" src="/uploads/userpics/<?php echo $member['avatar'];?>"/>
            <?php else:?>
            <img width="84" height="84" alt="" src="/images/person.png"/>
            <?php endif;?>
                
                
            </a><div><?php echo $member['username'];?><br/><?php echo $member['wattHours'];?> W/h<br/><?php echo $member['teamName'];?></div></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endforeach;?>
</div>
<?php else:?>
<h3>You haven't any active competitions</h3>
<?php endif;?>