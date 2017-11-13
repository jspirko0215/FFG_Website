<div class="maincontent-contact">
<div id="conctactleft">
<h4>
    <p>
        Please complete the fields below and we will respond to your inquiry within 48 hours.
    </p>
</h4>

    <?php if(isset($success)) { ?>
    <div class="success">
        Thanks for you message!
    </div>
   <?php } ?>
   <?php if(!empty($errors)) { ?> 
    <div class="error">
        <?php echo($errors); ?>
    </div>
   <?php } ?> 
    
    
    
<div id="maincontactform">
    <form action="/promo/contactus" id="contactform" method="post"> 
        <div>
            <label for="first_name">First name:</label>
            <input type="text" name="first_name" class="textfield" id="first_name" value="<?php echo set_value('first_name', $first_name);?>"  /><span class="require"> *</span>        
            
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" class="textfield" id="last_name" value="<?php echo set_value('last_name', $last_name); ?>"  /><span class="require"> *</span>

            <label for="email">Email:</label>
            <input type="text" name="email" class="textfield" id="email" value="<?php echo set_value('email', $email); ?>"  /><span class="require"> *</span>        

            <label for="street1">Address Street 1:</label>
            <input type="text" name="street1" class="textfield" id="street1" value="<?php echo set_value('street1', $street1); ?>"  />
            
            <label for="street2">Address Street 2:</label>
            <input type="text" name="street2" class="textfield" id="street2" value="<?php echo set_value('street2', $street2); ?>"  />
            
            <label for="city">City:</label>
            <input type="text" name="city" class="textfield" id="city" value="<?php echo set_value('city', $city); ?>"  />

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode" class="textfield" id="zipcode" value="<?php echo set_value('zipcode', $zipcode); ?>"  />
            
            <label for="state" style="float:left;margin-right: 15px; padding-top: 5px;">State:</label>
            <?php $state = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");?>
            <select name="state" id="state" style="width:110px;">
                <?php foreach($state as $st) { ?>
                    <option value="<?php echo $st; ?>"><?php echo $st; ?></options>
                <?php } ?>
            </select>
            
            <label for="phone1">Daytime Phone:</label>
            <input type="text" name="phone1" class="textfield" id="phone1" value="<?php echo set_value('phone1', $phone1); ?>"  />
            
            <label for="phone2">Evening Phone:</label>
            <input type="text" name="phone2" class="textfield" id="phone2" value="<?php echo set_value('phone2', $phone2); ?>"  />
                            
            <label for="phone2">Comments:</label>
            <textarea name="comments" class="textarea" id="comments" style="border: 1px solid rgb(234, 234, 234);"><?php echo set_value('comments', $comments); ?></textarea><span class="require"> *</span>
            <div style="width:160px; float:right;">
                <a id="buttonreset" class="button" href="#"><span>RESET</span></a>
                <a id="buttonsend"  class="button" href="#"><span>SEND</span></a>
            </div>
        </div>
    </form>
</div>
</div>    


<div id="contactright">
            <h4>Our Contact Detail!</h4>
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=28492+Casanal,+Mission+Viejo,+Orange,+California+92692&amp;ie=UTF8&amp;geocode=FdjhAAIdbxH9-A&amp;split=0&amp;sll=37.0625,-95.677068&amp;sspn=23.875,57.630033&amp;hq=&amp;ll=33.612248,-117.632657&amp;spn=0.027234,0.066047&amp;z=14&amp;output=embed"></iframe><br /><small></small>
            <ul class="contactinfo">
              <li>28492 Casanal<br>
                Mission Viejo, CA 92692
                (866)936-7831 
              </li>
              <li><strong>Email</strong> : <a href="mailto:info@fitforgreen">support@fitforgreen.com</a><br>
              <strong>Website</strong> : <a href="/">http://www.fitforgreen.com</a></li>
            </ul>      
            <div class="clear"></div>
          </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){

        $('#buttonreset').bind('click',function(){
            document.getElementById('contactform').reset();
        });

        $('#buttonsend').bind('click', function(){
            $('#contactform').submit();
        });

    });

</script>