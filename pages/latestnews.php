<style>
button.farathor_button_top {
    background: linear-gradient(#d4c0a1 0,#f1e0c6 100%);
    color: #4e4b3a;
    cursor: help;
    padding: 10px;
    width: 100%;
    text-align: left;
	
	border: 1px solid #350404;
    outline: none;
    font-size: 13px;
    transition: 0.4s;
	font: 400 8pt Verdana,Arial,Times New Roman,sans-serif;
}
	button.farathor_button_top.active, button.farathor_button_top:hover {
    background-color: #ecf7f7;
}

button.farathor_button_top:after {
  
    font-weight: bold;
    float: right;
    margin-left: 1px;
}

button.farathor_button_top.active:after {
    content: "\2212";
}

div.farathor_panel {
    padding: 0 18px;
    background-color: #F1E0C6;
	font: 400 8pt Verdana,Arial,Times New Roman,sans-serif;

    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
</style>

<script>
var acc = document.getElementsByClassName("farathor_button_top");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var farathor_panel = this.nextElementSibling;
    if (farathor_panel.style.maxHeight){
      farathor_panel.style.maxHeight = null;
    } else {
      farathor_panel.style.maxHeight = farathor_panel.scrollHeight + "px";
    } 
  }
}
</script>

<?php
if(!defined('INITIALIZED'))
	exit;

date_default_timezone_set('America/Sao_Paulo');

