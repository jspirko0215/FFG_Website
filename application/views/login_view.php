<?php if ($error) { ?>
    <div class="alert warning" style="display: block;">Undefined profile facebook</div>
<?php } ?>



<?php echo form_open('/members/login', array('id' => 'loginform')); ?>
<div id="login_title" style="text-align: center">
    <img src="/css/images/logo.png">
    <h4>Sign in</h4>
</div>
<fieldset id="login_fieldset" style="margin-top:1px">
    <?php if ($errors) { ?>
        <div style="width: 100%; text-align: center; color: red; padding: 1em">
            <?php echo $errors; ?>
        </div>
    <?php } ?>

    <section>
        <label for="login">Login</label>
        <div>
            <input type="text" id="login" name="login" value="<?php echo set_value('login', $login) ?>" autofocus/>
        </div>

    </section>

    <section>
        <label for="password">Password</label>
        <div>
            <input type="password" id="password" name="password"
                   value="<?php echo set_value('password', $password); ?>"/>
            <div style="float:right;"><a href="/members/forgot" title="Forgot password">Forgot password?</a></div>
        </div>
    </section>

    <section style="text-align: center">

        <button type="button">Sign In</button>
        <input type="hidden" name="submit" value="1"/>

    </section>

    <div style="text-align: center"><a href="/members/registration" title="registrations">Create account</a></div>

</fieldset>
<? echo form_close(); ?>


<script type="text/javascript">
    $(document).ready(function () {

        $(function () {
            $("form input").keypress(function (e) {
                if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                    $('button:last').click();
                    return false;
                } else {
                    return true;
                }
            });
        });

        var is_login = false;
        window.fbAsyncInit = function () {
            FB.init({appId: '<?php echo $fb['fb_appid'] ?>', status: true, oauth: true, cookie: true, xfbml: true});
            FB.getLoginStatus(function (response) {
                if (response) {
                    if (response.status == "connected") {
                        is_login = true;
                        //go(response.authResponse.userID);
                    }
                }
            });
        };

        (function () {
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
        }());


        function fb_login() {

            FB.login(function (response) {
                if (response) {
                    if (response.authResponse.userID //==<?php echo $cron_facebookid ?>) {
                        window.location = "https://www.facebook.com/dialog/oauth?client_id=<?php echo $fb['fb_appid']?>&redirect_uri=<?php echo base_url()?>members/updateAccessToken&scope=manage_pages,offline_access,publish_stream";


                    }
                    go(response.authResponse.userID);
                }
            }, {scope: 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown'});
        }

        $('#bfb').bind('click', function () {
            //if(!is_login){
            fb_login();
            //}
        });

        function go(uid) {
            $.post('/members/check_fb', {id: uid}, function (res) {
                if (res && res == "ok") {
                    location.href = '/members/dashboard';
                }
                else {
                    alert("Sorry, but this Facebook account isn't assigned to any of our members");

                }
            });
        }


    })


</script>