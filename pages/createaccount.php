<?php

require_once("vendor/autoload.php");

$location = array(
	'GER' =>'Europe',
//	'USA' =>'North America'
);
$default = 'all';

$worlds = array();
$worlds[0] = array('GER', $config['server']['worldType']);
/*
$worlds[1] = array('GER', 'optional');
$worlds[2] = array('GER', 'hardcore');
$worlds[3] = array('USA', 'open');
$worlds[4] = array('USA', 'optional');
$worlds[5] = array('USA', 'hardcore');
*/

$town_array = $towns_list[0];
$town = $config['site']['newchar_towns'][0];
$voc = array(); // if empty, Rook Sample will be used
$voc[1] = 'Sorcerer';
$voc[2] = 'Druid';
$voc[3] = 'Paladin';
$voc[4] = 'Knight';

$suggestname = NULL; // not available
$version = '1010'; // for download link

foreach($worlds as $k =>$v) // remove invalid worlds
	if(!isset($location[$v[0]]) || !isset($config['site']['worlds'][$k]))
		unset($worlds[$k]);

$tmp = array();
foreach($location as $k =>$v) // remove invalid/unused locations
	foreach($worlds as $i =>$j)
		if($j[0] == $k) {
			$tmp[$k] = $v;
			break;
		}
$location = $tmp; unset($tmp);

