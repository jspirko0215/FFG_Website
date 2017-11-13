<?php if($teams): ?>
    <div class="tab ui-tabs ui-widget ui-widget-content ui-corner-all">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
            <?php foreach ($teams as $team): ?>
                <li class="ui-state-default ui-corner-top"><a href="#tabs-<?php echo $team['teamID']; ?>"><?php echo $team['teamName']; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php foreach ($teams as $team): ?>
            <div style="" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-<?php echo $team['teamID']; ?>">
                <ul class="gallery">
                    <?php foreach ($team['members'] as $member): ?>
                        <li><a href="/profile/<?php echo $member['username']; ?>" rel="wl_gallery">
                                <?php if($member['avatar']): ?>
                                    <img style="max-height:84px!important;max-width:84px!important;" alt="" src="/uploads/userpics/<?php echo $member['avatar']; ?>"/>
                                <?php else: ?>
                                    <img width="84" height="84" alt="" src="/images/person.png"/>
                                <?php endif; ?>

                            </a><div><?php echo $member['username']; ?></div></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <h3>You haven't any teams at the moment</h3>
<?php endif; ?>