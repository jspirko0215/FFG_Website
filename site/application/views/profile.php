<script src="/js/profile.js"></script>

<div style="min-height: 420px" class="nodrag">
    <div class="g3 widgets nodrag">
        <div class="widget nodrag">
            <h3 class="handle">User info<!--<a class="collapse" title="collapse widget"></a>!--></h3>
            <div  style="min-height: 525px">
                <?php if($user['avatar']) echo'<div style="width:100%;text-align:center;"><img style="max-height:250px!important;max-width:250px!important;" src="/uploads/userpics/'.$user['avatar'].'"></div>'; ?>
                <h5 style="color:#6ba348;font-weight:bold;"><label style="font-weight: 900;color:#777777;">Username: </label><?php echo $user['username']; ?></h5>
                <h5 style="color:#6ba348;font-weight: bold;"><label style="font-weight: 900;color:#777777">First Name: </label><?php echo $user['firstName']; ?></h5>
                <h5 style="color:#6ba348;font-weight: bold;"><label style="font-weight: 900;color:#777777;">Last Name: </label><?php echo $user['lastName']; ?></h5>
                <h5 style="color:#6ba348;font-weight: bold;"><label style="font-weight: 900;color:#777777;">Date of birth: </label><?php echo $user['dateOfBirth']; ?></h5>
                <h5 style="color:#6ba348;font-weight: bold;"><label style="font-weight: 900;color:#777777;">Phone: </label><?php echo $user['phone']; ?></h5>
                <h5 style="color:#6ba348;font-weight: bold;"><label style="font-weight: 900;color:#777777;">E-mail: </label><a  style="font-weight: bold;color:#6ba348;" href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></h5> 
                <?php if($user['facebook_id']) echo'<a href="http://www.facebook.com/profile.php?id='.$user['facebook_id'].'"><img src="/images/facebook_box_white.png"></a>'; ?>
            </div>
        </div>
    </div>
    <div class="g9 widgets nodrag">
        <?php if(isset($widget_1)) echo $widget_1; ?>
        <?php if(isset($widget_2)) echo $widget_2; ?>
        <?php if(isset($widget_3)) echo $widget_3; ?>
    </div>
    <div style="clear:both;"></div>
</div>