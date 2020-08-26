<?php
if(!defined('INITIALIZED'))
	exit;
$update_interval = 1;if(!isset($world_id)){$world_id = 0;$world_name = $config['server']['serverName'];}$order = $_REQUEST['order'];if($order == 'level')$orderby = 'level';elseif($order == 'vocation')$orderby = 'vocation';if(empty($orderby))$orderby = 'name';$tmp_file_name = 'cache/whoisonline-'.$orderby.'-'.$world_id.'.tmp';
$cache_sec = 1;
$info = array(
	0 => array($config['server']['location'], date("d/m/Y")),
	1 => array('EUA', date("d/m/Y"))
);

$id=0;
if(isset($_POST['world'])) {
	$f = null;
	foreach($config['site']['worlds'] as $k => $v)
		if($v == $_POST['world']) {
			$f = true;
			$id = $k;
			break;
		}
	if(!$f)
		$_POST['world'] = $config['site']['worlds'][0];
} else $_POST['world'] = $config['site']['worlds'][0];

$order = 'name_asc';
if(isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('name_desc', 'level_asc','level_desc','vocation_asc','vocation_desc')))
$order = $_REQUEST['order'];

$players_online_data = $SQL->query('SELECT ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('flag') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('vocation') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('promotion') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('level') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('skull') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looktype') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookaddons') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookhead') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookbody') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looklegs') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookfeet') . ' FROM ' . $SQL->tableName('accounts') . ', ' . $SQL->tableName('players') . ' WHERE ' . $SQL->tableName('players') . '.' . $SQL->fieldName('world_id') . ' = ' . $SQL->quote($world_id) . ' AND ' . $SQL->tableName('players') . '.' . $SQL->fieldName('online') . ' = ' . $SQL->quote(1) . ' AND ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('players') . '.' . $SQL->fieldName('account_id') . ' ORDER BY ' . $SQL->fieldName($orderby))->fetchAll();

$number_of_players_online = 0;
$vocations_online_count = array(0,0,0,0,0); // change it if you got more then 5 vocations
$players_rows = '';
foreach($players_online_data as $player)
{
	$vocations_online_count[$player['vocation']] += 1;
}
if(count($config['site']['worlds']) > 1) {
	$main_content ='
<form action="?subtopic=whoisonline" method="post">
	<div class="TableContainer">
		<table class="Table1" cellpadding="0" cellspacing="0">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
					<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
					<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
					<div class="Text">World Selection</div>
					<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
					<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				</div>
			</div>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table width="100%">
							<tr>
								<td style="vertical-align:middle" class="LabelV150">World Name:</td>
								<td style="width:170px">
									<select size="1" name="world" style="width:165px">';
foreach($config['site']['worlds'] as $v)
	$main_content .= '<option value="'.$v.'"'.($v == $_POST['world'] ? ' selected="selected"' : '').'>'.$v.'</option>';
$main_content .= '
									</select>
								</td>
								<td style="text-align:left">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)">
										<div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div>
											<input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"/>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
</form><br/>
';
}
$main_content .=
'
<table width="200" cellspacing="1" cellpadding="0" border="0" align="center">
    <tbody>
        <tr>
            </tr><tr bgcolor="">
            <td><img src="images/vocations/sorcerer_small.png" width="80" height="80"></td>
            <td><img src="images/vocations/druid_small.png" width="80" height="80"></td>
            <td><img src="images/vocations/paladin_small.png" width="80" height="80"></td>
            <td><img src="images/vocations/knight_small.png" width="80" height="80"></td>
        </tr>
        <tr>
            </tr><tr bgcolor="#F1E0C6">
            <td style="text-align: center;"><font face="georgia" color="black">Sorcerers</font></td>
            <td style="text-align: center;"><font face="georgia" color="black">Druids</font></td>
            <td style="text-align: center;"><font face="georgia" color="black">Paladins</font></td>
            <td style="text-align: center;"><font face="georgia" color="black">Knights</font></td>
        </tr>
        <tr>
            </tr><tr bgcolor="#F1E0C6">
            <td style="text-align: center;">'.$vocations_online_count[1].'</td>
            <td style="text-align: center;">'.$vocations_online_count[2].'</td>
            <td style="text-align: center;">'.$vocations_online_count[3].'</td>
            <td style="text-align: center;">'.$vocations_online_count[4].'</td>
        </tr>
    </tbody>
</table><br />
<div class="TableContainer">
	<table class="Table1" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Informações do servidor</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
							<td class="LabelV150"><b>Status:</b></td>
							<td><b><font color="green">Online</font></b></td>
						</tr>
						<tr>
							<td class="LabelV150"><b>Jogadores Online:</b></td>
							<td>';
