<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --- Facebook Ignited ---
 * 
 * fb_appid		is the app id you recieved from dev panel
 * fb_secret	is the secret you recieved from dev panel
 * fb_canvas 	the value you put in 'Canvas Page' field in dev panel or the address of your app.
 * fb_apptype	set to either 'iframe' or 'connect' based on what platform your app is
 * 				is running on.
 * fb_auth		is the default authentications, '' is basic authentication
 */
/*ffg*/
//$config['fb_appid']	= '159122310866407';
//$config['fb_secret']	= 'f0ec7239a628def24d3b91667193a61f';
//$config['fb_canvas']    = '';
/* test */
$config['fb_appid']	= '424395560926410';
$config['fb_secret']	= 'a59358ebc759b15ec33eac6530128ce9';
$config['fb_canvas']	= '';
//$config['fb_canvas']	= '';
//$config['fb_canvas']	= 'https://apps.facebook.com/fitforgreen/';
$config['fb_apptype']	= 'connect';
$config['fb_auth']	= 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown';


//$config['baseurl']    = "http://fitforgreen.dev/facebook/"; 
