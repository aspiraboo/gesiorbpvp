<?php
session_start();

if ($_REQUEST['type'] == "ttf") {
	$chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
	$max = strlen($chars) - 1;
	$newKey = null;

	for($i=0; $i < 5; $i++) {
		$cnum[$i] = $chars{mt_rand(0, $max)};
		$newKey .= $cnum[$i];
	}
	
	$_SESSION['captcha'] = $newKey;
	
	//specify the path where the font exists
	$dir = 'captcha/headline.ttf';
	#$image = imagecreatetruecolor(170, 60);
	$image = imagecreatefromjpeg('captcha/noxiousfundocaptcha.jpg');
	#$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 139, 119, 101); // red
	#$white = imagecolorallocate($image, 212, 192, 161);
	
	#imagefilledrectangle($image,0,0,145,50,$white);
	
	imagettftext ($image, 30, 0, 10, 40, $color, $dir, $_SESSION['captcha']);
	
	header("Content-type: image/png");
	imagepng($image);
}