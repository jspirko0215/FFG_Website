<?php echo form_open('/members/forgot', array('id' => 'forgotform')); ?>
<div id="forgot_title" style="text-align: center">
    <img src="/css/images/logo.png">
    <h4>Forgot password</h4>
</div>
<fieldset id="forgot_fieldset" style="margin-top:1px">
    <?php if ($errors):?>
        <div style="width: 100%; text-align: center; color: red; padding: 1em">
<?php echo $errors; ?>
    </div>
<?php endif; ?>

    <section>
        <label for="email">Email</label>
        <div><input type="email" class="email" value="<?php echo set_value('email', $email); ?>" name="email" id="email"  /></div>
    </section>

    <section>
           <button class="fr">Send</button>
           <input type="hidden" name="submit" value="1"/>
    </section>
    <div style="text-align: center">
        <a href="/members/login" title="sign in" style="">Sign in</a>
        <span> | </span>
        <a href="/members/registration" title="registrations" ">Create account</a>
    </div>
</fieldset>
<? echo form_close(); ?>

    
<script type="text/javascript">
  $(document).ready(function(){      
  

   
    
})
       
</script>