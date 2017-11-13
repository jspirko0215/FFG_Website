<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta name="title" content="" />
        <meta name="description" content="" />
        <title>Fir for Green</title>

        <!-- Stylesheets Start //-->
        <link rel="shortcut icon" href="/images/favicon.png"/>

		<!-- Javascript Start //-->
		<script type="text/javascript" src="/js/promo/jquery.js"></script>
		<script type="text/javascript" src="/js/promo/cufon.js"></script>
		<script type="text/javascript" src="/js/promo/fonts/ColaborateLight.js"></script>


		<script type="text/javascript">
			Cufon.replace('h1')('h2')('h3')('h4')('h5')('#myslidemenu a',{hover: 'true'})('#myslidemenu li li a',{textShadow: '1px 1px #ffffff',hover: 'true'})('a.button', {hover: 'true'})('.nivo-caption p');
		</script>

    </head>
    <body style="background: none">
        <div>
            <img src="/images/promo/stickers/1_43.png" style="width:100px; float:right"/>
			<h3>Please provide your details</h3>
			<div id="maincontactform">
			<form action="?" id="contactform" method="post"> 
				<div>
					<label for="first_name">Name:</label>
					<input type="text" name="name" class="textfield" id="name" value=""  /><span class="require"> *</span>        
						
					<label for="last_name">Address:</label>
					<input type="text" name="address" class="textfield" id="address" value=""  /><span class="require"> *</span>

					<div style="width:210px; ">
						<a id="buttonreset" class="button" href="#"><span>RESET</span></a>
						<a id="buttonsend"  class="button" href="#"><span>GET STATS</span></a>
					</div>
				</div>
			</form>
            </div>
        </div>
       <script type="text/javascript">

    $(document).ready(function(){

        $('#buttonreset').bind('click',function(){
            document.getElementById('contactform').reset();
        });

        $('#buttonsend').bind('click', function(){
			if(!$('#address').val()||!$('#name').val())
			{
				alert('Please provide us all required details');
				return false;
			}
            $('#contactform').submit();
        });

    });

</script>
    </body>
</html>