$tickerSql = $SQL->query("SELECT ");
//NEWSTICKER
$time = time();
$vTick = $SQL->query("SELECT " .$SQL->fieldName('date'). " FROM " .$SQL->tableName('z_news_tickers'). " WHERE " .$SQL->fieldName('hide_ticker'). " = '0'")->fetch();
if(isset($vTick['date'])){
$news_content .= '
	<div id="NewsTicker" class="Box">
    	<div class="Corner-tl" style="background-image: url('.$layout_name.'/images/content/corner-tl.gif);"></div>
    	<div class="Corner-tr" style="background-image: url('.$layout_name.'/images/content/corner-tr.gif);"></div>
    	<div class="Border_1" style="background-image: url('.$layout_name.'/images/content/border-1.gif);"></div>
		<div class="BorderTitleText" style="background-image: url('.$layout_name.'/images/content/title-background-green.gif);">
			<div class="headlineContent">News Ticker</div>
		</div>    	
    		<div class="Border_2">
      			<div class="Border_3">
        			<div class="BoxContent" style="background-image: url('.$layout_name.'/images/content/scroll.gif);">';
					//##################### ADD NEW TICKER #####################
					if($action == "newticker") {
						if($group_id_of_acc_logged >= $config['site']['access_tickers']) {
							$ticker_text = stripslashes(trim($_POST['new_ticker']));
							$ticker_icon = (int) $_POST['icon_id'];
							if(empty($ticker_text)) {
								$news_content .= 'You can\'t add empty ticker.';
							}
							else
							{
							if(empty($ticker_icon)) {
								$news_icon = 0;
							}
					$SQL->query('INSERT INTO '.$SQL->tableName('z_news_tickers').' (date, author, image_id, text, hide_ticker) VALUES ('.$SQL->quote($time).', '.$account_logged->getId().', '.$ticker_icon.', '.$SQL->quote($ticker_text).', 0)');
					$news_content .= '
						<center>
							<h2>
								<font color="red">Added new ticker:</font>
							</h2>
						</center>
						<hr/>
						<div id="newsticker" class="Box">
							<div id="TickerEntry-1" class="Row" onclick=\'TickerAction("TickerEntry-1")\'>
  								<div class="Odd">
    								<div class="NewsTickerIcon" style="background-image: url('.$layout_name.'/images/news/icon_'.$ticker['image_id'].'.gif);"></div>
    								<div id="TickerEntry-1-Button" class="NewsTickerExtend" style="background-image: url('.$layout_name.'/images/general/plus.gif);"></div>
    								<div class="NewsTickerText">
      										<span class="NewsTickerDate">'.date("d/m/Y", $time).' -</span> 
      										<div id="TickerEntry-1-ShortText" class="NewsTickerShortText">';
					$news_content .= '
						<a href="?subtopic=latestnews&action=deleteticker&id='.$time.'">
							<img src="'.$layout_name.'/images/news/delete.png" border="0">
						</a>';
					$news_content .= short_text($ticker_text, 60).'</div>
      					<div id="TickerEntry-1-FullText" class="NewsTickerFullText">';
					$news_content .= '<a href="?subtopic=latestnews&action=deleteticker&id='.$time.'"><img src="'.$layout_name.'/images/news/delete.png" border="0"></a>';
					$news_content .= $ticker_text.'
						</div>
    				</div>
  				</div>
			</div>
		</div>
	<hr/>';
	}
}
else
{
	$news_content .= 'You don\'t have admin rights. You can\'t add new ticker.';
}
	$news_content .= '<form action="?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
}
//#################### DELETE (HIDE only!) TICKER ############################
if($action == "deleteticker") {
if($group_id_of_acc_logged >= $config['site']['access_tickers']) {
header("Location: ");
$date = (int) $_REQUEST['id'];
$SQL->query('UPDATE '.$SQL->tableName('z_news_tickers').' SET hide_ticker = 1 WHERE '.$SQL->fieldName('date').' = '.$date.';');
$news_content .= '<center>News tickets with <b>date '.date("j F Y, g:i a", $date).'</b> has been deleted.<form action="?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center></div></div>
    </div>
    <div class="Border_1" style="background-image: url('.$layout_name.'/images/content/border-1.gif);"></div>
    <div class="CornerWrapper-b"><div class="Corner-bl" style="background-image: url('.$layout_name.'/images/content/corner-bl.gif);"></div></div>
    <div class="CornerWrapper-b"><div class="Corner-br" style="background-image: url('.$layout_name.'/images/content/corner-br.gif);"></div></div>
  </div>';
}
else
{
$news_content .= '<center>You don\'t have admin rights. You can\'t delete tickers.<form action="?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form></center>';
}
}
//show tickers if any in database or not blocked (tickers limit = 0)
$tickers = $SQL->query('SELECT * FROM `z_news_tickers` WHERE hide_ticker != 1 ORDER BY date DESC LIMIT 5;');
$number_of_tickers = 0;
if(is_object($tickers)) {
foreach($tickers as $ticker) {
if(is_int($number_of_tickers / 2))
        $color = "Odd";
else
        $color = "Even";
$tickers_to_add .= '<div id="TickerEntry-'.$number_of_tickers.'" class="Row" onclick=\'TickerAction("TickerEntry-'.$number_of_tickers.'")\'>
  <div class="'.$color.'">
    <div class="NewsTickerIcon" style="background-image: url('.$layout_name.'/images/news/icon_'.$ticker['image_id'].'.gif);"></div>
    <div id="TickerEntry-'.$number_of_tickers.'-Button" class="NewsTickerExtend" style="background-image: url('.$layout_name.'/images/general/plus.gif);"></div>
    <div class="NewsTickerText">
      <span class="NewsTickerDate">'.date("d/m/Y", $ticker['date']).' -</span>
      <div id="TickerEntry-'.$number_of_tickers.'-ShortText" class="NewsTickerShortText">';
//if admin show button to delete (hide) ticker
if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
$tickers_to_add .= '<a href="?subtopic=latestnews&action=deleteticker&id='.$ticker['date'].'"><img src="'.$layout_name.'/images/news/delete.png" border="0"></a>';
}
$tickers_to_add .= short_text($ticker['text'], 60).'</div>
      <div id="TickerEntry-'.$number_of_tickers.'-FullText" class="NewsTickerFullText">';
//if admin show button to delete (hide) ticker
if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
$tickers_to_add .= '<a href="?subtopic=latestnews&action=deleteticker&id='.$ticker['date'].'"><img src="'.$layout_name.'/images/news/delete.png" border="0"></a>';
}
$tickers_to_add .= $ticker['text'].'</div>
    </div>
  </div>
</div>';
$number_of_tickers++;
}
}
}

