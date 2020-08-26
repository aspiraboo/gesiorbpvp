<?php
if(!defined('INITIALIZED'))
	exit;
$c=mysql_connect($config['site']['connection_host'],$config['site']['connection_user'],$config['site']['connection_pass'])or die(mysql_error());
$b=mysql_select_db($config['site']['connection_db'], $c)or die(mysql_error());
if($group_id_of_acc_logged >= $config['site']['access_admin_panel'])
{
	$main_content .= '
		<center>
				<table>
					<tbody>
						<tr>
							<td><img src="'.$layout_name.'/images/content/headline-bracer-left.gif"></td>
							<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Welcome to Admin Panel<br></td>
							<td><img src="'.$layout_name.'/images/content/headline-bracer-right.gif"></td>
						</tr>
					</tbody>
				</table>
			</center><br />';
		
		$NetworkFace = mysql_query("SELECT * FROM network WHERE network_name = 'facebook'");
		while($rface = mysql_fetch_array($NetworkFace)){
			$netFlink = $rface['network_link'];
		}
		$NetworkTwitter = mysql_query("SELECT * FROM network WHERE network_name = 'twitter'");
		while($rtwitter = mysql_fetch_array($NetworkTwitter)){
			$netTlink = $rtwitter['network_link'];
		}
	//POST LINK FACEBOOK
	if(isset($_POST['facebook_save'])){
		$fLink = $_POST['facebook_profile'];
		$sqlFace = mysql_query("UPDATE network SET network_link = '$fLink' WHERE network_name = 'facebook'");
		if($sqlFace){
			echo '<meta http-equiv="refresh" content="0;URL=?subtopic=adminpanel">';
			unset($_POST['facebook_save']);
		}
	}
	//POST LINK TWITTER
	if(isset($_POST['twitter_save'])){
		$tLink = $_POST['twitter_profile'];
		$sqlTwit = mysql_query("UPDATE network SET network_link = '$tLink' WHERE network_name = 'twitter'");
		if($sqlTwit){
			echo '<meta http-equiv="refresh" content="0;URL=?subtopic=adminpanel">';
			unset($_POST['twitter_save']);
		}
	}
	$main_content .= '
		<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%>
			<TR>
				<TD>Welcome to your new admin panel, here you will find some things you need to manage your server as well, enjoy!.<BR>
					<BR>
					Select an option from the menu below to start.<BR>
					<BR>
					<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
						<TR BGCOLOR=#505050>
							<TD CLASS=white COLSPAN=3><B>Network Box Links</B></TD>
						</TR>
						<TR BGCOLOR=#D4C0A1>
							<TD><B>Facebook Page</B></TD>
							<form name="facebook" action="" method="post">
								<td>https://www.facebook.com/<input type="text" name="facebook_profile" value="'.$netFlink.'"></td>
								<td><button type="submit" name="facebook_save">Save</button></td>
							</form>
						</TR>
						<TR BGCOLOR=#F1E0C6>
							<td><B>Twitter Profile</B></td>
							<form name="twitter" action="#" method="post">
								<td>https://twitter.com/<input type="text" name="twitter_profile" value="'.$netTlink.'"></td>
								<td><button type="submit" name="twitter_save">Save</button></td>
							</form>
						</TR>
					</TABLE>
					<BR>
				</TD>
			</TR>
		</TABLE>';	
}
else
{
	$main_content .= 'You don\'t have admin access.';
}