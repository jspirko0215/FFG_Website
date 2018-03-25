<div style="width:500px;margin:auto">
    <form method="post" action="/edit_profile" enctype='multipart/form-data' id="profileform"  style="width:500px">
        <fieldset>
            <label>Edit profile</label>
            <section>
                <label for="firstName">First Name</label>
                <div><input type="text" value="<?php echo set_value('firstname', $firstName); ?>" name="firstName" id="firstName" required /></div>
            </section>

            <section>
                <label for="lastName">Last Name</label>
                <div><input type="text" value="<?php echo set_value('lastname', $lastName); ?>" name="lastName" id="lastName" required /></div>
            </section>
            <section>
                <button id="chp" class="fl"   title="Change my password">Change my password</button>
            </section>
            <section id="password_fields" style="display:none;">
                <label for="password">Password:</label>
                    <div><input type="password" id="password" name="password" class="confirm" value="" /></div>
          
            </section>   
            <section>
                
                <div id="userlogo">
                    <div id="avatar_preview" style="display:block;">
                        <?php if($avatar): ?>
                            <img src="/uploads/userpics/<?php echo $avatar; ?>"/>     
                       
                        <?php endif; ?>   
                    </div>
                    <div id="upload-box" >
                        <div id="file-uploader" >
                            <noscript>Please enable Javascript in your browser</noscript>
                        </div>
                    </div>

                    <input type="hidden" value="<?php if($avatar != NULL)
                        {
                            echo set_value('avatar', $avatar);
                        } ?>" name="avatar" id="avatar" />
                </div>
            </section>

            <section>
                <label for="email">Email</label>
                <div><input type="email" class="email" value="<?php echo set_value('email', $email); ?>" name="email" id="email" required /></div>
            </section>

            <section>
                <label for="state" >State</label>
                <div ><?php echo $state; ?></div>
            </section>

            <section>
                <label for="city">City</label>
                <div><input type="city" class="city" value="<?php echo set_value('email', $city); ?>" name="city" id="city" /></div>
            </section>

            <section>
                <label for="phone">Telephone</label>
                <div><input type="text" value="<?php echo set_value('phone', $phone); ?>" name="phone" id="phone"/></div>
            </section>

            <section>
                <label for="date">Date Of Birth</label>
                <div><input type="text" value="<?php echo set_value('phone', $dateOfBirth); ?>" name="date" id="date" class="date" placeholder="MM/DD/YYYY"/></div>
            </section>

   
            
            <section>

<button id="bfb_a" class="fl bfacebook" style="<?php if($facebook != NULL) echo "display:none;"; ?>" title="Assign with facebook profile"><img src="/images/facebook.png" />Assign with facebook profile</button> 

<section style="width:60%;float:left;<?php if($facebook == NULL) echo "display:none;"; ?>" id="checkbox_fb" >
 <div style="float:left;"><input type="checkbox" id="post_fb" name="post_fb"  <?php if($post_fb) echo 'checked' ;?> style="float:left;"/><label for="post_fb">Post data to facebook wall</label></div>
 