//adding news
if($action == "newnews") {
if($group_id_of_acc_logged >= $config['site']['access_news']) {
$text = ($_REQUEST['text']);
$char_id = (int) $_REQUEST['char_id'];
$post_topic = stripslashes(trim($_REQUEST['topic']));
$smile = (int) $_REQUEST['smile'];
$news_icon = (int) $_REQUEST['icon_id'];
if(empty($news_icon)) {
$news_icon = 0;
}
if(empty($post_topic)) {
$an_errors[] .= 'You can\'t add news without topic.';
}
if(empty($text)) {
$an_errors[] .= 'You can\'t add empty news.';
}
if(empty($char_id)) {
$an_errors[] .= 'Select character.';
}
//execute query
if(empty($an_errors)) {
$SQL->query("INSERT INTO `z_forum` (`id` ,`first_post` ,`last_post` ,`section` ,`replies` ,`views` ,`author_aid` ,`author_guid` ,`post_text` ,`post_topic` ,`post_smile` ,`post_date` ,`last_edit_aid` ,`edit_date`, `post_ip`, `icon_id`) VALUES ('NULL', '0', '".time()."', '1', '0', '0', '".$account_logged->getId()."', '".(int) $char_id."', ".$SQL->quote($text).", ".$SQL->quote($post_topic).", '".(int) $smile."', '".time()."', '0', '0', '".$_SERVER['REMOTE_ADDR']."', '".$news_icon."')");
$thread_id = $SQL->lastInsertId();
$SQL->query("UPDATE `z_forum` SET `first_post`=".(int) $thread_id." WHERE `id` = ".(int) $thread_id);//show added data
$main_content .= '<form action="index.php?subtopic=latestnews" METHOD=post><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" ></div></div></form>';
}
else
{
//show errors
$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
foreach($an_errors as $an_error) {
	$main_content .= '<li>'.$an_error;
}
$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
//okno edycji newsa z wpisanymi danymi przeslanymi wczesniej
$main_content .= '<form action="index.php?subtopic=latestnews&action=newnews" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="'.$layout_name.'/images/news/icon_0.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_1.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_2.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_3.gif" width="20"></td><td><img src="'.$layout_name.'/images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="F1E0C6"><b>Topic:</b></td><td><input type="text" name="topic" maxlenght="50" style="width: 300px" value="'.$post_topic.'"></td></tr><tr><td align="center" bgcolor="D4C0A1"><b>News<br>text:</b></td><td bgcolor="F1E0C6"><textarea name="text" rows="6" cols="60">'.$text.'</textarea></td></tr><tr><td width="180"><b>Character:</b></td><td><select name="char_id"><option value="0">(Choose character)</option>'.$str.'</select></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="CancelAddNews" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="location.href=\'index.php?subtopic=latestnews\';" alt="CancelAddNews" /></div></div></td></tr></table>';
}
}
else
{
$main_content .= 'You don\'t have site-admin rights. You can\'t add news.';}
}

