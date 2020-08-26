<?php
date_default_timezone_set('America/Araguaina');
$cache_sec = 10;
$info = array(
    0 => array('Mexico', '04/03/2014')
);
 
$id=0;
$text1 = '
<p>Currently This Server is the only with a unique system of broadcasting game in the current time. System is based on an official TibiaCast.</p>
<p>You can enter a live stream by login into the game without entering any account number and password. Just don\'t write anything in those 2 fields and just press enter. A list of all available casts will appear shortly and you choose the one you would like to watch. After login into the cast, you can talk with other audiences and a person that is broadcasting.</p>
<p>To make your own broadcast, you must login to your account and use a command <strong>/cast on</strong>. </p>
<p>Full command list can be found below.</p>
';
$text2 = '
<p><strong>Currently available commands for spectators:</strong><br />
/show - display the amount of currently active spectators<br />
/name - change your name on chat with player and other spectators<br />
/auth - authenticate to an exisiting cast (required with chat proctetion)</p>
 
<p><strong>Available commands for streaming players:</strong><br />
/cast on - enables the stream<br />
/cast off - disables the stream<br />
/cast password {password} - sets a password on the stream<br />
/cast password off - disables the password protection<br />
/cast auth on - enables requirement of authentication on chat<br />
/cast auth off - disables requirement of authentication on chat<br />
/cast kick {name} - kick a spectator from your stream<br />
/cast ban {name} - locks spectator IP from joining your stream<br />
/cast unban {name} - removes banishment lock<br />
/cast bans - shows banished spectators list<br /><br />
/cast mute {name} - mutes selected spectator from chat<br />
/cast unmute {name} - removes mute<br />
/cast mutes - shows muted spectators list<br />
/cast show - displays the amount and nicknames of current spectators<br />
/cast status - displays stream status</p>
';
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
 
