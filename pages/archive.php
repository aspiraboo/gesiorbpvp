<?php
if(!defined('INITIALIZED'))
	exit;
if ($action == ""){
$news_DB = $SQL->query("SELECT * FROM `z_forum` WHERE `section` = '1' AND `z_forum`.`id` = `first_post` ORDER BY `post_date` DESC LIMIT 25");
if(empty($_REQUEST['view']))
{	$main_content .= '
	<table border="0" cellspacing="1" cellpadding="7" width="100%">
		<tr bgcolor="'.$config['site']['vdarkborder'].'">
			<td class="white"><center>&#160;</center></td>
			<td class="white" width="70%"><b>Title</b></td>
			<td class="white"><b>Date</b></td>
		</tr>';
	foreach($news_DB as $news)
	{
		if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<tr BGCOLOR='.$bgcolor.'><td width="4%"><center><img src="'.$layout_name.'/images/news/newsicon_'.$news['icon_id'].'.gif"></center></td>
			<td><b>&#160;<a href="index.php?subtopic=archive&view='.$news['id'].'">'.stripslashes($news['post_topic']).'</a></b></td>
			<td>'.date("d/m/Y, H:m:s", $news['post_date']);
			if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) { 
			$main_content .='<br />[<a href="index.php?subtopic=forum&action=remove_post&id='.$news['id'].'"><font color="red">Deletar Noticia</font></a>]'; 
			}
	}
	$main_content .= '</small></td></tr></table>';
	$showed=true;
}
foreach($news_DB as $news)
if($_REQUEST['view'] == $news['id']){
$BB = array(
'/\[youtube\](.*?)\[\/youtube\]/is' => '<center><object width="500" height="405"><param name="movie" value="http://www.youtube.com/v/$1&hl=pt-br&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999&border=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$1&hl=pt-br&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="500" height="405"></embed></object></center>',
'/\[b\](.*?)\[\/b\]/is' => '<strong>$1</strong>',
'/\[center\](.*?)\[\/center\]/is' => '<center>$1</center>',
'/\[quote\](.*?)\[\/quote\]/is' => '<table cellpadding="0" style="background-color: #c4c4c4; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>$1</td></tr></table>',
'/\[u\](.*?)\[\/u\]/is' => '<u>$1</u>',
'/\[i\](.*?)\[\/i\]/is' => '<i>$1</i>',
'/\[letter\](.*?)\[\/letter\]/is' => '<img src=images/letters/$1.gif alt=$1 />',
'/\[url](.*?)\[\/url\]/is' => '<a href=$1>$1</a>',
'/\[color\=(.*?)\](.*?)\[\/color\]/is' => '<span style="color: $1;">$2</span>',
'/\[img\](.*?)\[\/img\]/is' => '<img src=$1 alt=$1 />',
'/\[player\](.*?)\[\/player\]/is' => '<a href='.$server['ip'].'index.php?subtopic=characters&amp;name=$1>$1</a>',
'/\[code\](.*?)\[\/code\]/is' => '<div dir="ltr" style="margin: 0px;padding: 2px;border: 1px inset;width: 500px;height: 290px;text-align: left;overflow: auto"><code style="white-space:nowrap">$1</code></div>'
);
$message = preg_replace(array_keys($BB), array_values($BB), nl2br($news['post_text']));
$main_content .= '
<div class="NewsHeadline">
<div class="NewsHeadlineBackground" style="background-image:url('.$layout_name.'/images/news/newsheadline_background.gif)">
<img src="'.$layout_name.'/images/news/newsicon_'.$news['icon_id'].'.gif" class="NewsHeadlineIcon" />
<div class="NewsHeadlineDate">'.date("d/m/Y", $news['post_date']).' - </div>
<div class="NewsHeadlineText">'.stripslashes($news['post_topic']).'</div>
</div>
</div>
<table style="clear:both" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="'.$layout_name.'/images/global/general/blank.gif" width="10" height="1" border="0" alt="" /></td>
<td width="100%"><font size="2">'.stripslashes(nl2br($message)).'<br /></font><br></td>
<td><img src="'.$layout_name.'/images/global/general/blank.gif" width="10" height="1" border="0" alt="" /></td>
</tr>
</table>';
$main_content .= '<br /><form action="index.php?subtopic=archive" method="post">
<input type="image" src="'.$layout_name.'/images/buttons/sbutton_back.gif"name="Back" id="Back">
</form>';
$showed=true;
}
if(!$showed){
$main_content .= '<div class="notice"><b>T</b>his news doeasn\'t exist.</div><br />';
$main_content .= '<form action="index.php?subtopic=archive" method="post">
<input type="image" src="'.$layout_name.'/images/buttons/sbutton_back.gif"name="Back" id="Back">
</form>';
}
if(empty($news))
$main_content .= '
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="7" WIDTH="100%">
<TR BGCOLOR='.$config['site']['darkborder'].'><TD align="center"><i>News archive is empty.</i></TD></TR>
</TABLE>';}
if ($action == "tickets"){
$main_content .='
<form action="index.php?subtopic=archive&action=tickett" method="post">
      <table border=0 cellspacing=1 cellpadding=4 width="100%">
        <tr bgcolor=#505050><td colspan=4 class=white><b>News Archive Search</b></td></tr>
        <tr bgcolor=#D4C0A1 valign=middle align=center>
          <td width=10%><b>Type</b></td>
          <td width=30%><b>Category</b></td>
        </tr>
        <tr bgcolor=#D4C0A1 valign=middle align=center >         
          <td nowrap=nowrap>
            <div align=left>
              <input type="checkbox" name="ticker" value="ticker" checked/>News Ticker<br />
              <input type="checkbox" name="article" value="article" checked/>Featured Article<br />
              <input type="checkbox" name="news" value="news" checked/>News<br />
            </div>
          </td>
          <td nowrap=nowrap valign=middle >
            <div align=left >
              <table cellspacing=1 cellpadding=0 border=0 align=left>
              <tr><td nowrap=nowrap valign=middle><input style="position: relative; top: -1px;" type="checkbox" name="2" value="2" checked/><img style="position: relative; top: 1px;" src="'.$layout_name.'/images/news/icon_2.gif" /></td><td nowrap=nowrap valign=middle>CipSoft</td></tr>
              <tr><td nowrap=nowrap valign=middle><input style="position: relative; top: -1px;" type="checkbox" name="4" value="4" checked/><img style="position: relative; top: 1px;" src="'.$layout_name.'/images/news/icon_4.gif" /></td><td nowrap=nowrap valign=middle>Community</td></tr>
              <tr><td nowrap=nowrap valign=middle><input style="position: relative; top: -1px;" type="checkbox" name="3" value="3" checked/><img style="position: relative; top: 1px;" src="'.$layout_name.'/images/news/icon_3.gif" /></td><td nowrap=nowrap valign=middle>Development</td></tr>
              <tr><td nowrap=nowrap valign=middle><input style="position: relative; top: -1px;" type="checkbox" name="0" value="0" checked/><img style="position: relative; top: 1px;" src="'.$layout_name.'/images/news/icon_0.gif" /></td><td nowrap=nowrap valign=middle>Support</td></tr>
              <tr><td nowrap=nowrap valign=middle><input style="position: relative; top: -1px;" type="checkbox" name="1" value="1" checked/><img style="position: relative; top: 1px;" src="'.$layout_name.'/images/news/icon_1.gif" /></td><td nowrap=nowrap valign=middle>Technical Issues</td></tr>
              </table>
            </div>
          </td>
        </tr>
      </table><br />
      <center><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><TR><TD>
<INPUT TYPE=image NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18>
</TD></TR></FORM></TABLE>
</center>
';
}
if ($action == "tickett"){
$qry_tickets = $SQL->query("SELECT * FROM z_news_tickers ORDER BY `date` DESC LIMIT 25");
	foreach($qry_tickets as $row)
	{
		if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<tr BGCOLOR='.$bgcolor.'><td width="4%"><center><img src="'.$layout_name.'/images/news/icon_'.$row['image_id'].'_big.gif"></center></td>
			<td>'.stripslashes($row['text']).'<br /><br /><small><b>Post Date:&nbsp;'.date("d/m/Y, H:m:s", $row['date']).'</b></small></td>';
	}
	$main_content .= '</tr>
</table>';
}
?>