if(!empty($tickers_to_add)) {
//show table with tickers

if($group_id_of_acc_logged >= $config['site']['access_admin_panel'] && $action!=newticker)
$news_content .= '<script type="text/javascript">
var showednewticker_state = "0";
function showNewTickerForm()
{
if(showednewticker_state == "0") {
document.getElementById("newtickerform").innerHTML = \'<form action="?subtopic=latestnews&action=newticker" method="post" ><table border="0"><tr><td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td><td><table border="0" bgcolor="F1E0C6"><tr><td><img src="images/news/icon_0.gif" width="20"></td><td><img src="images/news/icon_1.gif" width="20"></td><td><img src="images/news/icon_2.gif" width="20"></td><td><img src="images/news/icon_3.gif" width="20"></td><td><img src="images/news/icon_4.gif" width="20"></td></tr><tr><td><input type="radio" name="icon_id" value="0" checked="checked"></td><td><input type="radio" name="icon_id" value="1"></td><td><input type="radio" name="icon_id" value="2"></td><td><input type="radio" name="icon_id" value="3"></td><td><input type="radio" name="icon_id" value="4"></td></tr></table></td></tr><tr><td align="center" bgcolor="D4C0A1"><b>New<br>ticker<br>text:</b></td><td bgcolor="F1E0C6"><textarea name="new_ticker" rows="3" cols="45"></textarea></td></tr><tr><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></form><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/_sbutton_cancel.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></td></tr></table>\';
document.getElementById("jajo").innerHTML = \'\';
showednewticker_state = "1";
}
else {
document.getElementById("newtickerform").innerHTML = \'\';
document.getElementById("jajo").innerHTML = \'<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/addticker.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div>\';
showednewticker_state = "0";
}
}
</script><div id="newtickerform"></div><div id="jajo"><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><img class="ButtonText" id="AddTicker" src="'.$layout_name.'/images/buttons/addticker.gif" onClick="showNewTickerForm()" alt="AddTicker" /></div></div></div><hr/>';
//add tickers list
$news_content .= $tickers_to_add;
//koniec
$news_content .= '</div>
      </div>
    </div>
    <div class="Border_1" style="background-image: url('.$layout_name.'/images/content/border-1.gif);"></div>
    <div class="CornerWrapper-b"><div class="Corner-bl" style="background-image: url('.$layout_name.'/images/content/corner-bl.gif);"></div></div>
    <div class="CornerWrapper-b"><div class="Corner-br" style="background-image: url('.$layout_name.'/images/content/corner-br.gif);"></div></div>
  </div>';
}
//NEWSTICKER END



//FEATURED ARTICLE
	$news_content .= '
	<div id="FeaturedArticle" class="Box">
		<div class="Corner-tl" style="background-image:url('.$layout_name.'/images/content/corner-tl.gif);"></div>
		<div class="Corner-tr" style="background-image:url('.$layout_name.'/images/content/corner-tr.gif);"></div>
		<div class="Border_1" style="background-image:url('.$layout_name.'/images/content/border-1.gif);"></div>
		<div class="BorderTitleText" style="background-image:url('.$layout_name.'/images/content/title-background-green.gif);">
			<div class="headlineContent">Server Information</div>
		</div>		
		<div class="Border_2">
			<div class="Border_3">
				<div class="BoxContent" style="background-image:url('.$layout_name.'/images/content/scroll.gif);">
					<table style="background-color: #d4c0a1;border: 2px solid #350404;box-shadow: 0 3px 2px 0 rgba(0,0,0,0.42),0 8px 7px 0 rgba(0,0,0,0.2)!important;" bgcolor="#D4C0A1" border="0" cellpadding="4" cellspacing="1" width="100%"> 
						<tbody>
							<tr>
								<td style="background-image:url(./layouts/tibiarl/images/news/newsheadline_background.gif);font-size: 12;text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" align="center" class="white">
									<b><img style="margin-top: -5px; position:absolute; margin-left: -30px;" src="images/Addons/Ankh.gif" width="25" height="25"> CONHEÇA O SERVIDOR <img style="margin-top: -5px; position:absolute; margin-left: 7px;" src="images/Addons/Ankh.gif" width="25" height="25"></b>
								</td>
							</tr>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
                                            <tbody>
                                                <tr>
                                                    <td>
														<table border="0" cellpadding="3" cellspacing="1" width="100%">                                  
															<tbody>							
																<center>
																	<b>IP:</b> Baiak.com &nbsp;➥  <b>Port:</b> 7171 &nbsp;➥  <b>Version:</b> 8.60 &nbsp;➥  <b>Ping: </b></font><b>
						        <font color="green">Low</font></b> <br><a href="?subtopic=download">➥ Download Client Baiak</a></center>
																	<br>
																</center>
																<center>
																	Welcome to Baiak.
