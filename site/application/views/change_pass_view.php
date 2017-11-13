<?php echo form_open('/members/change_password', array('id' => 'changepasswordform')); ?>
<div id="change_password_title" style="text-align: center">
    <img src="/css/images/logo.png">
    <h4>Change password</h4>
</div>
<fieldset id="change_password_fieldset" style="margin-top:1px">
    <?php if ($errors):?>
        <div style="width: 100%; text-align: center; color: red; padding: 1em">
<?php echo $errors; ?>
    </div>
<?php endif; ?>

     <section>
        <label for="password">Password:</label>
       <div><input type="password" id="password" name="password" class="confirm" value="<?php echo set_value('password', $password); ?>" required /></div>
   </section>

    <section>
           <button class="fr">Change</button>
           <input type="hidden" name="submit" value="1"/>
           
    </section>
            <input id="forgot_code" type="hidden" name="forgot_code" value=""/>
    
    <div style="text-align: center">
        <a href="/members/login" title="sign in" style="">Sign in</a>
        <span> | </span>
        <a href="/members/registration" title="registrations" ">Create account</a>
    </div>
</fieldset>
<? echo form_close(); ?>

    
<script type="text/javascript">
  $(document).ready(function(){      
  
  $.urlParam = function(name){
  var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
  return results[1] || 0;
    }

      
   $('#forgot_code').val($.urlParam('forgot_code'));  

   
   
    
})
       
</script>