$f = 'cache/whoisonline-'.$_POST['world'].'-'.$order.'.tmp';
$ff = 'cache/whoisonline-'.$_POST['world'].'-record.tmp';
if(file_exists($f) && filemtime($f) > (time() - $cache_sec)) {
	$cp = file_get_contents($f);
	$cached = null;
	if(file_exists($f) && filemtime($f) > (time() - $cache_sec)) {
		$e = explode('|', file_get_contents($ff));
		$n = $e[0];
		$c = $e[1];
		$cached = true;
	}
}
else {
	$cp = '';
	$n = 0;
	$q = 'SELECT name,level,vocation,promotion,viewers, looktype, lookbody, looklegs, lookhead, lookfeet, lookaddons FROM players WHERE world_id='.$id.' AND online=1';
	if(in_array($order, array('name_asc','name_desc','level_asc','level_desc')))
		$q .= ' ORDER BY '.str_replace('_', ' ', $order);

	if(in_array($order, array('vocation_asc','vocation_desc'))) {
		$a = array();
		foreach($SQL->query($q)->fetchAll() as $p)
			$a[] = array($p['name'], $p['level'], $vocation_name[$p['promotion']][$p['vocation']]);
		function cmp($a, $b) {
			$r = strcmp($a[2], $b[2]);
			$r = $GLOBALS['order'] == 'vocation_desc' ? ($r == 1 ? -1 : ($r == -1 ? 1 : 0)) : $r;
			return ($r == 0 && $a[1] < $b[1]) ? 1 : $r;
		}
		usort($a, 'cmp');
		foreach($a as $p) {
			$n++;
			$cp .= '<tr class="'.(is_int($n/2)?'Odd':'Even').'" style="text-align:right"><td style="width:70%;text-align:left"><a href="?subtopic=characters&name='.urlencode($p[0]).'">'.$p[0].'</a></td><td style="width:10%">'.$p[1].'</td><td style="width:20%">'.str_replace(' ','&#160;',$p[2]).'</td></tr>';
		}

	}
	else {
		$l = array();
		
		foreach($SQL->query('SELECT ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('flag') . ', ' . $SQL->fieldName('vip_time') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('vocation') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('promotion') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('level') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('skull') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looktype') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('broadcasting') . ',' . $SQL->fieldName('viewers') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookaddons') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookhead') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookbody') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looklegs') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookfeet') . ' FROM ' . $SQL->tableName('accounts') . ', ' . $SQL->tableName('players') . ' WHERE ' . $SQL->tableName('players') . '.' . $SQL->fieldName('world_id') . ' = ' . $SQL->quote($world_id) . ' AND ' . $SQL->tableName('players') . '.' . $SQL->fieldName('online') . ' = ' . $SQL->quote(1) . ' AND ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('players') . '.' . $SQL->fieldName('account_id') . ' ORDER BY ' . $SQL->fieldName($orderby))->fetchAll() as $p) {
			$n++;
			$cp .= '<tr class="'.(is_int($n/2)?'Odd':'Even').'" style="height:32px">';
			$cp .= '<td style="width:70%;text-align:left">';
			if($order == 'name_asc') {
				$tmp = strtoupper($p['name'][0]);
				if(!in_array($tmp, $l)) {
					$l[] = $tmp;
					$cp .= '<a name="'.$tmp.'"></a>';
				}
			}
			$cp .= '
			<style>
		.outfitImg 
		{
	     background-position: right bottom;
	     background-repeat: no-repeat;
         width: 64px;
         height: 64px;
         position: relative;
         top: 15px;
         left: 20px;
	     margin-left: -64px;
	     margin-top: -64px;
         }
		 .TableHeadlineNavigation a 
		 {
         color: white;
		 }
		 .push {
    padding-right: 26px;
	}
	        </style>
			<span><div class="outfitImg" style="background-image:url(\'/outfit.php?id='.$p['looktype'].'&addons='.$p['lookaddons'].'&head='.$p['lookhead'].'&body='.$p['lookbody'].'&legs='.$p['looklegs'].'&feet='.$p['lookfeet'].'\');"></div></span><span class="push"></span><image src="images/flags/'.$p['flag'].'.gif"/> <a href="?subtopic=characters&name='.urlencode($p['name']).'">'.$p['name'].'</a> '.(($p['vip_time'] >= 1) ? '<span style="color:#FFFF00; text-shadow:#000000 1px 1px 5px;"><span style="background: transparent url(images/vip/7wnzO0F.gif)"><img src="images/vip/vip.png" title="Vip Account"></span></span>' : "").'
			
			'.(($p['broadcasting'] >= 1) ? '<a href="?subtopic=castsystem"><img src="images/live.gif" title="Viewers: '.$p['viewers'].' " alt="Viewers: '.$p['viewers'].'"></a>' : "").'
			</td><td style="width: 10%"><center>'.$p['level'].'</center></td><td style="text-align: right;">'.htmlspecialchars($vocation_name[$p['promotion']][$p['vocation']]).'</td></tr>';
		}
		
	}
	file_put_contents($f, $cp);
}
if(!$cached) {
	$r=$SQL->query('SELECT MAX(record) as r,MAX(timestamp) as t FROM server_record WHERE world_id='.$id)->fetch();
	$c = $r['r'].' players (on '.date('M&#160;d&#160;Y,&#160;H:i:s&#160;T', $r['t']).')';
	file_put_contents($ff, $n.'|'.$c);

}
$main_content .= $n.' players estão jogando.</td>
						</tr>
						<tr>
							<td class="LabelV150"><b>Record de jogadores Online:</b></td>
							<td>'.$c.'</td>
						</tr>
						<tr>
							<td class="LabelV150"><b>Data de abertura do '.$config['server']['serverName'].':</b></td>
							<td>01/12/2019</td>
						</tr>
						
						<tr>
							<td class="LabelV150"><b>PvP Type:</b></td>
							<td>';