The secret is in the details, so every detail is important, we are currently the most complete server today. 
																	<br>
																</center>																	
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<br><br>
					<table style="background-color: #d4c0a1;border: 2px solid #350404;box-shadow: 0 3px 2px 0 rgba(0,0,0,0.42),0 8px 7px 0 rgba(0,0,0,0.2)!important;" bgcolor="#D4C0A1" border="0" cellpadding="4" cellspacing="1" width="100%">
						<tbody>
							<tr>
								<td style="background-image:url(./layouts/tibiarl/images/content/title-background-green.gif);font-size: 12;text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" align="center" class="white">
									<b>Most powerful characters</b>
								</td>
							</tr>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<table border="0" cellpadding="3" cellspacing="1" width="100%">															
															<tr bgcolor="#F1E0C6">';
																$rankingFrags = $SQL->query('SELECT `p`.`name` AS `name`,p.lookbody, p.lookfeet, p.lookhead, p.looklegs, p.looktype, p.lookaddons , COUNT(`p`.`name`) as `frags` FROM `killers` k LEFT JOIN `player_killers` pk ON `k`.`id` = `pk`.`kill_id` LEFT JOIN `players` p ON `pk`.`player_id` = `p`.`id` WHERE `k`.`unjustified` = 1 GROUP BY `name` ORDER BY `frags` DESC, `name` ASC LIMIT 5')->fetchAll();
																$cont = 1;
																foreach ($rankingFrags as $member﻿)
																{
																	$news_content .= '
																	<td width="20%" align="center" style="border:1px solid #faf0d7; border-radius: 11px 10px 10px;border: 2px solid #350404;box-shadow: 0 3px 2px 0 rgba(0,0,0,0.42),0 8px 7px 0 rgba(0,0,0,0.2)!important;"">
																		<br><img style="margin-top: -40px; margin-left: -50px; position: relative;" src="/layouts/tibiarl/images/farathor/trofeus/'.$cont.'.gif" />
																		<a href="?subtopic=characters&name='.$member﻿['name'].'"><img  style="margin-top: -45px; margin-left: -40px;" src="./outfit.php?id='.$member﻿['looktype'].'&addons='.$member﻿['lookaddons'].'&head='.$member﻿['lookhead'].'&body='.$member﻿['lookbody'].'&legs='.$member﻿['looklegs'].'&feet='.$member﻿['lookfeet'].'" width="64" height="64" /></a>
																		<br>
																		<a href="?subtopic=characters&name='.$member﻿['name'].'">'.$member﻿['name'].'</a>
																		<br>  
																		<b>'.$member﻿['frags'].' ';
																			if($member﻿['frags'] <= 1)
																			{	
																				$news_content .= 'kill';
																			}
																			else
																			{
																				$news_content .= 'kills';
																			}
																		$news_content .= '</span></font>&nbsp</b>
																	</td>';
																	$cont = $cont + 1;
																}
															$news_content .= '
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<br><br>					
					<table style="background-color: #d4c0a1;border: 2px solid #350404;box-shadow: 0 3px 2px 0 rgba(0,0,0,0.42),0 8px 7px 0 rgba(0,0,0,0.2)!important;" bgcolor="#D4C0A1" border="0" cellpadding="4" cellspacing="1" width="100%"> 
						<tbody>
							<tr>
								<td style="background-image:url(./layouts/tibiarl/images/content/title-background-green.gif);font-size: 12;text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" align="center" class="white">
									<b>Most powerful guilds </b>
								</td>
							</tr>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<table border="0" cellpadding="3" cellspacing="1" width="100%">															
															<tr bgcolor="#F1E0C6">';
																foreach($SQL->query('SELECT `g`.`id` AS `id`, `g`.`name` AS `name`,`g`.`logo_gfx_name` AS `logo`, COUNT(`g`.`name`) as `frags` FROM `killers` k LEFT JOIN `player_killers` pk ON `k`.`id` = `pk`.`kill_id` LEFT JOIN `players` p ON `pk`.`player_id` = `p`.`id` LEFT JOIN `guild_ranks` gr ON `p`.`rank_id` = `gr`.`id` LEFT JOIN `guilds` g ON `gr`.`guild_id` = `g`.`id` WHERE `k`.`unjustified` = 1 AND `k`.`final_hit` = 1 GROUP BY `name` ORDER BY `frags` DESC, `name` ASC LIMIT 0, 4') as $guild)
																{
																	$news_content .= '
																	<td width="20%" align="center" style="border:1px solid #faf0d7; border-radius: 11px 10px 10px;border: 2px solid #350404;box-shadow: 0 3px 2px 0 rgba(0,0,0,0.42),0 8px 7px 0 rgba(0,0,0,0.2)!important;"">
																		<a href="?subtopic=guilds&action=show&guild=' . $guild['id'] . '"><img src="/guild_image.php?id=' . $guild['id'] . '" width="64" height="64" border="0"/><br />' . $guild['name'] . '</a><br /><b>' . $guild['frags'] . ' kills</b>
																	</td>';
																}														
															$news_content .= '
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="Border_1" style="background-image:url('.$layout_name.'/images/content/border-1.gif);"></div>
		<div class="CornerWrapper-b"><div class="Corner-bl" style="background-image:url('.$layout_name.'/images/content/corner-bl.gif);"></div></div>
		<div class="CornerWrapper-b"><div class="Corner-br" style="background-image:url('.$layout_name.'/images/content/corner-br.gif);"></div></div>
	</div>';