</section>




            
               
                    <button id="bfb_un" class="fl bfacebook" style="<?php if($facebook == NULL) echo "display:none;"; ?>" title="Unassign my facebook profile"><img src="/images/facebook.png" />Unassign my facebook profile</button> 
                
                    <button class="fr">Save</button>
                    <input type="hidden" value="1" name="submit" id="submit"> 
                    
            </section>
            
                    </fieldset>
                    </form>    
                    </div>


                    <script type="text/javascript" src="/js/uploader/fileuploader.js"></script>
                    <link rel="stylesheet" type="text/css" href="/js/uploader/fileuploader.css" />


                    <script type="text/javascript">
                        $(document).ready(function(){
    
                            var isUpload =  <?php if($avatar != NULL)
{
    echo "true;";
}
else
{
    echo "false;";
} ?>
  
  
                            var temp1= '<div class="qq-uploader">' +
                                '<div id="upload_avatar" class="fr cbtn qq-upload-button">Upload logo</div>' +
                                '<div id="delete_avatar" class="fr cbtn" style="display:none;">'+
                                'Replace logo</div>'+
                                '<ul class="qq-upload-list"></ul>' +
                                '<div class="clear"></div></div>';
                            var temp2= '<div class="qq-uploader">' +
                                '<div id="upload_avatar" class="fr cbtn qq-upload-button" style="display:none;">Upload logo</div>' +
                                '<div id="delete_avatar" class="fr cbtn" ">'+
                                'Replace logo</div>'+
                                '<ul class="qq-upload-list"></ul>' +
                                '<div class="clear"></div></div>';



                            $('#delete_avatar').live('click', function(){
                                var me = $(this);
                                $.post('/members/delete_avatar', {filename: $('#avatar').val() },function(response){
                                    me.fadeOut('100', function(){$('#upload_avatar').fadeIn('100')});
                                    $('#avatar_preview').html('');
                                });
                                $('#avatar').val('');
                                isUpload = false;
                                $('.qq-upload-list').find('li').remove();
                            });

                            var uploader = new qq.FileUploader({
                                element: document.getElementById('file-uploader'),
                                action: '/members/upload_avatar',
                                template: isUpload?temp2:temp1,
                                multiple: false,
                                debug: true,
                                onComplete: function(id, fileName, responseJSON){
                                    $('#upload_avatar').fadeOut('100', function(){$('#delete_avatar').fadeIn(200);});
                                    $('#avatar').val(responseJSON.filename);
            
                                    $('#avatar_preview').html('<img src="/uploads/preload/'+responseJSON.filename+'" />').fadeIn(400);
                                    isUpload = isUpload?false:true;
                                }
                            });   
    
    
    

                            window.fbAsyncInit = function() {
                                FB.init({appId:'<?php echo $fb['fb_appid'] ?>', status: true, oauth : true, cookie: true, xfbml: true});   
                                FB.getLoginStatus(function(response) {
                                    if (response) {
                                        if(response.status == "connected"){
                                            //$('#bfb_a').hide();  
                                            //go(response.authResponse.userID);
                                        }
                                        else{
                                            $('#bfb_a').fadeIn('slow');  
                                        }
                                    }
                                });
                            };
                            (function() {
                                var e = document.createElement('script');
                                e.type = 'text/javascript';
                                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                                e.async = true;
                                document.getElementById('fb-root').appendChild(e);
                            }());

                            $('#bfb_a').bind('click', function(){
                                //if(!is_login){
                                login();
        
                                //}
                            });
                            $('#bfb_un').bind('click', function(){
                                //if(!is_login){
                                unassign();
        
                                //}
                            });
                            $('#chp').bind('click', function(){
                                //$('#chp').slideUp('fast'); 
                                $('#password_fields').toggle();
                            });

                            function login(){
                                FB.login(function(response) {
                                    if (response.authResponse) {
                                        fbt = response.authResponse.accessToken;
                                        fb_me();
                                        
                                    } else {
                                        alert('User cancelled login or did not fully authorize.');
                                    }
                                }, {scope: '<?php echo $fb['fb_auth']; ?>'});
                            }

                            function fb_me(){
                                FB.api('/me', function(response) {
                                    fba = response;
                                    init();
                                });
                            }
                            function unassign(){
                               $.ajax(
                                    {
                                        type: "POST",
                                        data:
                                            {
                                            'memberId':<?php echo $uid; ?>
                                            
                                        },
                                        dataType: 'json',
                                        url: "/ajax/unassign_fb",
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==true){
                                            alert("Successful unassigned");
                                            $('#bfb_un').hide();
                                            $('#checkbox_fb').hide();
                                            $('#bfb_a').show();
                                            }
                                            
                                        }
                                    }
                                );
                            }

                            function init(){
                                if(!isEmpty(fba)){
                                    $.ajax(
                                    {
                                        type: "POST",
                                        data:
                                            {
                                            'memberId':<?php echo $uid; ?>,
                                            'facebook_id': fba.id,
                                            'facebook_login': fba.email,
                                            'facebook_token': fbt
                                        },
                                        dataType: 'json',
                                        url: "/ajax/assign_fb",
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==true){
                                            alert("Successful assigned with facebook");
                                            $('#bfb_a').hide();
                                            $('#checkbox_fb').show();
                                            $('#bfb_un').show();
                                            
                                            }
                                            else{
                                                alert("This facebook profile already assigned");
                                                FB.logout(function(response) {}); 
                                                
                                            }
                                        }
                                    }
                                );
        
                                    // $('#facebook_id').val(fba.id);
                                    // $('#facebook_login').val(fba.username);
                                    // $('#facebook_token').val(fbt);
                                    //  var  img = $('<img />').attr('src', 'https://graph.facebook.com/'+fba.id+'/picture?type=large');
                                    // $('#avatar_preview').empty().append(img)
                                    // $('#facebook_avatar').val('https://graph.facebook.com/'+fba.id+'/picture?type=large');
                                    //  var date = fba.birthday.split('/')
                                    //  $('#date').val(date[1]+'/'+date[0]+'/'+date[2]);
                                }
                            }

                            function isEmpty(obj) {
                                return Object.keys(obj).length === 0;
                            }


                        });
                    </script>