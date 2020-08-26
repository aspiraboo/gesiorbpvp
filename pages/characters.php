<?PHP
$main_content .='
<style type="text/css">
/*System created by Leandro*/
a.equipment{border:none;cursor:help}
a.equipment img{border:none}
a.equipment span{visibility:hidden;display:none}
a.equipment:hover{position:relative;text-decoration:none}
a:hover.equipment span{border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;box-shadow:3px 3px 3px rgba(0,0,0,.4);
-webkit-box-shadow:3px 3px rgba(0,0,0,.4);
-moz-box-shadow:3px 3px rgba(0,0,0,.4);
font-family:Verdana,sans-serif;position:absolute;left:.25em;top:1.25em;z-index:99;background:#333;border:2px solid #111;font-weight:400;text-align:center;text-decoration:none;padding:.1em;width:175px;display:block;opacity:.95;filter:alpha(opacity=95);z-index:150}
#equipment .EquipTitleNormal{font-size:12px;color:#1eff00}
#equipment .EquipTitleMagical{font-size:12px;color:#0070dd}
#equipment .EquipTitleDonation{font-size:12px;font-weight:700;color:red}
#equipment .EquipText{font-size:10px;color:#fff}
.CharAttrHeader{font-size:10px;font-weight:700;text-align:right;padding-right:5px;background:#d4c0a1}
.CharAttrText{font-size:9px;text-align:left;background:#f1e0c6}
.ItemSlotStroke{color:#fff;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;position:absolute;padding-top:18px;z-index:150}
#equipment a:hover span,#equipment a:active span,#equipment a:focus span{visibility:visible}#equipment a:hover,#equipment a:focus{visibility:visible}
</style>';
date_default_timezone_set('America/Araguaina');
$name = stripslashes(ucwords(strtolower(trim($_REQUEST['name']))));
if(empty($name))
		$main_content .= 'Aqui você pode obter informações detalhadas sobre um certo jogador em '.$config['server']['serverName'].'.<br><br>  <FORM ACTION="?subtopic=characters" METHOD=post>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Search Character</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['darkborder'].'">
		<TABLE BORDER=0 CELLPADDING=1>
			<TR>
				<TD>Name:</TD>
				<TD><input name="name" maxlength="30" type="text" class="custom-field" value="" /></TD>
				<TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD>
			</TR>
		</TABLE></TD></TR></TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div></FORM>';
else
{
	if(check_name($name)) 
	{
		$player = new Player();
		$player->find($name);
		if($player->isLoaded()) 
		{
			$account = $player->getAccount();
			$account_db = new Account();
			if(!empty($flagg))
			{
				$flag = '<image src="/images/flags/'.$flagg.'.gif"/>';
			}
			else
			{
				$flag = '<image src="images/flags/unknown.gif"/>';
			}
			$main_content .= '
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Character Information</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
			<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD></TD><TD><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=20% style="border:1px solid #faf0d7;">Name:</TD><TD style="border:1px solid #faf0d7;">';
				$main_content .= ''.$player->getName().'';
				$main_content .= ($player->isOnline()) ? ' <img src="/layouts/tibiarl/images/online.gif">' : ' <img src="/layouts/tibiarl/images/offline.gif">';
				$main_content .= ($account->getVipTime()) ? '&nbsp;<img src="/images/vip/vip.png">' : '';
			
				if($player->isDeleted())
					$main_content .= '<font color="red"> [DELETED]</font>';
				if($player->isNameLocked())
					$main_content .= '<font color="red"> [NAMELOCK]</font>';
				
				$main_content .= '<div class="posonoff">'.$flag.'</div>';
				$main_content .= '<style type="text/css">
					.outfitchradcters {
						position: absolute;
						width: 64px;
						height: 64px;
						background-repeat: no-repeat;
						right: 22px;
						bottom: 0px;
						top: -10px;
					}
					.outfitchradcters2 {
						position: absolute;
						width: 64px;
						height: 64px;
						background-repeat: no-repeat;
						right: -9px;
						bottom: 0px;
						top: 22px;
					}
					.pedestalcharacters  {
						background-image: url(images/pedestal.gif);
						position: absolute;
						width: 47px;
						height: 48px;
						background-repeat: no-repeat;
						right: 4px;
						bottom: 0px;
						top: 27px;
					}
					.guildcircle  {
						border-radius: 100%;
						position: absolute;
						width: 56px;
						height: 56px;
						background-repeat: no-repeat;
						right: 6px;
						bottom: 0px;
						top: 80px;
						background-position: center;
						box-shadow: 3px 3px 3px rgba(50, 50, 50, 0.70);
					}
				</style>';
				$checklooktype = $player->getCustomField("looktype");
				if ($checklooktype == 194 or $checklooktype == 302 or $checklooktype == 266 or $checklooktype == 75) {
					$main_content .= '<div class="pedestalcharacters"></div><div class="outfitchradcters2" style="background-image: url(/outfit.php?id='.$player->getCustomField("looktype").'&addons='.$player->getCustomField("lookaddons").'&head='.$player->getCustomField("lookhead").'&body='.$player->getCustomField("lookbody").'&legs='.$player->getCustomField("looklegs").'&feet='.$player->getCustomField("lookfeet").');"></div>';
				} else {
					$main_content .= '<div class="pedestalcharacters"></div><div class="outfitchradcters" style="background-image: url(/outfit.php?id='.$player->getCustomField("looktype").'&addons='.$player->getCustomField("lookaddons").'&head='.$player->getCustomField("lookhead").'&body='.$player->getCustomField("lookbody").'&legs='.$player->getCustomField("looklegs").'&feet='.$player->getCustomField("lookfeet").');"></div>';
				}
				$rank_of_player = $player->getRank();
				if(!empty($rank_of_player))
				{
					{
					$guild_id = $rank_of_player->getGuild()->getId();
					$guild_logo = $rank_of_player->getGuild()->getGuildLogoLink();
					$main_content .= '<a href="?subtopic=guilds&action=show&guild='.$guild_id.'"><img class="guildcircle" src="'. $guild_logo.'"></a>';
					}
				}
			/*
			if($player->getOldName())
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					if($player->isNameLocked())
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Proposition:</TD><TD style="border:1px solid #faf0d7;">'.$player->getOldName().'</TD></TR>';
					else
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Old name:</TD><TD style="border:1px solid #faf0d7;">'.$player->getOldName().'</TD></TR>';
			}
			*/
			
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Sex:</TD><TD style="border:1px solid #faf0d7;">';
				$main_content .= ($player->getSex() == 0) ? 'female' : 'male';
				$main_content .= '</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++; 
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Profession:</TD><TD style="border:1px solid #faf0d7;">' . htmlspecialchars(Website::getVocationName($player->getVocation(), $player->getPromotion())) . '</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Level: </TD><TD style="border:1px solid #faf0d7;">'.$player->getLevel().'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;			
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Dodge: </TD>
				<TD style="border:1px solid #faf0d7;">'.($player->getDodge() <= 0 ? "0" : $player->getDodge() ).' used</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;			
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Critical:</TD>
				<TD style="border:1px solid #faf0d7;">'.($player->getCritical() <= 0 ? "0" : $player->getCritical() ).' used</TD></TR>';
			if(!empty($towns_list[$player->getWorld()][$player->getTownId()]))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Residence:</TD><TD style="border:1px solid #faf0d7;">'.$towns_list[$player->getWorld()][$player->getTownId()].'</TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Marital status:</TD><TD style="border:1px solid #faf0d7;">';
				$marriage = new Player();
				$marriage->load($player->getMarriage());
				if($marriage->isLoaded())
					$main_content .= 'married to <a href="?subtopic=characters&name='.urlencode($marriage->getName()).'"><b>'.$marriage->getName().'</b></a></TD></TR>';
				else
					$main_content .= 'single</TD></TR>';
			$house = $SQL->query( 'SELECT `houses`.`name`, `houses`.`town`, `houses`.`lastwarning` FROM `houses` WHERE `houses`.`world_id` = '.$player->getWorld().' AND `houses`.`owner` = '.$player->getId().';' )->fetchAll();
			if ( count( $house ) != 0 )
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">House:</TD><TD colspan="2" style="border:1px solid #faf0d7;">';
					$main_content .= $house[0]['name'].' ('.$towns_list[$player->getWorld()][$house[0]['town']].') is paid until '.date("j M Y G:i", $house[0]['lastwarning']).'</TD></TR>';
			}
			$rank_of_player = $player->getRank();
			if(!empty($rank_of_player))
			{
				{
					$guild_id = $rank_of_player->getGuild()->getId();
					$guild_name = $rank_of_player->getGuild()->getName();
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Guild Membership:</TD><TD style="border:1px solid #faf0d7;">'.$rank_of_player->getName().' of the <a href="?subtopic=guilds&action=show&guild='.$guild_id.'">'.$guild_name.'</a></TD></TR>';
				}
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$lastlogin = $player->getLastLogin();
				if(empty($lastlogin))
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Last login:</TD><TD colspan="2" style="border:1px solid #faf0d7;">Never logged in.</TD></TR>';
				else
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Last login:</TD><TD colspan="2" style="border:1px solid #faf0d7;">'.date("j F Y, g:i a", $lastlogin).'</TD></TR>';
			
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Balance:</TD><TD><font color="#00CD00"><b>$</b></font> '.number_format($player->getBalance()).' Gold Coins.</TD></TR>';
			
			$comment = $player->getCustomField("comment");
			$newlines   = array("\r\n", "\n", "\r");
			$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
			if($count < 50)
				$comment = $comment_with_lines;
			if(!empty($comment))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD VALIGN=top style="border:1px solid #faf0d7;">Comment:</TD><TD style="border:1px solid #faf0d7;">'.$comment.'</TD></TR>';
			}

			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			// Equip
			
			$get_hide_equips = $SQL->query("SELECT hide_equips FROM `players` WHERE `id` = ".$SQL->quote($player->getID())."")->fetch();
			$get_hide_admin = $SQL->query("SELECT hide_admin FROM `players` WHERE `id` = ".$SQL->quote($player->getID())."")->fetch();

			$number_of_items = 1;
			$items = simplexml_load_file($config['site']['serverPath'].'/data/items/items.xml') or die('<b>Could not load items!</b>');
			$itemcont = 0;
            foreach($items->item as $v)
            $itemList[(int)$v['id']] = ucwords(strtolower($v['name']));
				
				
                $itensname = $config['site']['itensname'];				
				$list = array('2','1','3','6','4','5','9','7','10','8'); 
				$contentEquipment .='
				<style type="text/css">
					/* CSS by Leandro */
					.signBgrnd {
						background-image: url(images/equipment/outfit.png);
						background-repeat: no-repeat;
						position: relative;
						float: left;
						left: 9px;
						top: -37px;
						margin-top: 38px;
						padding: 15px;
						height: 232px;
						width: 176px;
						box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.42),0 6px 20px 0 rgba(0, 0, 0, 0.3) !important;
						margin-bottom: -22px;
					}
					/* Weapon */
					.signBgrnd .wep {
						position: absolute;
						top: 90px;
						left: 11px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .wep img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* Armor */
					.signBgrnd .arm {
						position: absolute;
						top: 76px;
						left: 48px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .arm img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* Helmet */
					.signBgrnd .helm {
						position: absolute;
						top: 39px;
						left: 48px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .helm img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* legs */
					.signBgrnd .legs {
						position: absolute;
						top: 113px;
						left: 48px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .legs img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* boots */
					.signBgrnd .boots {
						position: absolute;
						top: 150px;
						left: 48px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .boots img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* ring */
					.signBgrnd .ring {
						position: absolute;
						top: 127px;
						left: 11px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .ring img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* amulet */
					.signBgrnd .amulet {
						position: absolute;
						top: 53px;
						left: 11px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .amulet img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* backpack */
					.signBgrnd .backpack {
						position: absolute;
						top: 53px;
						left: 85px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .backpack img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* shield */
					.signBgrnd .shield {
						position: absolute;
						top: 90px;
						left: 85px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .shield img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					/* arrow */
					.signBgrnd .arrow {
						position: absolute;
						top: 127px;
						left: 85px;
						width: 32px;
						height: 32px;
					}
					.signBgrnd .arrow img {
						background-image:url(\'images/items/blank.gif\');
						max-width: 100%;
					}
					.signBgrnd .cap {
					position: absolute;
					top: 162px;
					left: 89px;
					width: 32px;
					height: 32px;
					font-size: 6.3pt;
					font-family: inherit;
					text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);
					font-weight: normal;
					color: rgba(255, 255, 255, 0.61);
					font-weight: bold;
					}
					.signBgrnd .soul {
					position: absolute;
					top: 162px;
					left: 15px;
					width: 32px;
					height: 32px;
					font-size: 6.3pt;
					font-family: inherit;
					text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);
					color: rgba(255, 255, 255, 0.61);
					font-weight: bold;
				}
			</style>';
				if ($get_hide_equips['hide_equips'] == 0 and $get_hide_admin['hide_admin'] == 0 || $group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
				$contentEquipment .= '<div id="equipment" class="signBgrnd">';
			
				foreach ($list as $pid => $name) 
				{ 
					$top = $SQL->query('SELECT * FROM player_items WHERE player_id = '.$player->getId().' AND pid = '.$list[$pid].' AND itemtype;')->fetch(); 
					if($top[itemtype] == true) 
					{ 
						if($list[$pid] == '1') 
						{ 
							$contentEquipment .= '<div class="helm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						} 
						elseif($list[$pid] == '2') 
						{ 
							$contentEquipment .= '<div class="amulet"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '3') 
						{ 
							$contentEquipment .= '<div class="backpack"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '4') 
						{ 
							$contentEquipment .= '<div class="arm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '5') 
						{ 
							$contentEquipment .= '<div class="shield"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '6') 
						{ 
							$contentEquipment .= '<div class="wep"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '7') 
						{ 
							$contentEquipment .= '<div class="legs"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '8') 
						{ 
							$contentEquipment .= '<div class="boots"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '9') 
						{ 
							$contentEquipment .= '<div class="ring"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
						elseif($list[$pid] == '10') 
						{ 
							$contentEquipment .= '<div class="arrow"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/items/'.$top[itemtype].'.gif"/><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a></div>';  
						}
															
						$contentEquipment .= '<div class="cap"><a class="equipment" style=" color: rgb(199, 197, 193)";>Cap:<br>'.$player->getcap().'<span><font class="EquipTitleDonation">Cap:</font><br>	<font class="EquipText">'.$player->getcap().'</font></span></a></div>';
						$contentEquipment .= '<div class="soul"><a class="equipment" style=" color: rgb(199, 197, 193)";>Soul:<br>'.$player->getsoul().'<span><font class="EquipTitleDonation">Soul:</font><br>	<font class="EquipText">'.$player->getsoul().'</font></span></a></div>';
					
					}
					elseif($top[itemtype] == false) 
					{ 
						if($list[$pid] == '1') 
						{ 
							$contentEquipment .= '<div class="helm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/1.png"/></a></div>';
						} 
						elseif($list[$pid] == '2') 
						{ 
							$contentEquipment .= '<div class="amulet"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/2.png"/></a></div>'; 
						}
						elseif($list[$pid] == '3') 
						{ 
							$contentEquipment .= '<div class="backpack"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/3.png"/></a></div>';
						}
						elseif($list[$pid] == '4') 
						{ 
							$contentEquipment .= '<div class="arm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/4.png"/></a></div>';
						}
						elseif($list[$pid] == '5') 
						{ 
							$contentEquipment .= '<div class="shield"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/5.png"/></a></div>';
						}
						elseif($list[$pid] == '6') 
						{ 
							$contentEquipment .= '<div class="wep"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/6.png"/></a></div>';
						}
						elseif($list[$pid] == '7') 
						{ 
							$contentEquipment .= '<div class="legs"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/7.png"/></a></div>';
						}
						elseif($list[$pid] == '8') 
						{ 
							$contentEquipment .= '<div class="boots"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/8.png"/></a></div>';
						}
						elseif($list[$pid] == '9') 
						{ 
							$contentEquipment .= '<div class="ring"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/9.png"/></a></div>';
						}
						elseif($list[$pid] == '10') 
						{ 
							$contentEquipment .= '<div class="arrow"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
		                <img src="images/equipment/10.png"/></a></div>';
						}
															
						$contentEquipment .= '<div class="cap"><a class="equipment" style=" color: rgb(199, 197, 193)";>Cap:<br>'.$player->getcap().'<span><font class="EquipTitleDonation">Cap:</font><br>	<font class="EquipText">'.$player->getcap().'</font></span></a></div>';
						$contentEquipment .= '<div class="soul"><a class="equipment" style=" color: rgb(199, 197, 193)";>Soul:<br>'.$player->getsoul().'<span><font class="EquipTitleDonation">Soul:</font><br>	<font class="EquipText">'.$player->getsoul().'</font></span></a></div>';
					
					}
				}
				$hp = ($player->getHealth() / $player->getHealthMax() * 100);
				$mana = ($player->getMana() / $player->getManaMax() * 100);
				$contentEquipment .= '</div>';
			}
				
				
				$contentEquipment .= '
				<style>
				/* CSS by Leandro */
				.manapercent {
					width: '.$mana.'%;
					max-width: 100%;
					margin-left: 36.2px;
					height: 5px;
					position: absolute;
					margin-top: 20px;
				}
				.lifebarpercent {
					width: '.$hp.'%;
					max-width: 100%;
					margin-left: 36.2px;
					height: 5px;
					position: absolute;
					margin-top: 7px;
				}
				.hptext {
    position: absolute;
    font-size: 8pt;
    margin-left: 106px;
    margin-top: -1px;
    font-weight: 700;
    color: #b5b5b5;
}.manatext {
    position: absolute;
    font-size: 8pt;
    margin-left: 107px;
    margin-top: -1px;
    font-weight: 700;
    color: #b5b5b5;
}.lifebarbk{background:url(images/equipment/lifebarra.png);height:12px;border-radius:10px;max-width:13.5%}.manabk{background:url(images/equipment/manabar.png);height:12px;border-radius:10px;max-width:13.5%}.SkillsBgrnd {
    background-image: url(images/equipment/skillsbackground.png);
    background-repeat: no-repeat;
    position: relative;
    float: left;
    left: 18px;
    top: -37px;
    margin-top: 38px;
    margin-bottom: -23px;
    padding: 15px;
    height: 232px;
    width: 184px;
    box-shadow: 0 10px 16px 0 rgba(0,0,0,0.42),0 6px 20px 0 rgba(0,0,0,0.3)!important;
}.SkillsBgrnd .exp{position:absolute;font-size:7pt;font-weight:700;color:#b5b5b5;margin:0 auto;width:145px;text-align:right}.SkillsBgrnd .level{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:13px;margin-bottom:1px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .hitpoints{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:28px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .mana{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:42px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .soul{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:56px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .cap{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:70px;margin-bottom:1px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .stamina{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:84px;margin-bottom:3px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .magiclevel{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:98px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Fist{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:116px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Club{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:130px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Sword{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:145px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Axe{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:159px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Distance{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:172px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Shield{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:186px;font-size:7pt;font-weight:700;color:#b5b5b5}.SkillsBgrnd .Fishing{position:absolute;margin:0 auto;width:145px;text-align:right;margin-top:200px;font-size:7pt;font-weight:700;color:#b5b5b5}.OutfitBgrnd {
    background-image: url(images/equipment/outfitbackgrounds.png);
    background-repeat: no-repeat;
    position: relative;
    float: left;
    left: 27px;
    top: -37px;
    margin-top: 38px;
    margin-bottom: -25px;
    padding: 15px 0;
    height: 232px;
    width: 178px;
    box-shadow: 0 10px 16px 0 rgba(0,0,0,0.42),0 6px 20px 0 rgba(0,0,0,0.3)!important;
}.OutfitBgrnd img{margin-left:-27px;margin-top:-32px}.OutfitBgrnd .grayimg{filter:none;-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%);opacity:.5;filter:alpha(opacity=50);margin-left:-25pt;margin-top:-25px}.OutfitBgrnd .OutfitPlayer{margin:0;height:64px;width:64px}.OutfitBgrnd .OutfitName{position:absolute;margin:0 auto;width:145px;height:10px;text-align:center;top:203px;font-size:8pt;font-weight:700;color:#b5b5b5}
				</style>
				
				<div class="lifebarpercent"><span class="hptext">'.$player->getHealth().'</span>
				<div class="lifebarbk"></div></div></div>
				<div class="manapercent"><span class="manatext">'.$player->getMana().'</span>
				<div class="manabk"></div></div></div>';
			
			//Skills By Leandro
			
			//Stamina by leandro
				function getStamina($value){
				$h = floor($value / 3600000);
				$m = floor(($value - $h * 3600000) / 60000);
				if($m == '0') {
					$m = '00';
				}
				$zero = array (1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9);
				if ($m ==  $zero[$m]) {
					$m = '0'.$m;
				}
				return $h.':'.$m;
				}

				$stamina = ($player->getStamina() / 151200000 *42);
				if ((gmdate("s", $stamina)) >= (gmdate("s", "40")))
				$sorange = '<font color="#00ff00">';
				if ((gmdate("s", $stamina)) <= (gmdate("s", "40")))
				$sorange = '<font color="orange">';
				if ((gmdate("s", $stamina)) <= (gmdate("s", "14")))
				$sorange = '<font color="red" style="text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);">';
			
				$contentEquipment .= '	
				<table>
					<div id="equipment" class="SkillsBgrnd">
					<div class="exp"><font color="YELLOW" style="text-shadow: 1px 1px #580208;"><b>'.number_format($player->getExperience()).'</b></font></div>
					<div class="level">'.$player->getLevel().'</div>
					<div class="hitpoints"><font color="#FF0000" style="text-shadow: 1px 1px #580208;"><b>'.number_format($player->getHealth()).'</b></font></div>
					<div class="mana"><font color="#198CFF" style="text-shadow: 1px 1px #580208;"><b>'.number_format($player->getMana()).'</b></font></div>
					<div class="soul">'.$player->getsoul().'</div>
					<div class="cap">'.number_format($player->getcap()).'</div>
					<div class="stamina">'.$sorange.''.getStamina($player->getStamina()).'</font></div>
					<div class="magiclevel">'.$player->getMagLevel().'</div>
					<div class="Fist">'.$player->getSkill(0).'</div>
					<div class="Club">'.$player->getSkill(1).'</div>
					<div class="Sword">'.$player->getSkill(2).'</div>
					<div class="Axe">'.$player->getSkill(3).'</div>
					<div class="Distance">'.$player->getSkill(4).'</div>
					<div class="Shield">'.$player->getSkill(5).'</div>
					<div class="Fishing">'.$player->getSkill(6).'</div>		
					</div>
				</table>';	
				
				//Outfits By Leandro												
				$outfitnames = array(128 => 'Citizen',129 => 'Hunter', 130 => 'Mage', 131 => 'Knight', 132 => 'Nobleman', 133=> 'Summoner', 134=> 'Warrior', 136=> 'Citizen', 137=> 'Hunter', 138=> 'Mage', 139=> 'Knight', 140=> 'Noblewomen', 141=> 'Summoner', 142=> 'Warrior', 143=> 'Barbarian', 144=> 'Druid', 145=> 'Wizard', 146=> 'Oriental', 147=> 'Barbarian', 148=> 'Druid', 149=> 'Wizard', 150=> 'Oriental', 151=> 'Pirate', 152=> 'Assassin', 153=> 'Beggar', 154=> 'Shaman', 155=> 'Pirate', 156=> 'Assassin', 157=> 'Beggar', 158=> 'Shaman', 194=> 'Supreme', 251=> 'Norseman', 252=> 'Norseman', 254=> 'Supreme', 264=> 'Supreme', 266=> 'GameMaster', 268=> 'Nightmare', 269=> 'Nightmare', 270=> 'Jester', 273=> 'Jester', 278=> 'Brotherhood', 279=> 'Brotherhood', 288=> 'Demonhunter', 289=> 'Demonhunter', 302=> 'God', 324=> 'Yalaharin', 324=> 'Yalaharian', 325=> 'Yalaharian', 335=> 'Warmaster', 366=> 'Warmaster', 367=> 'Wayfarer');
				
				
				$outfitsfemale = array(
					65539 => 136, //citizen
					131075 => 137, //hunter
					196611 => 141, //mage
					262147 => 139, //knight
					327683 => 140, //nobleman
					393219 => 138, //summoner
					458755 => 142, //warrior
					524291 => 147, //barbarian
					589827 => 148, //druid
					655363 => 149, //wizard
					720899 => 150, //oriental
					786435 => 155, //pirate
					851971 => 156, //assassin
					917507 => 157, //beggar
					983043 => 158, //shaman
					1048579 => 252, //norseman
					1114115 => 269, //nightmare
					1179651 => 270, //jester
					1245187 => 279, //brotherhood
					1310723 => 288, //demonhunter
					1376259 => 324, //yalaharian
					1441795 => 336, //warmaster
					1507331 => 366 //wayfarer											
				); // storages
				
				$outfitsmale = array(
					65539 => 128, //citizen
					131075 => 129, //hunter
					196611 => 130, //mage
					262147 => 131, //knight
					327683 => 132, //nobleman
					393219 => 133, //summoner
					458755 => 134, //warrior
					524291 => 143, //barbarian
					589827 => 144, //druid
					655363 => 145, //wizard
					720899 => 146, //oriental
					786435 => 151, //pirate
					851971 => 152, //assassin
					917507 => 153, //beggar
					983043 => 154, //shaman
					1048579 => 251, //norseman
					1114115 => 268, //nightmare
					1179651 => 273, //jester
					1245187 => 278, //brotherhood
					1310723 => 289, //demonhunter
					1376259 => 325, //yalaharian
					1441795 => 335, //warmaster
					1507331 => 367 //wayfarer										
				); // storages	
				
				if ($player->getSex() == 1) $outfitskeys = $outfitsmale;
				else $outfitskeys = $outfitsfemale;
				
					$contentEquipment .= '	
				<table>
					<div id="equipment" class="OutfitBgrnd">';
					
						$contentEquipment .= '
						<div style="text-align: center;margin-top: 11px;">';
							foreach ($outfitskeys as $outfits => $id) 
							{
								$outfitquery = $SQL->query("SELECT * FROM `player_storage` WHERE `player_id` = '" . $player->getId() . "' AND `player_storage`.`value` = " .$outfits . ";")->fetch();
								
								if ($outfitquery == true )
								{	
									$contentEquipment .= '<img src="' . $config['site']['outfit_images_url'] . '?id='.$id.'&addons=3&head='.$player->getCustomField("lookhead").'&body='.$player->getCustomField("lookbody").'&legs='.$player->getCustomField("looklegs").'&feet='.$player->getCustomField("lookfeet").'">';
								} else {
									$contentEquipment .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id='.$id.'&addons=3&head=0&body=0&legs=0&feet=0">';
								}
								
							}
							$contentEquipment .= '	
						</div>
					</div>
				</table>';
				
				$main_content .= '<tr bgcolor="'.$bgcolor.'"><td style="border:1px solid #faf0d7;">Invent&aacute;rio:</td><td style="border:1px solid #faf0d7;"><img id="ButtonEMail" onMouseDown="ToggleMaskedText(\'EMail\');" style="cursor:pointer;" src="'.$layout_name.'/images/general/show.gif"/><span id="DisplayEMail" ></span><span id="MaskedEMail" style="visibility:hidden;display:none" ></span><span id="ReadableEMail" style="visibility:hidden;display:none" ><br><br>'.$contentEquipment.'</span></td></tr>';
							// Parte do admin
				if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<tr bgcolor="'.$bgcolor.'"><td style="border:1px solid #faf0d7;">Items DEPOT:</td><td style="border:1px solid #faf0d7;"><img id="Buttondepot" onMouseDown="ToggleMaskedText(\'depot\');" style="cursor:pointer;" src="'.$layout_name.'/images/general/show.gif"/><span id="Displaydepot" ></span><span id="Maskeddepot" style="visibility:hidden;display:none" ></span><span id="Readabledepot" style="visibility:hidden;display:none" ><br/><br/>';
									$get_itemsdepot = $SQL->query("SELECT itemtype,count FROM `player_depotitems` WHERE `player_id` = '".$player->getID()."'")->fetchAll();
									$main_content .='<table border="1" style="width:100%">	<tr>';
									$qLinha = 0;
									foreach($get_itemsdepot as $depot_items) {
										$qLinha++;
										if ($qLinha%5 == 0) 
											$main_content .='<td><img src="images/items/'.$depot_items['itemtype'].'.gif"/></br>Name:'.$itemList[(int)$depot_items[itemtype]].'</br>ID: '.$depot_items['itemtype'].'</br>Qnt:'.$depot_items['count'].'</td></tr>';
										else 
												$main_content .='<td><img src="images/items/'.$depot_items['itemtype'].'.gif"/></br>Name:'.$itemList[(int)$depot_items[itemtype]].'</br>ID: '.$depot_items['itemtype'].'</br>Qnt:'.$depot_items['count'].'</td>';

									}
					
					$main_content .='</table></span></td></tr>';				
					
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					
					$main_content .= '<tr bgcolor="'.$bgcolor.'"><td style="border:1px solid #faf0d7;">Player ITEMS:</td><td style="border:1px solid #faf0d7;"><img id="Buttonitem" onMouseDown="ToggleMaskedText(\'item\');" style="cursor:pointer;" src="'.$layout_name.'/images/general/show.gif"/><span id="Displayitem" ></span><span id="Maskeditem" style="visibility:hidden;display:none" ></span><span id="Readableitem" style="visibility:hidden;display:none" ><br/><br/>';
					$get_itemsplayer = $SQL->query("SELECT itemtype,count FROM `player_items` WHERE `player_id` = '".$player->getID()."'")->fetchAll();
					$main_content .='<table border="1" style="width:100%">	<tr>';
					$qLinha = 0;
					foreach($get_itemsplayer as $player_items) {
						$qLinha++;
						if ($qLinha%5 == 0) 
							$main_content .='<td><img src="images/items/'.$player_items['itemtype'].'.gif"/></br>Name:'.$itemList[(int)$player_items[itemtype]].'</br>ID: '.$player_items['itemtype'].'</br>Qnt:'.$player_items['count'].'</td></tr>';
						else 
								$main_content .='<td><img src="images/items/'.$player_items['itemtype'].'.gif"/></br>Name:'.$itemList[(int)$player_items[itemtype]].'</br>ID: '.$player_items['itemtype'].'</br>Qnt:'.$player_items['count'].'</td>';

					}
					$main_content .='</table></span></td></tr>';
				}
	
				
				
				// Termina parte do admin




				$main_content .= '</TD></TR></TABLE></TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>';
	## Quest status by Leandro, organização by Felipe Monteiro ;)			            
	$quests = $config['site']['quests'];
	$questCount = count($config['site']['quests']);
	$questCountDone = 0;
	
	foreach($quests as $storage => $name) 
	{
		if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
		$quest = $SQL->query('SELECT * FROM player_storage WHERE player_id = '.$player->getId().' AND `key` = '.$quests[$storage].';')->fetch();
		$questList .= '<TR bgcolor="'.$bgcolor.'"><TD WIDTH=98%>'.$storage.'</TD>';
		if($quest == false) 
		{
			$questList .= '<TD><img src="images/false.png"/></TD></TR>';
		}
		else
		{
			$questList .= '<TD><img src="images/true.png"/></TD></TR>';
			$questCountDone++;
		}
	}
	$ilosc_procent = ( $questCountDone / $questCount ) * 100;
	$questComplet .= '<tr bgcolor='.$bgcolor.'><td ><table width=100%><tr><td width=25% style="color: white;"><b>Quest Complete</b>: '.round($ilosc_procent, 0).'%</td><td><div title="'.round($ilosc_procent, 0).'%" style="width: 100%;height: 9px;border: 1px solid #000;margin-left: -12px;border-radius: 5px;background: rgba(80, 80, 80, 0.71);">
	<div style="background: green;width: '.$ilosc_procent.'%;height: 7px;margin-top: 1px;border-radius: 6px;border: 0px solid black;"><div style="background: green;height: 9px;width: 0%;border: 1px solid #000;margin-left: 0px;border-radius: 5px;margin-top: -1px;"><div style="background-color: rgb(4, 190, 68); border-radius:6px; width: 0%; height: 7px;"></div>
	</td></tr></table>
		</td></tr>';
	$main_content .= '<BR> 
			<div class="TableContainer">
				<div class="CaptionContainer">
					<div class="CaptionInnerContainer">
						<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
						<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
						<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
						<div class="Text">'.$questComplet.' </div>
						<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
						<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
							</div>
								</div>
									<table class="Table5" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td>
												<div class="InnerTableContainer">
													<table style="width:100%;">
														<tbody>				
														<tr>
															<td>
																<div class="TableShadowContainerRightTop" >
																	<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
																</div>
																<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
																	<div class="TableContentContainer" >
																		';
																		$main_content .= '
																		<table border="0" cellspacing="1" cellpadding="4" width="100%">
																				<tr bgcolor="#505050">
																					<td colspan="2" class="white">
																						<img id="ButtonQuest" onmousedown="ToggleMaskedText(\'Quest\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/general/show.gif">
																						<b>Lista de Quests</b>
																					</td>
																				</tr>
																		</table>
																		<span id="DisplayQuest" ></span>
																		<span id="MaskedQuest" style="visibility:hidden;display:none" ></span>';
																		$main_content .= '
																		<div id="ReadableQuest" style="visibility:hidden;display:none">
																			<table border="0" cellspacing="1" cellpadding="4" width="100%">'.$questList.'</table>
																		</div>';
																		$main_content .= '	
																	</div>
																</div>											
																<div class="TableShadowContainer" >
																	<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																		<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																		<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
																	</div>
																</div>
															</td>
														</tr>			
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>';
		
			// Vip List show
			if($config['site']['showVipList'])
			{
				// Table player_viplist: player_id, vip_id
				// Table account_viplist: account_id, world_id, player_id
				$vip = 0;
				if($config['server']['separateVipListPerCharacter'] == false)
					$vipLists = $SQL->query('SELECT * FROM `account_viplist` WHERE `account_id` = '.$account->getId().';');
				else
					$vipLists = $SQL->query('SELECT * FROM `player_viplist` WHERE `player_id` = '.$player->getId().';');
				foreach($vipLists as $vipList) 
				{
					if($config['server']['separateVipListPerCharacter'] == false)
						$result = $SQL->query('SELECT * FROM `players` WHERE `id` = '.$vipList['player_id'].';');
					else
						$result = $SQL->query('SELECT * FROM `players` WHERE `id` = '.$vipList['vip_id'].';');
					foreach($result as $listVip)
					{
						$vip++;
						if($config['site']['show_flag'])
						{
							$accounts = $SQL->query('SELECT * FROM accounts WHERE id = '.$listVip['account_id'].'')->fetch();
							$flags = '<image src="http://images.boardhost.com/flags/'.$accounts['flag'].'.png"/> ';
						}
						if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
							$vipResult .= '<tr bgcolor='.$bgcolor.'>
								<td>'.$vip.'</td>
								<td>
									'.$flags.'<a href="index.php?subtopic=characters&name='.urlencode($listVip['name']).'">'.$listVip['name'].'</a>';
									if($config['site']['showMoreInfo'])
										$vipResult .= '<br><small>Level: '.$listVip['level'].', '.$vocation_name[$listVip['world_id']][$listVip['promotion']][$listVip['vocation']].', '.$config['site']['worlds'][$listVip['world_id']].'</small>';
								$vipResult .= '</td>
							</tr>';
					}
				}
				if($vip > 0)
					$main_content .= '<br><table border=0 cellspacing=1 cellpadding=4 width=100%><TR bgcolor='.$config['site']['vdarkborder'].'><TD align="left" COLSPAN=2 CLASS=white><B>Vip List</B></TD></TR>'.$vipResult.'</table>';
			}
			// Deaths list
			$deads = 0;
			$player_deaths = $SQL->query('SELECT `id`, `date`, `level` FROM `player_deaths` WHERE `player_id` = '.$player->getId().' ORDER BY `date` DESC LIMIT 0,'.$config['site']['limitDeath'].'');
			foreach($player_deaths as $death)
			{
				if(is_int($number_of_rows / 2))
					$bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder'];
				$number_of_rows++; $deads++;
				$dead_add_content .= "<tr bgcolor=\"".$bgcolor."\">
					<td width=\"20%\" align=\"center\" style=\"border:1px solid #faf0d7;\">".date("j M Y, H:i", $death['date'])."</td>
					<td style=\"border:1px solid #faf0d7;\">";
				$killers = $SQL->query("SELECT environment_killers.name AS monster_name, players.name AS player_name, players.deleted AS player_exists FROM killers LEFT JOIN environment_killers ON killers.id = environment_killers.kill_id
					LEFT JOIN player_killers ON killers.id = player_killers.kill_id LEFT JOIN players ON players.id = player_killers.player_id
					WHERE killers.death_id = ".$SQL->quote($death['id'])." ORDER BY killers.final_hit DESC, killers.id ASC")->fetchAll();
				$i = 0;
				$count = count($killers);
				foreach($killers as $killer)
				{
					$i++;
					if(in_array($i, array(1, $count)))
						$killer['monster_name'] = str_replace(array("an ", "a "), array("", ""), $killer['monster_name']);
					if($killer['player_name'] != "")
					{
						if($i == 1)
							$dead_add_content .= "Killed at level <b>".$death['level']."</b> by ";
						else 
							if($i == $count)
								$dead_add_content .= " and by ";
							else
								$dead_add_content .= ", ";
						if($killer['monster_name'] != "")
							$dead_add_content .= $killer['monster_name']." summoned by ";
						if($killer['player_exists'] == 0)
							$dead_add_content .= "<a href=\"index.php?subtopic=characters&name=".urlencode($killer['player_name'])."\">";
						$dead_add_content .= $killer['player_name'];
						if($killer['player_exists'] == 0)
							$dead_add_content .= "</a>";
					}
					else
					{
						if($i == 1)
							$dead_add_content .= "Died at level <b>".$death['level']."</b> by ";
						else 
							if($i == $count)
								$dead_add_content .= " and by ";
							else
								$dead_add_content .= ", ";
						$dead_add_content .= $killer['monster_name'];
					}
					if($i == $count)
						$dead_add_content .= "";
				}
				$dead_add_content .= ".</td></tr>";
			}
			if($deads > 0)
				$main_content .= '<BR>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Deaths</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
														<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>' . $dead_add_content . '</TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>';
				
            //frags list by Xampy 
             
            $frags_limit = 250; // frags limit to show? // default: 10 
            $player_frags = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 0 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if(count($player_frags)) 
            {
				 $frag_add_content .= '
	<br><div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Frags List</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
															<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><img id="ButtonInjust" onMouseDown="ToggleMaskedText(\'Injust\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Frags Justified</B></TD></TR></TABLE>

				<span id="DisplayInjust" ></span>
				<span id="MaskedInjust" style="visibility:hidden;display:none" ></span>'; 
                $frags = 0; 
                $frag_add_content .= '<span id="ReadableInjust" style="visibility:hidden;display:none" ><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>'; 
                foreach($player_frags as $frag) 
                { 
                $frags++; 
                    if(is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\" style=\"border:1px solid #faf0d7;\">".date("j M Y, H:i", $frag['date'])."</td> 
                    <td style=\"border:1px solid #faf0d7;\">".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag[name]."\">".$frag[name]."</a> at level ".$frag[level].""; 
 
                    $frag_add_content .= ". (".(($frag[unjustified] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                } 
            if($frags >= 0) 
                $main_content .= $frag_add_content . '</TABLE></span>															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>';  
				}

			 //frags list by Xampy 
             
            $frags_limit = 250; // frags limit to show? // default: 10 
            $player_frags_unjust = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 1 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if(count($player_frags_unjust)) 
            { 
				$frag_unjust_add_content .= '
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><img id="ButtonUnjust" onMouseDown="ToggleMaskedText(\'Unjust\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Frags Unjustified</B></TD></TR></TABLE>
				<span id="DisplayUnjust" ></span>
				<span id="MaskedUnjust" style="visibility:hidden;display:none" ></span>';
				
                $frags = 0; 
                $frag_unjust_add_content .= '<span id="ReadableUnjust" style="visibility:hidden;display:none" ><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>'; 
                foreach($player_frags_unjust as $frag_unjust) 
                { 
                $frags++; 
                    if(is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_unjust_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\" style=\"border:1px solid #faf0d7;\">".date("j M Y, H:i", $frag_unjust['date'])."</td> 
                    <td style=\"border:1px solid #faf0d7;\">".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag_unjust[name]."\">".$frag_unjust[name]."</a> at level ".$frag_unjust[level].""; 
 
                    $frag_unjust_add_content .= ". (".(($frag_unjust[unjustified] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                } 
            if($frags >= 0) 
                $main_content .= $frag_unjust_add_content . '</TABLE></span>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>';  
				}	
				
				
			// onther info
			if(!$player->getHideChar() || $group_id_of_acc_logged >= $config['site']['access_admin_panel']) 
			{
				$main_content .= '<BR>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Account Information</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>';
	
	            $group = $player->getGroup();
            if ($group == 2){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#626369" style="text-shadow: 1px 1px 12px #59595C;"><b>Tutor</b></span></font>';}
            if ($group == 3){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#C000CC" style="text-shadow: 1px 1px 12px #600066;"><b>Senior Tutor</b></span></font>';}
            if ($group == 4){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#001BCC" style="text-shadow: 1px 1px 12px #252E69;"><b>Gamemaster</b></span></font>';}
            if ($group == 5){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#FFDD00" style="text-shadow: 1px 1px 12px #3c3c39;"><b>Community Manager</b></span></font>';}
            if ($group == 6){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#ffa12c" style="text-shadow: 1px 1px 12px #000000;"><b>God</b></span></font>';}
            if ($group == 7){$group_name = '<span style="background: transparent url(/layouts/tibiarl/images/brilho.gif)"><font color="#E71919" style="text-shadow: 1px 1px 12px #cf1616;"><b>Administrador</b></span></font>';}

            if($group != 1)
            {
                $main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD style="border:1px solid #faf0d7;">Position:</TD><TD style="border:1px solid #faf0d7;">'.$group_name.'</TD></TR>';
            }			
				
				
				$name = $account->getRLName();
				if(!empty($name)){
				$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20% style="border:1px solid #faf0d7;">Real Name:</TD><TD style="border:1px solid #faf0d7;">'.$account->getRLName().'</TD></TR>';	
				}
				$location = $account->getLocation();
				if(!empty($location)){
				$main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD WIDTH=20% style="border:1px solid #faf0d7;">Location:</TD><TD style="border:1px solid #faf0d7;">'.$account->getLocation().'</TD></TR>';
				}
				
				
				if($account->getCreateDate())
				{
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20% style="border:1px solid #faf0d7;">Created:</TD><TD style="border:1px solid #faf0d7;">'.date("j F Y, g:i a", $account->getCreateDate()).'</TD></TR>';
                
				}
				if($account->getVipTime()){
				/*Vip Status*/ 				
            if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;  
            $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Vip Status:</TD><TD style="border:1px solid #faf0d7;">';  
            $main_content .= '<font color="#00CD00" style="text-shadow: 1px 1px #014b01;"><b>VIP Account</b></font>';
				}else{
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD style="border:1px solid #faf0d7;">Vip Status:</TD><TD style="border:1px solid #faf0d7;">';
					$main_content .= '<font color="#FF0000" style="text-shadow: 1px 1px #580208;"><b>Not Vip Account</b></font>';
				}
				if($account->isBanned())
                                        if($account->getBanTime() > 0)
						$main_content .= '<font color="red"> [Banished until '.date("j F Y, G:i", $account->getBanTime()).']</font>';
					else
						$main_content .= '<font color="red"> [Banished FOREVER]</font>';
				
				$main_content .= '</TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>';
				$main_content .= '<BR>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Characters</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
					<TR BGCOLOR='.$config['site']['darkborder'].'><TD style="border:1px solid #faf0d7;"><b>Outfit</b></TD><TD style="border:1px solid #faf0d7;"><B>Name</B></TD><TD style="border:1px solid #faf0d7;"><B>World</B></TD><TD style="border:1px solid #faf0d7;"><b>Status</b></TD><TD style="border:1px solid #faf0d7;"><B>&#160;</B></TD></TR>';
				$account_players = $account->getPlayersList();
				$player_number = 0;
				foreach($account_players as $player_list)
				{
					if(!$player_list->getHideChar() || $group_id_of_acc_logged >= $config['site']['access_admin_panel'])
					{
						$player_number++;
						if(is_int($player_number / 2))
							$bgcolor = $config['site']['darkborder'];
						else
							$bgcolor = $config['site']['lightborder'];
						if(!$player_list->isOnline())
							$player_list_status = '';
						else
							$player_list_status = '<font color="#00CD00" style="text-shadow: 1px 1px #043d00;"><b>Online</b></font>';
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td style="border:1px solid #faf0d7;"><div style="position: relative; width: 32px; height: 32px;"><div style="background-image: url(/outfit.php?id='.$player_list->getCustomField("looktype").'&addons='.$player_list->getCustomField("lookaddons").'&head='.$player_list->getCustomField("lookhead").'&body='.$player_list->getCustomField("lookbody").'&legs='.$player_list->getCustomField("looklegs").'&feet='.$player_list->getCustomField("lookfeet").'); position: absolute; width: 64px; height: 80px; background-position: bottom right; background-repeat: no-repeat; right: -10px; bottom: 0px;"></div></div>
					</td><TD WIDTH=18% style="border:1px solid #faf0d7;"><NOBR>'.$player_number.'.&#160;'.$player_list->getName();
						$main_content .= ($player_list->isDeleted()) ? '<font color="red"> [DELETED]</font>' : '';
						$main_content .= '</NOBR></TD><TD WIDTH=12% style="border:1px solid #faf0d7;">'.$config['site']['worlds'][$player_list->getWorld()].'<TD WIDTH="60%" style="border:1px solid #faf0d7;"><b>'.$player_list_status.'</b></TD><TD style="border:1px solid #faf0d7;"><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION="?subtopic=characters" METHOD=post><TR><TD><INPUT TYPE=hidden NAME=name VALUE="'.$player_list->getName().'"><INPUT TYPE=image NAME="View '.$player_list->getName().'" ALT="View '.$player_list->getName().'" SRC="'.$layout_name.'/images/buttons/sbutton_view.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></FORM></TABLE></TD></TR>';
					}
				}
				$main_content .= '</TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>';
			}
			$main_content .= '<BR><FORM ACTION="?subtopic=characters" METHOD=post>
<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Search Character</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
															<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['darkborder'].'" style="border:1px solid #faf0d7;"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div></FORM>';
			$main_content .= '</TABLE>';
		}
		else
			$search_errors[] = 'Character <b>'.$name.'</b> does not exist.';
	}
	else
		$search_errors[] = 'This name contains invalid letters. Please use only A-Z, a-z and space.';
	if(!empty($search_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($search_errors as $search_error)
		$main_content .= '<li>'.$search_error;
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
		$main_content .= '<BR><FORM ACTION="?subtopic=characters" METHOD=post>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Search Character</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
															<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE>
															</TD></TR></TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>			
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div></FORM>';
	}
}
?>