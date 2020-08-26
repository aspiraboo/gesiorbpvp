<?php
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

include 'config/config.php';

$theQuery = "SELECT COUNT(*) as online FROM `players` WHERE `online` = 1";
$onlineCount;

if($theResult = mysqli_query($SQLlink, $theQuery)){	
	while($row = mysqli_fetch_array($theResult)){
		$onlineCount = $row['online'];
	}
}

die($onlineCount);