$w=strtolower($config['server']['worldType']);
if(in_array($w, array('pvp','2','normal','open','openpvp')))
	$main_content .= 'Open PvP';
elseif(in_array($w, array('no-pvp','nopvp','non-pvp','nonpvp','1','safe','optional','optionalpvp')))
	$main_content .= 'Optional PvP';
elseif(in_array($w, array('pvp-enforced','pvpenforced','pvp-enfo','pvpenfo','pvpe','enforced','enfo','3','war','hardcore','hardcorepvp')))
	$main_content .= 'Hardcore PvP';
$main_content .= '</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div><br/>
	<div class="TableContainer">
		<table class="Table2" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
		<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
		<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
		<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
		<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
		<div class="Text">Players Online';
if($order == 'name_asc')
	$main_content .= '<span class="TableHeadlineNavigation"> [
	<a href="#A">A</a>
	<a href="#B">B</a>
	<a href="#C">C</a>
	<a href="#D">D</a>
	<a href="#E">E</a>
	<a href="#F">F</a>
	<a href="#G">G</a>
	<a href="#H">H</a>
	<a href="#I">I</a>
	<a href="#J">J</a>
	<a href="#K">K</a>
	<a href="#L">L</a>
	<a href="#M">M</a>
	<a href="#N">N</a>
	<a href="#O">O</a>
	<a href="#P">P</a>
	<a href="#Q">Q</a>
	<a href="#R">R</a>
	<a href="#S">S</a>
	<a href="#T">T</a>
	<a href="#U">U</a>
	<a href="#V">V</a>
	<a href="#W">W</a>
	<a href="#X">X</a>
	<a href="#Y">Y</a>
	<a href="#Z">Z</a> ]&#160;&#160;</span>';
$main_content .= '</div>
<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
</div>
</div>
<tr>
<td>
<div class="InnerTableContainer">
<table width="100%">
<tr class="LabelH">
<td style="text-align:left;width:50%">Nome&#160;&#160;<small style="font-weight:normal">[<a href="#">sort</a>]</small>
<img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'name_desc' ? 'content/order_desc' : ($order == 'name_asc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td>
<td style="text-align:center;width:30%">Level
<small style="font-weight:normal">[<a href="#">sort</a>]</small>
<img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'level_asc' ? 'content/order_desc' : ($order == 'level_desc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td>
<td style="text-align:left;width:50%">Vocação&#160;&#160;<small style="font-weight:normal">[<a href="#">sort</a>]</small>
<img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'vocation_asc' ? 'content/order_desc' : ($order == 'vocation_desc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td>
</tr>';

$main_content .= $cp;
if (!$cp){$main_content .='<tr><td colspan="3" align="center"><i>Nenhum jogador online no momento! :(</i></td></tr>';}
$main_content .='
</table>
</div>
</table>
</div>
</td>
</tr>
<br/>
<form action="?subtopic=characters" method="post"><div class="TableContainer">  <table class="Table1" cellpadding="0" cellspacing="0">    <div class="CaptionContainer">      <div class="CaptionInnerContainer">        <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <div class="Text">Procurar Personagem</div>        <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer">          <table width="60%"><tr><td style="vertical-align:middle" class="LabelV150"><b>Nome do personagem:</b></td><td style="width:170px"><input style="width:165px" name="name" value="" size="29" maxlength="29"/></td><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td></tr>          </table>        </div>  </table></div></td></tr></form></center>';
?>