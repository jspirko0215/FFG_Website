
<form method="post" action="/members/registration" id="registerform">
    <div id="register_title" style="text-align: center">
    <img src="/css/images/logo.png">
    <h4>Registration</h4>
    </div>
    <fieldset style="margin-top:1px">
    <section>
        <button style="margin-left:60px" type="button" id="fb" class="fl bfacebook"><img src="/images/facebook.png" />Sign In with Facebook</button>
    </section>
    <section> 
        <label for="username">Login:</label>
         <div><input type="text" class="text" value="<?php echo set_value('username', $username); ?>" name="username" id="username" required /></div>
   </section> 
    
    <section>
        <label for="firstname">First Name:</label>
        <div><input type="text" value="<?php echo set_value('firstname', $firstname); ?>" name="firstname" id="firstname" required /></div>
    </section>    
    
    <section>
        <label for="lastname">Last Name:</label>
        <div><input type="text" value="<?php echo set_value('lastname', $lastname); ?>" name="lastname" id="lastname" required /></div>
    </section>    
    
    <section>
        <label for="avatar">User logo:</label>
        <div>
            <div id="avatar_preview" style="display:block;"></div>
            <div id="upload-box">
                <div id="file-uploader">
                    <noscript>Please enable Javascript in your browser</noscript>
                </div>
            </div>
            
            <input type="hidden" value="" name="avatar" id="avatar" />
        </div>
    </section>    
        
    
    <section>
        <label for="email">Email:</label>
        <div><input type="email" class="email" value="<?php echo set_value('email', $email); ?>" name="email" id="email" required /></div>
    </section>

    <section style="display: none">
        <label for="state">State:</label>
        <div><?php echo $state;?></div>
    </section>

    <section style="display: none">
        <label for="city">City:</label>
        <div><input type="city" class="city" value="<?php echo set_value('city', $city); ?>" name="city" id="city" /></div>
    </section>
    
    <section style="display: none">
        <label for="telephone">Telephone:</label>
        <div><input type="text" value="<?php echo set_value('telephone', $telephone); ?>" name="telephone" id="telephone" /></div>
    </section>

   <section style="display: none">
        <label for="date">Date Of Birth:</label>
        <div><input type="text" value="" name="date" id="date" class="date" placeholder="MM/DD/YYYY"/></div>
    </section>
    
    <section>
        <label for="password">Password:</label>
       <div><input type="password" id="password" name="password" class="confirm" value="<?php echo set_value('password', $password); ?>" required /></div>
   </section>
  
     
    <section>
        
        <input type="hidden" value="1" name="submit" id="submit">
        
        <input type="hidden" value="" name="facebook_login" id="facebook_login">
        <input type="hidden" value="" name="facebook_id" id="facebook_id">
        <input type="hidden" value="" name="facebook_token" id="facebook_token">
        <input type="hidden" value="" name="facebook_avatar" id="facebook_avatar">
        
        
        
        
       
        <button type="button" id="logout" class="fr" style="display:none;">logout</button>
         <button type="submit" class="fr" id="reg">Register</button>
    </section>


    <div style="text-align: center"><a href="/members/login" class="form-link">Have an account?</a></div>
    </fieldset>
</form> 

<script type="text/javascript" src="/js/uploader/fileuploader.js"></script>
<link rel="stylesheet" type="text/css" href="/js/uploader/fileuploader.css" />



<script type="text/javascript">

$(document).ready(function(){

     fba=new Object();


    var isUpload =  false;
  
    var temp= '<div class="qq-uploader">' +
                '<div id="upload_avatar" class="fr cbtn qq-upload-button"">Upload</div>' +
                '<div id="delete_avatar" class="fr cbtn" style="display:none;">'+
                'Replace</div>'+
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
        template: temp,
        multiple: false,
        debug: true,
        onComplete: function(id, fileName, responseJSON){
            $('#upload_avatar').fadeOut('100', function(){$('#delete_avatar').fadeIn(200);});
            $('#avatar').val(responseJSON.filename);
            
            $('#avatar_preview').html('<img src="/uploads/preload/'+responseJSON.filename+'" />').fadeIn(400);
            isUpload = true;
        }
    });
    
    
    


window.fbAsyncInit = function() {
   FB.init({appId:'<?php echo $fb['fb_appid'] ?>', status: true, cookie: true, xfbml: true});
//   FB.getLoginStatus(function(response) {
//	if (response) {
//            if(response.status == "connected"){
//              fbt = response.authResponse.accessToken;
              //fb_me();
//              $('#logout').show();
//            }
//	}
//    });
};


function fb_login(){
    FB.login(function(response) {
        if (response.authResponse) {
          fbt = response.authResponse.accessToken   
          fb_me();
            
        
    }}, {scope: 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown'});
}
function fb_me(){
     FB.api('/me', function(response) {
          fba = response;
          init();
     });
}

function fb_logout(){
    if(!isEmpty(fba)){
    FB.logout(function(response) {
       alert('Bye...');   
       $('#registerform')[0].reset()
       $('#logout').hide();
    });
    delete fba;fba = { };
    }
}

function init(){
                    
                    if(!isEmpty(fba)){
                        
                        $.ajax(
                        {
                            type: "POST",
                            data:
                                {
                                'facebook_id': fba.id
                                
                            },
                            dataType: 'json',
                            url: "/ajax/check_fb_user",
                            cache: false,
                            success: function(data)
                            {
                                if(data==false){
                                    alert("This facebook profile already in use");
                                    FB.logout(function(response) {});
                                    delete fba;fba = { };
                                }
                                else{
                                     $('#username').val(fba.username)
                                     $('#firstname').val(fba.first_name);
                                     $('#lastname').val(fba.last_name)
                                     $('#email').val(fba.email);
                                     $('#facebook_id').val(fba.id);
                                     $('#facebook_login').val(fba.email);
                                     $('#facebook_token').val(fbt);
                                     var  img = $('<img />').attr('src', 'https://graph.facebook.com/'+fba.id+'/picture?type=large');
                                     $('#avatar_preview').empty().append(img)
                                     $('#facebook_avatar').val('https://graph.facebook.com/'+fba.id+'/picture?type=large');
                                     
                                      
                                     var date = fba.birthday.split('/')

                                     $('#date').val(date[1]+'/'+date[0]+'/'+date[2]); 
                                     $('#logout').show();
                                }
                              
                                
                            }
                         }
                    );
                        
                        
                        
                    }
                }





(function() {
   var e = document.createElement('script');
   e.type = 'text/javascript';
   e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
   e.async = true;
   document.getElementById('fb-root').appendChild(e);
}());

$('#fb').bind('click', function(){
    
  if(!isEmpty(fba)){
       init();  
   }else{
       fb_login();
   }
});

$('#logout').bind('click', function(){
   fb_logout();
});

function isEmpty(obj) {
    
 return Object.keys(obj).length === 0;
};
});
</script>