if(count($config['site']['worlds']) > 1) {
    $main_content =
'<form action="?subtopic=whoislive" method="post">
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
'<div class="TableContainer">
    <table class="Table1" cellpadding="0" cellspacing="0">
        <div class="CaptionContainer">
            <div class="CaptionInnerContainer">
                <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
                <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
                <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
                <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
                <div class="Text">World Information</div>
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
                            <td class="LabelV150">Status:</td>
                            	<td><b><font color="green">Online</font></b></td>
                        </tr>
                        <tr>
                            <td class="LabelV150">Players Casting:</td>
                            <td>';
$f = 'cache/whoislive-'.$_POST['world'].'-'.$order.'.tmp';
if(file_exists($f) && filemtime($f) > (time() - $cache_sec)) {
    $cp = file_get_contents($f);
}
else {
    $cp = '';
    $n = 0;
    $q = 'SELECT name,level,vocation,promotion,viewers, looktype, lookbody, looklegs, lookhead, lookfeet, lookaddons FROM players WHERE world_id='.$id.' AND broadcasting=1';
    if(in_array($order, array('name_asc','name_desc','level_asc','level_desc')))
        $q .= ' ORDER BY '.str_replace('_', ' ', $order);
 
    if(in_array($order, array('vocation_asc','vocation_desc'))) {
        $a = array();
        $q .= ' ORDER BY level desc';
        foreach($SQL->query($q)->fetchAll() as $p)
            $a[] = array($p['name'], $p['level'], $vocation_name[$p['promotion']][$p['vocation']], $p['looktype'], $p['lookhead'], $p['lookbody'], $p['looklegs'], $p['lookfeet'], $p['lookaddons'], $p['viewers']);
        function cmp($a, $b) {
            return $a[2][0] == $b[2][0] ? 0 :
                $GLOBALS['order'] == 'vocation_asc'
                    ? ($a[2][0] < $b[2][0] ? -1 : 1)
                    : ($a[2][0] > $b[2][0] ? -1 : 1);
        }
        usort($a, 'cmp');
        foreach($a as $p) {
            $n++;
            $cp .= '<tr class="'.(is_int($n/2)?'Even':'Odd').'" style="text-align:right"><td><img src="'.$base_link.'/outfit.php?id='.$p[3].'&addons='.$p[8].'&head='.$p[4].'&body='.$p[5].'&legs='.$p[6].'&feet='.$p[7].'" width="64" height="64"/></td><td style="width:70%;text-align:left"><a href="?subtopic=characters&name='.urlencode($p[0]).'">'.$p[0].'</a></td><td style="width:10%">'.$p[1].'</td><td style="width:20%">'.$p[2].'</td><td>'.$p[9].'/50</td></tr>';
        }
    }
    else {
        $l = array();
        foreach($SQL->query($q)->fetchAll() as $p) {
            $n++;
            $cp .= '<tr class="'.(is_int($n/2)?'Even':'Odd').'" style="text-align:right"><td><img src="'.$base_link.'/outfit.php?id='.$p['looktype'].'&addons='.$p['lookaddons'].'&head='.$p['lookhead'].'&body='.$p['lookbody'].'&legs='.$p['looklegs'].'&feet='.$p['lookfeet'].'" width="64" height="64"/></td><td style="width:70%;text-align:left">';
            if($order == 'name_asc') {
                $tmp = strtoupper($p['name'][0]);
                if(!in_array($tmp, $l)) {
                    $l[] = $tmp;
                    $cp .= '<a name="'.$tmp.'"></a>';
                }
            }
            $cp .= '<a href="?subtopic=characters&name='.urlencode($p['name']).'">'.$p['name'].'</a></td><td style="width:10%">'.$p['level'].'</td><td style="width:20%">'.$vocation_name[$p['promotion']][$p['vocation']].'</td><td>'.$p['viewers'].'/50</td></tr>';
        }
    }
    file_put_contents($f, $cp);
}
$main_content .= $n.'</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div><br/>
'.$text1.'
    <div class="TableContainer">
        <table class="Table2" cellpadding="0" cellspacing="0">  <div class="CaptionContainer">   <div class="CaptionInnerContainer">    <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    <div class="Text">Players Casting';
if($order == 'name_asc')
    $main_content .= '<span class="TableHeadlineNavigation"> [ <a href="#A">A</a> <a href="#B">B</a> <a href="#C">C</a> <a href="#D">D</a> <a href="#E">E</a> <a href="#F">F</a> <a href="#G">G</a> <a href="#H">H</a> <a href="#I">I</a> <a href="#J">J</a> <a href="#K">K</a> <a href="#L">L</a> <a href="#M">M</a> <a href="#N">N</a> <a href="#O">O</a> <a href="#P">P</a> <a href="#Q">Q</a> <a href="#R">R</a> <a href="#S">S</a> <a href="#T">T</a> <a href="#U">U</a> <a href="#V">V</a> <a href="#W">W</a> <a href="#X">X</a> <a href="#Y">Y</a> <a href="#Z">Z</a> ]</span>';
$main_content .= '</div>    <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>   </div>  </div>  <tr>   <td>    <div class="InnerTableContainer">     <table width="100%"><tr class="LabelH"><td>Outfit</td><td style="text-align:left;width:90%">Name<small style="font-weight:normal">[<a href="?subtopic=whoislive&world='.$_POST['world'].'&order=name_'.($order == 'name_asc' ? 'desc' : 'asc').'">sort</a>]</small> <img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'name_asc' ? 'content/order_desc' : ($order == 'name_desc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td><td>Level<small style="font-weight:normal">[<a href="?subtopic=whoislive&world='.$_POST['world'].'&order=level_'.($order == 'level_asc' ? 'desc' : 'asc').'">sort</a>]</small> <img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'level_asc' ? 'content/order_desc' : ($order == 'level_desc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td><td>Vocation<small style="font-weight:normal">[<a href="?subtopic=whoislive&world='.$_POST['world'].'&order=vocation_'.($order == 'vocation_asc' ? 'desc' : 'asc').'">sort</a>]</small> <img class="sortarrow" src="'.$layout_name.'/images/'.($order == 'vocation_asc' ? 'content/order_desc' : ($order == 'vocation_desc' ? 'content/order_asc' : 'news/blank')).'.gif"/></td><td>Spectators</td></tr>'.(strlen($cp) ? $cp : '<tr><td colspan="4" class="Even">There are no players streaming right now.</td></tr>').'     </table>    </div> </table></div></td></tr>'.$text2.'<br/><form action="?subtopic=characters" method="post"><div class="TableContainer"> <table class="Table1" cellpadding="0" cellspacing="0">  <div class="CaptionContainer">   <div class="CaptionInnerContainer">    <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    <div class="Text">Search Character</div>    <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>   </div>  </div>  <tr>   <td>    <div class="InnerTableContainer">     <table width="100%"><tr><td style="vertical-align:middle" class="LabelV150">Character Name:</td><td style="width:170px"><input style="width:165px" name="name" value="" size="29" maxlength="29"/></td><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td></tr>     </table>    </div> </table></div></td></tr></form></center>';
?>