if(isset($_POST['step']) && $_POST['step'] == 'docreate') {
	$e = array();
	
	// verifica se o captcha esta habilitado
	if ($config['site']['google_captcha_enabled']) {
		//captcha habilitado verifica se foi enviado na requisicao o input do captcha
		if (is_null($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
			$e['captcha'] = "Captcha Invalido! Tente novamente.";
		}
		
		//pega o token captcha enviado e verifica junto ao google se o token foi mesmo feito pelo dominio do site.
		/**$recaptcha = new ReCaptcha\ReCaptcha($config['site']['google_captcha_secret']);
		
		$verify = $recaptcha->setExpectedHostname($config['site']['google_captcha_host'])->verify($_POST['g-recaptcha-response']);
		
		if (!$verify->isSuccess()){
			$e['captcha'] = "Token Invalidado! Tente novamente.";
		}**/
		
		
	}
	
	$s = isset($_POST['accountname']) ? $_POST['accountname'] : '';
	if($s == '')
		$e['acc'] = 'Please enter an account name!';
	elseif(strlen($s) < 6)
		$e['acc'] = 'This account name is too short!';
	elseif(strlen($s) > 10)
		$e['acc'] = 'This account name is too long!';
	else {
		$s = strtoupper($s);

		if(!ctype_alnum($s))
			$e['acc'] = 'This account name has an invalid format. Your account name may only consist of numbers 0-9 and letters A-Z!';
		elseif(!preg_match('/[A-Z0-9]/', $s))
			$e['acc'] = 'Your account name must include at least one letter A-Z!';
		else {
			$acc = new Account($s, Account::LOADTYPE_NAME);
			if($acc->isLoaded())
				$e['acc'] = 'This name account is too long!!';
		}
	}

	if(!isset($_POST['world']) || empty($_POST['world']))
		$e['world'] = 'Please select a game world for your character!';

	$s = isset($_POST['email']) ? $_POST['email'] : '';

	if($s == '')
		$e['email'] = 'Please enter your email address!';
	elseif(strlen($s) > 49)
		$e['email'] = 'Your email address is too long!';
	elseif(!filter_var($s, FILTER_VALIDATE_EMAIL))
		$e['email'] = 'This email address has an invalid format. Please enter a correct email address!';
	else {
		$accMailCheck = new Account($s, Account::LOADTYPE_MAIL);
		if($accMailCheck->isLoaded())
			$e['email'] = 'This email address is already used. Please enter another email address!';
	}

	$s1 = isset($_POST['password1']) ? $_POST['password1'] : '';
	$s2 = isset($_POST['password2']) ? $_POST['password2'] : '';

	if(empty($s2))
		$e['pass'] = 'Please enter the password again!';
	elseif($s1 != $s2)
		$e['pass'] = 'The two passwords do not match!';
	else {
		$err = array();
		if(strlen($s1) < 6 || strlen($s1) > 29)
			$err[] = 'The password must have at least 8 and less than 30 letters!';
		if(!ctype_alnum($s1))
			$err[] = 'The password contains invalid letters!';

		if(count($err) != 0) {
			$e['pass'] = '';
			for($i=0; $i < count($err); $i++)
				$e['pass'] .= ($i == 0 ? '' : '<br/>').$err[$i];
		}
	}

	if(!isset($_POST['agreerules']) || empty($_POST['agreerules']))
		$e['rules'] = 'You have to agree to the Tibia Rules in order to create an account!';

	if(count($e) == 0) {
		$worldid = NULL;
		foreach($config['site']['worlds'] as $id =>$name)
			if($worlds[$id] && $name == $_POST['world']) {
				$worldid = $id;
				break;
			}
		if($worldid === FALSE)
			$e['world'] = 'Please select a valid game world.';
	}

	if(count($e) != 0) {
		$main_content = '<div class="SmallBox"><div class="MessageContainer"><div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif)"/></div><div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="ErrorMessage"><div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></div><div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></div><div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif)"/></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($e as $error) $main_content .= $error.'<br/>';
		$main_content .= '</div><div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif)"/></div><div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div></div></div><br/>';
	}
	else {

		$reg_account = new Account();
		$reg_account->setName($_POST['accountname']);
		$reg_account->setPassword($_POST['password1']);
		$reg_account->setEMail($_POST['email']);
		$reg_account->setGroupID(1);
		$reg_account->setCreateDate(time());
		$reg_account->setCreateIP(Visitor::getIP());
		$reg_account->setFlag(Website::getCountryCode(long2ip(Visitor::getIP())));
		if(isset($config['site']['newaccount_premdays']) && $config['site']['newaccount_premdays'] > 0)
		{
			$reg_account->set("premdays", $config['site']['newaccount_premdays']);
			$reg_account->set("lastday", time());
		}
		$reg_account->save();

		if($reg_account->getID() > 0) {
		}
		else die('Failed to create account.');
		$main_content = '<div class="SmallBox"><div class="MessageContainer"><div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif)"/></div><div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="Message"><div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></div><div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></div><table><tr><td class="LabelV">Note:</td><td style="width:100%"><p>Your account and character have been created successfully.</p></td></tr></table></div><div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif)"/></div><div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div><div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></div></div></div><div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif)"></div><div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></div><div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></div><br/><div class="TableContainer"><table class="Table4" cellpadding="0" cellspacing="0"><div class="CaptionContainer"><div class="CaptionInnerContainer"><span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></span><span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></span><span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span><span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></span><div class="Text">Download Client</div><span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"/></span><span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span><span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></span><span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"/></span></div></div><tr><td><div class="InnerTableContainer"><table style="width:100%"><tr><td><table width="100%" cellpadding=0 cellspacing=0><tr><td style="vertical-align:top"><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%"><tr><td><table style="width:100%;text-align:center"><tr><td><a href="'. $layout_name .'/downloads/tibia860.exe" type="application/octet-stream" target="_top"><img style="width:180px;height:180px;border:0px" src="account/download_windows.png"/></a></td><td><a href="'. $layout_name .'/downloads/OtLandIPChanger.exe" type="application/octet-stream" target="_top"><img style="width:140px;height:140px;border:0px" src="images/downloads/ipchanger.png"/><br/></a></td></tr><tr><td valign="top"><a href="'. $layout_name .'/downloads/tibia860.exe" type="application/octet-stream" target="_top">Windows Tibia Client 8.60</a></td><td valign="top"><a href="'. $layout_name .'/downloads/OtLandIPChanger.exe" type="application/octet-stream" target="_top">Otland IP Changer</a></td></tr><tr><td colspan="2">[<span class="HelpLink" onClick="window.open(\'http://www.tibia.com/support/content/help.php?subtopic=requirementes\', \'Help\', \'width=380px, height=310px, scrollbars=yes\')"><a>system requirements</a></span>]</td></tr></table></td></tr></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif)"></div></div></div></td><td style="vertical-align:top"><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%"><tr><td style="text-align:center"><img style="width:254px;height:218px;margin:7px" src="account/successful_download.jpg"/></td></tr></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif)"></div></div></div></td></tr></table><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%"><tr><td class="LabelV">Disclaimer</td></tr><tr><td>The software and any related documentation is provided "as is" without warranty of any kind. The entire risk arising out of use of the software remains with you. In no event shall CipSoft GmbH be liable for any damages to your computer or loss of data.</td></tr></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif)"></div></div></div></td></tr></table></div></table></div></td></tr>';
		return;
	}
} else $_POST['step'] = '';

$main_content .= '<script type="text/javascript" src="account/jquery.js"></script>
<script type="text/javascript" src="account/create_character.js"></script>
<script type="text/javascript">var PreselectServerLocation="'.$default.'";var g_FormName="CreateAccountAndCharacter";var g_FieldName="accountname";document.getElementById("ActiveSubmenuItemIcon_createaccount").style.visibility = "visible";';
foreach($worlds as $k =>$v) // create dynamic server list
	$main_content .= 'ServerList.push(new Array(\''.$config['site']['worlds'][$k].'\', \''.$v[0].'\', \''.$v[1].'\'));';
$main_content .= '</script><div style="position:relative;top:0px;left:0px"><form action="?subtopic=createaccount" method=post name="CreateAccountAndCharacter"><div class="TableContainer"><table class="Table5" cellpadding="0" cellspacing="0"><div class="CaptionContainer"><div class="CaptionInnerContainer"><span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span><span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span><span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span><span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span><div class="Text">Create New Account</div><span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span><span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span><span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span><span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span></div></div><tr><td><div class="InnerTableContainer"><table style="width:100%"><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%"><tr><td class="LabelV150" width="20%"><span id="accountname_label"'.(isset($e['acc']) ? ' class="red"' : '').'><b>Account Name:</b></span></td><td><input id="accountname" name="accountname" autocomplete="off" class="CipAjaxInput" style="width:206px;float:left" value="'.(isset($_POST['accountname']) ? htmlspecialchars(substr($_POST['accountname'], 0, 30)) : '').'" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'account/ajax_accountname.php\',PostData: \'a_AccountName=\'+this.value,Method: \'POST\'})"/><div id="accountname_indicator" class="InputIndicator" style="background-image:url(account/'.($_POST['step'] != 'docreate' || isset($e['acc']) ? 'n' : '').'ok.gif)"></div></td></tr><tr><td></td><td><span id="accountname_errormessage" class="FormFieldError">'.(isset($e['acc']) ? $e['acc'] : '').'</span></td></tr><tr><td class="LabelV150"><span id="email_label"'.(isset($e['email']) ? ' class="red"' : '').'><b>Email Address:</b></span></td><td><input id="email" name="email" class="CipAjaxInput" style="width:206px;float:left" value="'.(isset($_POST['email']) ? htmlspecialchars(substr($_POST['email'], 0, 50)) : '').'" autocomplete="off" size="30" maxlength="50" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'account/ajax_email.php\',PostData: \'a_EMail=\'+this.value,Method: \'POST\'})"/><div id="email_indicator" class="InputIndicator" style="background-image:url(account/'.($_POST['step'] != 'docreate' || isset($e['email']) ? 'n' : '').'ok.gif)"></div></td></tr><tr><td></td><td><span id="email_errormessage" class="FormFieldError">'.(isset($e['email']) ? $e['email'] : '').'</span></td></tr><tr><td class="LabelV150"><span id="password1_label"'.(isset($e['pass']) ? ' class="red"' : '').'><b>Password:</b></span></td><td><input id="password1" type="password" autocomplete="off" name="password1" style="width:206px;float:left" value="'.(isset($_POST['password1']) ? htmlspecialchars(substr($_POST['password1'], 0, 30)) : '').'" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'})"/><div id="password1_indicator" class="InputIndicator" style="background-image:url(account/'.($_POST['step'] != 'docreate' || isset($e['pass']) ? 'n' : '').'ok.gif)"></div></td></tr><tr><td class="LabelV150"><span id="password2_label"'.(isset($e['pass']) ? ' class="red"' : '').'><b>Password Again:</b></span></td><td><input id="password2" type="password" name="password2" style="width:206px;float:left" value="'.(isset($_POST['password2']) ? htmlspecialchars(substr($_POST['password2'], 0, 30)) : '').'" size="30" maxlength="30" onBlur="SendAjaxCip({DataType: \'Container\'}, {Href: \'account/ajax_password.php\',PostData: \'a_Password1=\'+getElementById(\'password1\').value+\'&a_Password2=\'+getElementById(\'password2\').value,Method: \'POST\'})"/><div id="password2_indicator" class="InputIndicator" style="background-image:url(account/'.($_POST['step'] != 'docreate' || isset($e['pass']) ? 'n' : '').'ok.gif)"></div></td></tr><tr><td></td><td><span id="password_errormessage" class="FormFieldError">'.(isset($e['pass']) ? $e['pass'] : '').'</span></td></tr></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableShadowContainerRightTop"><table class="TableContent" width="100%">';
$main_content .= '</table></div></div><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%">';
if(count($location)>1) { // show server location filter
	$main_content .= '<tr id="filterbox_location"><td class="LabelV150"><span'.(isset($e['world']) ? ' class="red"' : '').'>World Location:</span></td><td><table width="100%"><tr><td width="33%" valign="top"><script>CreateFilterOption(\'server_location\', \'all\', \'all\')</script>&nbsp;&nbsp;</td>';
	$i=0;
	foreach($location as $k =>$v) {
		$i++;
		$main_content .= '<td '.($i == count($location) ? '' : 'width="33%" ').'valign="top"><script>CreateFilterOption(\'server_location\', \''.$k.'\', \''.$v.'\')</script>&nbsp;&nbsp;</td>';
	}
	$main_content .= '</tr></table></td></tr>';
}
$main_content .= '<tr id="filterbox_pvp"><td class="LabelV150"><span'.(isset($e['world']) ? ' class="red"' : '').'><b>World Type:</b></span></td><td><div>';

$optional=true; $open=true; $hardcore=true;

foreach($worlds as $k =>$v) { // remove selection if there's no valid worlds
	if($optional && $v[1] == 'optional')
		unset($optional);
	elseif($open && $v[1] == 'open')
		unset($open);
	elseif($hardcore && $v[1] == 'hardcore')
		unset($hardcore);
	elseif(!$optional && !$open && !$hardcore)
		break;
}

$n = 0;
foreach(array($optional, $open, $hardcore) as $k)
	if(!$k)
		$n++;
$main_content .= '<table width="'.round(33.33 *  $n).'%"><tr>';
if(!$optional)
	$main_content .= '<td width="'.(100 / $n).'%" align="center" valign="top"><b><script>CreateFilterOption(\'server_pvp_type\', \'optional\', \'Optional PvP\')</script></b>&nbsp;&nbsp;Only if both sides agree, characters can be fought<br/><br/></td>';
if(!$open)
	$main_content .= '<td width="'.(100 / $n).'%" align="center" valign="top"><b><script>CreateFilterOption(\'server_pvp_type\', \'open\', \'Open PvP\')</script></b>&nbsp;&nbsp;Killing other characters is possible, but restricted<br/><br/></td>';
if(!$hardcore)
	$main_content .= '<td align="center" valign="top"><b><script>CreateFilterOption(\'server_pvp_type\', \'hardcore\', \'Hardcore PvP\')</script></b>&nbsp;&nbsp;Killing other characters is not restricted at all<br/><br/></td>';

$main_content .= '</tr></table></div></td></tr><tr><td class="LabelV150"><span'.(isset($e['world']) ? ' class="red"' : '').'><b>World Name:</b></span></td><td><div id="js_world_box" style="display:none"><table width="100%"><tr id="world_list_tr" style="text-align:left"></tr></table><span onClick="ToggleVisibility(\'js_world_box\', \'suggested_world_box\'); UpdateServerList(); "><small>[<a style="cursor:pointer">suggest game world</a>]</small></span></div><div id="suggested_world_box">Suggested world: <span id="suggested_world_div"></span><br/><span onClick="ToggleVisibility(\'suggested_world_box\', \'js_world_box\'); "><small>[<a style="cursor:pointer">change game world</a></span>]</small></div></td></tr><tr><td><table id="js_world_box" width="100%"><tr id="world_list_tr"></tr></table><table id="plain_world_box" width="100%"><tr><td>';
foreach($worlds as $k =>$v)
	$main_content .= '<input id="server_static_'.$config['site']['worlds'][$k].'" type="radio" name="world" value="'.$config['site']['worlds'][$k].'"'.($config['site']['worlds'][$k] == $_POST['world'] ? ' checked="checked"' : '').'><label for="server_static_'.$config['site']['worlds'][$k].'">'.$config['site']['worlds'][$k].'</label><br/>';
$main_content .= '</td></tr></table></td></tr>'.(isset($e['world']) ? '<tr><td></td><td><span class="FormFieldError">'.$e['world'].'</span></td></tr>' : '').'</table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif)"></div></div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"><div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif)"></div></div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif)"><div class="TableContentContainer"><table class="TableContent" width="100%"><tr><td><b>Please select all of the following check boxes:</b></td></tr><tr><td><input type="checkbox" name="agreerules" value="true"  onClick="if(this.checked == true) {  document.getElementById(\'agreerules_errormessage\').innerHTML = \'\';} else {  document.getElementById(\'agreerules_errormessage\').innerHTML = \'You have to agree to the Tibia Rules in order to create an account!\';}"'.($_POST['step'] == 'docreate' && !isset($e['rules']) ? ' checked="checked"' : '').'/>I agree to the <a href="?subtopic=legaldocuments&page=rules" target="_blank">Tibia Rules</a>.</td></tr>'.($config['site']['google_captcha_enabled'] ? '<div class="g-recaptcha" style="margin-left: 205px; margin-top: 10px; margin-bottom: 10px;" data-sitekey="'.$config['site']['google_captcha_key'].'"></div>': '').'<tr><td><span id="agreeprivacy_errormessage" class="FormFieldError">'.(isset($e['privacy']) ? $e['privacy'] : '').'</span></td></tr></table></div></div><div class="TableShadowContainer"><div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif)"><div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif)"></div><div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif)"></div></div></div></td></tr><script type="text/javascript">PreselectWorld="';  
if(isset($_POST['world']) && !empty($_POST['world']))
	foreach($config['site']['worlds'] as $id =>$name)
		if($worlds[$id] && $name == $_POST['world']) {
			$main_content .= $name;
			break;
		}
		

$main_content .= '";InitializeCharacterCreator(PreselectServerLocation, \''.(!$optional ? 'optional' : (!$open ? 'open' : 'hardcore')).'\')</script></table></div></table></div></td></tr><br/></div><center><table border="0" cellspacing="0" cellpadding="0"><tr><td style="border:0px"><input type="hidden" name=step value=docreate><input type="hidden" name=noframe value=""><div class="BigButton" style="margin-top:15px;background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onMouseOver="MouseOverBigButton(this)" onMouseOut="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td><tr></form></table></center><script type="text/javascript" language="javascript">document.forms[\'CreateAccountAndCharacter\'].elements[\'accountname\'].focus();</script><script type="text/javascript" src="account/generic.js"></script><script type="text/javascript" src="account/ajaxcip.js"></script>';