//FEATURED ARTICLE END
function replaceSmile($text, $smile)
{
    $smileys = array(
						':p' => 1, 
						':eek:' => 2, 
						':rolleyes:' => 3, 
						';)' => 4, 
						':o' => 5, 
						':D' => 6,  
						':(' => 7, 
						':mad:' => 8,
						':)' => 9,
						':cool:' => 10
					);
    if($smile == 1)
        return $text;
    else
    {
        foreach($smileys as $search => $replace)
            $text = str_replace($search, '<img src="layouts/tibiarl/images/forum/smile/'.$replace.'.gif" />', $text);
        return $text;
    }
}

function replaceAll($text, $smile)
{
    $rows = 0;
    while(stripos($text, '[code]') !== false && stripos($text, '[/code]') !== false )
    {
        $code = substr($text, stripos($text, '[code]')+6, stripos($text, '[/code]') - stripos($text, '[code]') - 6);
        if(!is_int($rows / 2)) { $bgcolor = 'ABED25'; } else { $bgcolor = '23ED25'; } $rows++;
        $text = str_ireplace('[code]'.$code.'[/code]', '<i>Code:</i><br /><table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #CCCCCC; border-width: 2px"><tr><td>'.$code.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[quote]') !== false && stripos($text, '[/quote]') !== false )
    {
        $quote = substr($text, stripos($text, '[quote]')+7, stripos($text, '[/quote]') - stripos($text, '[quote]') - 7);
        if(!is_int($rows / 2)) { $bgcolor = 'AAAAAA'; } else { $bgcolor = 'CCCCCC'; } $rows++;
        $text = str_ireplace('[quote]'.$quote.'[/quote]', '<table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>'.$quote.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[url]') !== false && stripos($text, '[/url]') !== false )
    {
        $url = substr($text, stripos($text, '[url]')+5, stripos($text, '[/url]') - stripos($text, '[url]') - 5);
        $text = str_ireplace('[url]'.$url.'[/url]', '<a href="'.$url.'" target="_blank">'.$url.'</a>', $text);
    }
    while(stripos($text, '[player]') !== false && stripos($text, '[/player]') !== false )
    {
        $player = substr($text, stripos($text, '[player]')+8, stripos($text, '[/player]') - stripos($text, '[player]') - 8);
        $text = str_ireplace('[player]'.$player.'[/player]', '<a href="?subtopic=&name='.urlencode($player).'">'.$player.'</a>', $text);
    }
	 while(stripos($text, '[letter]') !== false && stripos($text, '[/letter]') !== false )
    {
        $letter = substr($text, stripos($text, '[letter]')+8, stripos($text, '[/letter]') - stripos($text, '[letter]') - 8);
        $text = str_ireplace('[letter]'.$letter.'[/letter]', '<img src="images/letters/letter_martel_'.$letter.'.gif">', $text);
    }
    while(stripos($text, '[img]') !== false && stripos($text, '[/img]') !== false )
    {
        $img = substr($text, stripos($text, '[img]')+5, stripos($text, '[/img]') - stripos($text, '[img]') - 5);
        $text = str_ireplace('[img]'.$img.'[/img]', '<img src="'.$img.'">', $text);
    }
    while(stripos($text, '[b]') !== false && stripos($text, '[/b]') !== false )
    {
        $b = substr($text, stripos($text, '[b]')+3, stripos($text, '[/b]') - stripos($text, '[b]') - 3);
        $text = str_ireplace('[b]'.$b.'[/b]', '<b>'.$b.'</b>', $text);
    }
    while(stripos($text, '[i]') !== false && stripos($text, '[/i]') !== false )
    {
        $i = substr($text, stripos($text, '[i]')+3, stripos($text, '[/i]') - stripos($text, '[i]') - 3);
        $text = str_ireplace('[i]'.$i.'[/i]', '<i>'.$i.'</i>', $text);
    }
    while(stripos($text, '[u]') !== false && stripos($text, '[/u]') !== false )
    {
        $u = substr($text, stripos($text, '[u]')+3, stripos($text, '[/u]') - stripos($text, '[u]') - 3);
        $text = str_ireplace('[u]'.$u.'[/u]', '<u>'.$u.'</u>', $text);
    }
    return replaceSmile($text, $smile);
}

function showPost($topic, $text, $smile)
{
    $text = nl2br($text);
    $post = '';
    if(!empty($topic))
        $post .= '<b>'.replaceSmile($topic, $smile).'</b>';
    $post .= replaceAll($text, $smile);
    return $post;
}

if($group_id_of_acc_logged >= $config['site']['access_admin_panel'] && $action != 'newnews')
	{
		$main_content .= '
			<font style="font-size: 16px; font-weight: bold; margin-left: 20px;">Adding News</font>
			<form action="index.php?subtopic=latestnews&action=newnews" method="post" >
				<table border="0">
					<tr>
						<td bgcolor="D4C0A1" align="center"><b>Select icon:</b></td>
						<td>
							<table border="0">
								<tr bgcolor="F1E0C6">
									<td><img src="'.$layout_name.'/images/news/icon_0.gif" width="20"></td>
									<td><img src="'.$layout_name.'/images/news/icon_1.gif" width="20"></td>
									<td><img src="'.$layout_name.'/images/news/icon_2.gif" width="20"></td>
									<td><img src="'.$layout_name.'/images/news/icon_3.gif" width="20"></td>
									<td><img src="'.$layout_name.'/images/news/icon_4.gif" width="20"></td>
								</tr>
								<tr bgcolor="D4C0A1">
									<td><input type="radio" name="icon_id" value="0" checked="checked"></td>
									<td><input type="radio" name="icon_id" value="1" /></td>
									<td><input type="radio" name="icon_id" value="2" /></td>
									<td><input type="radio" name="icon_id" value="3" /></td>
									<td><input type="radio" name="icon_id" value="4" /></td>
								</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td align="center" bgcolor="F1E0C6"><b>Topic:</b></td>
					<td><input type="text" name="topic" maxlenght="50" style="width: 300px" ></td>
				</tr>
				<tr>
					<td align="center" bgcolor="D4C0A1"><b>News<br>text:</b></td>';
				//Tiny Editor
				$main_content .= '
					<script type="text/javascript" src="'.$layout_name.'/tiny_mce/tiny_mce.js"></script>
					<script type="text/javascript">
						tinyMCE.init({
							// General options
							mode : "textareas",
							theme : "advanced",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
					
							// Theme options
							theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
							theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl",
							theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
					
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Style formats
							style_formats : [
								{title : \'Bold text\', inline : \'b\'},
								{title : \'Red text\', inline : \'span\', styles : {color : \'#ff0000\'}},
								{title : \'Red header\', block : \'h1\', styles : {color : \'#ff0000\'}},
								{title : \'Example 1\', inline : \'span\', classes : \'example1\'},
								{title : \'Example 2\', inline : \'span\', classes : \'example2\'},
								{title : \'Table styles\'},
								{title : \'Table row 1\', selector : \'tr\', classes : \'tablerow1\'}
							],
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
						});
					</script>';
				$main_content .= '
					<td bgcolor="F1E0C6">
						<textarea name="text" id="elm1" rows="6" cols="60"></textarea>
					</td>
				</tr>
				<tr>
					<td width="180"><b>Character:</b></td>
					<td>
						<select name="char_id">
						   <option value="0">(Choose character)</option>';
							foreach($account_logged->getPlayers() as $player)
							{
							 $main_content .= '<option value="'.$player->getID().'">'.$player->getName().'</option>';
							}       
							$main_content .= '       
						  </select>
					</td>
				</tr>
				<tr>
					<td>
						<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" >
					</div>
				</div>
			</form>
		</td>
	</tr>
</table>
<hr/>';
}


    $last_threads = $SQL->query('SELECT ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_text') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_topic') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('icon_id') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_smile') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('id') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('replies') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_date') . ' FROM ' . $SQL->tableName('players') . ', ' . $SQL->tableName('z_forum') . ' WHERE ' . $SQL->tableName('players') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('author_guid') . ' AND ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('section') . ' = 1 AND ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('first_post') . ' = ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('id') . ' ORDER BY ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('last_post') . ' DESC LIMIT ' . $config['site']['news_limit'])->fetchAll();
	
	//Here start news
    if(isset($last_threads[0]))
    {
        foreach($last_threads as $thread)
        {
            $main_content .= '
				<div class="NewsHeadline">
					<div class="NewsHeadlineBackground" style="background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)">
						<img src="'.$layout_name.'/images/news/icons/newsicon_'.$thread['icon_id'].'.gif" class="NewsHeadlineIcon" alt=\'\' />
						<div class="NewsHeadlineDate">'.date('M m Y', $thread['post_date']).' -</div>
    					<div class="NewsHeadlineText">'.htmlspecialchars($thread['post_topic']).'</div>
					</div>
				</div>
				<table style=\'clear:both\' border=0 cellpadding=0 cellspacing=0 width=\'100%\'>
				<tr>';
            $main_content .= '
				<td style=\'padding-left:10px;padding-right:10px;\' >' . showPost('', $thread['post_text'], $thread['post_smile']) . '<br><p align="right"><a href="?subtopic=forum&action=show_thread&id=' . $thread['id'] . '">» Comment on this news</a></p></td>';
        
			$main_content .= '
				<td>
					<img src="'.$layout_name.'/images/global/general/blank.gif" width=10 height=1 border=0 alt=\'\' />
				</td>
			</tr>
		</table><br />';
		}
    }
    else
        $main_content .= '<h3>No news. Go forum and make new thread on board News.</h3>';
