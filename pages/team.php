<?php
if(!defined('INITIALIZED'))
	exit;

$main_content .= '<style type="text/css">
.admin_icon {
	float: left;
	display: block;
	width:18px;
	height:18px;
	margin:0 4px 0 0;
	background: transparent url(/images/admin.gif) no-repeat;
}
.god_icon {
	float: left;
	display: block;
	width:18px;
	height:18px;
	margin:0 4px 0 0;
	background: transparent url(/images/god.gif) no-repeat;
}
.cm_icon {
	float: left;
	display: block;
	width:18px;
	height:18px;
	margin:0 4px 0 0;
	background: transparent url(/images/cm.gif) no-repeat;
}
.gm_icon {
	float: left;
	display: block;
	width:18px;
	height:18px;
	margin:0 4px 0 0;
	background: transparent url(/images/gm.gif) no-repeat;
}
.st_icon {
	float: left;
	display: block;
	width:16px;
	height:16px;
	margin:0 4px 0 0;
	background: transparent url(/images/st.gif) no-repeat;
}
.tu_icon {
	float: left;
	display: block;
	width:16px;
	height:16px;
	margin:0 4px 0 0;
	background: transparent url(/images/tu.gif) no-repeat;
}
</style>';

if($flagg != unknown)
{
	$flag = '<image src="/images/flags/'.$flagg.'.gif"/>';
}
else
{
	$flag = '<image src="images/flags/unknown.gif"/>';
}

$list2 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (2) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');
$list3 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (3) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');
$list4 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (4) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');
$list5 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (5) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');
$list6 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (6) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');
$list7 = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('online') . ', ' . $SQL->fieldName('group_id') . ', ' . $SQL->fieldName('lastlogin') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (7) ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');

$adm = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=7;')->fetch();
if($adm)
{
	$main_content .= '<center><h2>Administrador</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"20%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list7 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="admin_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#E71919" style="text-shadow: 1px 1px 12px #cf1616;"><b>Administrador</b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}

$god = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=6;')->fetch();
if($god)
{
	$main_content .= '<center><h2>GOD</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"20%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list6 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="god_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#ffa12c" style="text-shadow: 1px 1px 12px #000000;"><b>God</b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}

$cm = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=5;')->fetch();
if($cm)
{
	$main_content .= '<center><h2>Community Manager</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"22%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"24%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"24%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list5 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="cm_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#FFDD00" style="text-shadow: 1px 1px 12px #3c3c39;"><b><small>Community Manager</small></b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}

$gm = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=4;')->fetch();
if($gm)
{
	$main_content .= '<center><h2>Gamemaster</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"20%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list4 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="gm_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#001BCC" style="text-shadow: 1px 1px 12px #252E69;"><b>Gamemaster</b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}

$st = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=3;')->fetch();
if($st)
{
	$main_content .= '<center><h2>Senior Tutor</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"20%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list3 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="st_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#C000CC" style="text-shadow: 1px 1px 12px #600066;"><b>Senior Tutor</b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}

$tu = $SQL->query('SELECT `group_id` FROM `players` WHERE `group_id`=2;')->fetch();
if($tu)
{
	$main_content .= '<center><h2>Tutor</h2></center>';
	$main_content .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" style=\"border: 1px solid #505050;box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;\">
		<tr bgcolor=\"".$config['site']['vdarkborder']."\">
		<td width=\"20%\"><font class=\"white\"><b>Group</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Name</b></font></td>
		<td width=\"25%\"><font class=\"white\"><b>Language</b></font></td>
		<td width=\"20%\"><font class=\"white\"><b>Ultimo Acesso</b></font></td>
		<td width=\"10%\"><font class=\"white\"><b>Status</b></font></td>";
	foreach($list2 as $i => $supporter)
	{
		if($supporter['online'] == 0)
			$player_list_status = '<font color="red"><b>Offline</b></font>';
		else
			$player_list_status = '<font color="green"><b>Online</b></font>';
		$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
							<td><div class="tu_icon" style="background-position: 0px 0px;"></div> <span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#626369" style="text-shadow: 1px 1px 12px #59595C;"><b>Tutor</b></span></font></td>
							<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($supporter['name']).'">'.htmlspecialchars($supporter['name']).'</a></td>
							<td><small>English, Portuguese</small></td>';
							if(empty($supporter['lastlogin']))
							{
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Never Logged In</abbr></td>';
							}else if ($supporter['online'] == 1) {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">Logado</abbr></td>';
							} else {
								$main_content .= '<td><abbr style="font-size:10px;text-algin:center;" class="timeago" title="">'.date("j/n/Y, G:i:s", $supporter['lastlogin']).'</abbr></td>';
							}
							$main_content .= '<td>'.$player_list_status.'</td>
						  </tr>';
	}
	
	$main_content .= "</table><br>";
}
?>