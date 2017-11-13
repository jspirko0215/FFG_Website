  $(document).ready(function() {
      
    $("#join-label").hover(function(){
        $(this).stop().animate({
            "opacity": 0.6
        });
    },function(){
        $(this).stop().animate({
            "opacity": 1
        });
    });

    
    if ($.browser.msie && $.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.
    
      $(".fade").fadeTo(1, 1);
      $(".fade").hover(
        function () {
          $(this).fadeTo("fast", 0.6);
        },
        function () {
          $(this).fadeTo("slow", 1);
        }
    );  
	
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
    
    /* initialize prettyphoto */
    $("a[rel^='prettyPhoto']").prettyPhoto({
  		theme: 'light_rounded'
    });
    

	$(".toggle_title").toggle(
		function(){
			$(this).addClass('toggle_active');
			$(this).siblings('.toggle_content').slideDown("fast");
		},
		function(){
			$(this).removeClass('toggle_active');
			$(this).siblings('.toggle_content').slideUp("fast");
		}
	);
  
  $('#buttonsend').click( function() {
	
		var name    = $('#contactname').val();
		var subject = $('#contactsubject').val();
		var email   = $('#contactemail').val();
		var message = $('#contactmessage').val();
		
		$('.loading').fadeIn('fast');
		
		if (name != "" && subject != "" && email != "" && message != "")
			{

				$.ajax(
					{
						url: './sendemail.php',
						type: 'POST',
						data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message,
						success: function(result) 
						{
							$('.loading').fadeOut('fast');
							if(result == "email_error") {
								$('#contactemail').css("border","1px solid #FFB8B8").next('.require').text(' !');
							} else {
								$('#contactname, #contactsubject, #contactemail, #contactmessage').css("border","1px solid #eaeaea").val("");
								$('<div class="success-message">Your message has been sent successfully. Thank you! </div>').insertBefore('#maincontactform');
								$('.success-message').fadeOut(6000, function(){$(this).remove();});
							}
						}
					}
				);
				return false;
				
			} 
		else 
			{
				$('.loading').fadeOut('fast');
				if(name == "") $('#contactname').css("border","1px solid #FFB8B8").next('.require').text(' !');
				if(subject == "") $('#contactsubject').css("border","1px solid #FFB8B8").next('.require').text(' !');
				if(email == "" ) $('#contactemail').css("border","1px solid #FFB8B8").next('.require').text(' !');
				if(message == "") $('#contactmessage').css("border","1px solid #FFB8B8").next('.require').text(' !');
				return false;
			}
	});
	
	$('#contactname, #contactsubject, #contactemail,#contactmessage').focus(function(){
		$(this).css({"border":"1px solid #eaeaea"}).next('.require').text(' *');
	});
        
	});	
	
