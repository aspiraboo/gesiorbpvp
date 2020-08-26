<?php
if(isset($_POST['g-recaptcha-response']))
{
   $captcha=$_POST['g-recaptcha-response'];
}
if(!defined('INITIALIZED'))
	exit;

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'logout') {
	Visitor::logout();
}
 
$enable_captcha = $config['site']['google_captcha_enabled'];
/**$captcha = $_REQUEST['g-recaptcha-response'];

if($enabled && isset($_REQUEST['account_login']) && isset($_REQUEST['password_login']) && !$captcha || empty($captcha)) {
	$isTryingToLogin = true;
}**/

if ($enable_captcha) {
	if (isset($_REQUEST['account_login']) && isset($_REQUEST['password_login']) && !$captcha){
		//echo '<h2>Invalid Captcha.</h2>';
	} elseif(isset($_REQUEST['account_login']) && isset($_REQUEST['password_login']) && $captcha) {
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$config['site']['google_captcha_secret']}&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          //echo '<h2>Dirty Robot!</h2>';
        }
        else {
           Visitor::setAccount($_REQUEST['account_login']);
           Visitor::setPassword($_REQUEST['password_login']);
           //Visitor::login(); // this set account and password from code above as login and password to next login attempt
           //Visitor::loadAccount(); // this is required to force reload account and get status of user
           $isTryingToLogin = true;
        }
	}
} elseif(!$enable_captcha && isset($_REQUEST['account_login']) && isset($_REQUEST['password_login'])) {
		   Visitor::setAccount($_REQUEST['account_login']);
           Visitor::setPassword($_REQUEST['password_login']);
           //Visitor::login(); // this set account and password from code above as login and password to next login attempt
           //Visitor::loadAccount(); // this is required to force reload account and get status of user
           $isTryingToLogin = true;
}

Visitor::login();