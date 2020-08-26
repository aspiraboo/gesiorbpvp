<?php
if(!defined('INITIALIZED'))
	exit;

$main_content = "<h1 align=\"center\">Guild Wars</h1>
			<div class=\"BoxContent\" style=\"background-image:url(".$layout_name."/images/content/scroll.gif);\">
				<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" id=\"information\";>
					<tr style=\"background: #505050;\"><td align=\"center\" class=\"white\"><b>Command</b></td><td colspan=\"2\" align=\"center\" class=\"white\"><b>Description</b></td></tr>
					<tr style=\"background: #F1E0C6;\"><td><b>/war invite, <font color=\"#871224\">GuildName</font>, fraglimit</b></td><td>Sends an invitation to start the war. Example: <font color=red><BR>/war invite, Chickens, 150<BR></font><B>(Invite a guild to war with 150 frags count.)</B></td></tr>
					<tr style=\"background: #D4C0A1;\"><td><b>/war invite, <font color=\"#871224\">GuildName</font>, fraglimit, money</b></td><td>Send the invitation to start the war. Example: <font color=red><BR>/war invite, Chickens, 150, 10000</font><br><B> (Invite a guild to war with 150 frags count and payment of 10000 gold coins <- you need donate to guild to use it.)<B></td></tr>
					<tr style=\"background: #F1E0C6;\"><td><b>/war accept, <font color=\"#871224\">GuildName</font></b></td><td>Accepts the invitation to start a war. Example: <font color=red><BR>/war accept, Chickens</font><BR><B>(Accept the war against guild \"Chickens\".)</b></td></tr>
					<tr style=\"background: #D4C0A1;\"><td><b>/war reject, <font color=\"#871224\">GuildName</font></b></td><td>Rejects the invitation to start a war. Example: <font color=red><BR>/war reject, Chickens</font><BR><B>(Reject a invitation to war from Chickens.)</B></td></tr>
					<tr style=\"background: #F1E0C6;\"><td><b>/war end, <font color=\"#871224\">GuildName</font></b></td><td>Cancels the invitation. Example: <font color=red><BR>/war cancel, Chickens</font><br><b>(Cancel my guild invitation to war with Chickens.)</b></td></tr>
					<tr style=\"background: #D4C0A1;\"><td><b>/guild balance</b></td><td>See the guild balance - balance of money.</td></tr>
					<tr style=\"background: #F1E0C6;\"><td><b>/guild balance donate value</b></td><td>Deposits money on the guild's bank account. All players can donate. Example: <font color=red><BR>/guild balance donate 100000 </font><BR><B>(You will donate 100k to your guild balance.)</B></td></tr>
					<tr style=\"background: #D4C0A1;\"><td><b>/guild balance pick value</b></td><td>Withdraws money from the guild's bank account. Can be used only by the guild leader. Example: <font color=red><BR>/guild balance pick 100000 </font><BR><B>(You will withdraw 100k from your guild balance.)</B></td></tr>
				</table>
			</div>
		</br>
	</br>
<br>
<script type=\"text/javascript\"><!--
function show_hide(flip)
{
        var tmp = document.getElementById(flip);
        if(tmp)
                tmp.style.display = tmp.style.display == 'none' ? '' : 'none';
}
--></script>
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
<tr>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\" width=\"150\"><b>Aggressor</b></td>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\"><b>Information</b></td>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\" width=\"150\"><b>Enemy</b></td>
</tr>";
 
$count = 0;
foreach($SQL->query('SELECT * FROM ' . $SQL->tableName('guild_wars') . ' WHERE ' . $SQL->fieldName('status') . ' IN (1,4) OR ((' . $SQL->fieldName('end') . ' >= (UNIX_TIMESTAMP() - 604800) OR ' . $SQL->fieldName('end') . ' = 0) AND ' . $SQL->fieldName('status') . ' IN (0,5));') as $war)
{
        $a = new Guild();
        $a->load($war['guild_id']);
        if(!$a->isLoaded())
                continue;
 
        $e = new Guild();
        $e->load($war['enemy_id']);
        if(!$e->isLoaded())
                continue;
 
        $count++;
        $main_content .= "<tr style=\"background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$a->getId()."\"><img src=\"" . $a->getGuildLogoLink() . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($a->getName())."</a></td>
<td class=\"white\" align=\"center\">";
        switch($war['status'])
        {
                case 0:
                {
                        $main_content .= "<font color=black><b>Pending acceptation</b><br />Invited on " . date("M d Y, H:i:s", $war['begin']) . " for " . ($war['end'] > 0 ? (($war['end'] - $war['begin']) / 86400) :"unspecified") . " days. The frag limit is set to " . $war['frags'] . " frags, " . ($war['payment'] > 0 ? "with payment of " . $war['payment'] . " bronze coins." :"without any payment.")."<br />Will expire in three days.</font>";
                        break;
                }
 
                case 3:
                {
                        $main_content .= "<s>Canceled invitation</s><br />Sent invite on " . date("M d Y, H:i:s", $war['begin']) . ", canceled on " . date("M d Y, H:i:s", $war['end']) . ".";
                        break;
                }
 
                case 2:
                {
                        $main_content .= "Rejected invitation<br />Invited on " . date("M d Y, H:i:s", $war['begin']) . ", rejected on " . date("M d Y, H:i:s", $war['end']) . ".";
                        break;
                }
 
                case 1:
                {
                        $main_content .= "<font size=\"12\"><span style=\"color: red;\">" . $war['guild_kills'] . "</span><font color=black> : </font><span style=\"color: lime;\">" . $war['enemy_kills'] . "</span></font><br /><br /><span style=\"color: darkred; font-weight: bold;\">On a brutal war</span><br /><font color=black>Began on " . date("M d Y, H:i:s", $war['begin']) . ($war['end'] > 0 ? ", will end up at " . date("M d Y, H:i:s", $war['end']) :"") . ".<br />The frag limit is set to " . $war['frags'] . " frags, " . ($war['payment'] > 0 ? "with payment of " . $war['payment'] . " bronze coins." :"without any payment.</font>");
                        break;
                }
 
                case 4:
                {
                        $main_content .= "<font size=\"12\"><span style=\"color: red;\">" . $war['guild_kills'] . "</span> : <span style=\"color: lime;\">" . $war['enemy_kills'] . "</span></font><br /><br /><span style=\"color: darkred;\">Pending end</span><br />Began on " . date("M d Y, H:i:s", $war['begin']) . ", signed armstice on " . date("M d Y, H:i:s", $war['end']) . ".<br />Will expire after reaching " . $war['frags'] . " frags. ".($war['payment'] > 0 ? "The payment is set to " . $war['payment'] . " bronze coins." :"There's no payment set.");
                        break;
                }
 
                case 5:
                {
                        $main_content .= "<i>Ended</i><br />Began on " . date("M d Y, H:i:s", $war['begin']) . ", ended on " . date("M d Y, H:i:s", $war['end']) . ". Frag statistics: <span style=\"color: red;\">" . $war['guild_kills'] . "</span> to <span style=\"color: lime;\">" . $war['enemy_kills'] . "</span>.";
                        break;
                }
 
                default:
                {
                        $main_content .= "Unknown, please contact with gamemaster.";
                        break;
                }
        }
 
        $main_content .= "<br /><br /><a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">&raquo; Details &laquo;</a></td>
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$e->getId()."\"><img src=\"" . $a->getGuildLogoLink() . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($e->getName())."</a></td>
</tr>
<tr id=\"war-details:" . $war['id'] . "\" style=\"display: none; background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
<td colspan=\"3\">";
        if(in_array($war['status'], array(1,4,5)))
        {
                $deaths = $SQL->query('SELECT ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('id') . ', ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('date') . ', ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('guild_id') . ' AS ' . $SQL->fieldName('enemy') . ', ' . $SQL->tableName('p') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('level') . ' FROM ' . $SQL->tableName('guild_kills') . ' gk LEFT JOIN ' . $SQL->tableName('player_deaths') . ' pd ON ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('death_id') . ' = ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('id') . ' LEFT JOIN ' . $SQL->tableName('players') . ' p ON ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('player_id') . ' = ' . $SQL->tableName('p') . '.' . $SQL->fieldName('id') . ' WHERE ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('war_id') . ' = ' . $SQL->quote($war['id']) . ' AND ' . $SQL->tableName('p') . '.' . $SQL->fieldName('deleted') . ' = 0 ORDER BY ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('date') . ' DESC')->fetchAll();
                if(!empty($deaths))
                {
                        foreach($deaths as $death)
                        {
                                $killers = $SQL->query('SELECT ' . $SQL->tableName('p') . '.' . $SQL->fieldName('name') . ' AS ' . $SQL->fieldName('player_name') . ', ' . $SQL->tableName('p') . '.' . $SQL->fieldName('deleted') . ' AS ' . $SQL->fieldName('player_exists') . ', ' . $SQL->fieldName('k') . '.' . $SQL->fieldName('war') . ' AS ' . $SQL->fieldName('is_war') . ' FROM ' . $SQL->fieldName('killers') . ' k LEFT JOIN ' . $SQL->tableName('player_killers') . ' pk ON ' . $SQL->tableName('k') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('pk') . '.' . $SQL->fieldName('kill_id') . ' LEFT JOIN ' . $SQL->tableName('players') . ' p ON ' . $SQL->tableName('p') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('pk') . '.' . $SQL->fieldName('player_id') . ' WHERE ' . $SQL->tableName('k') . '.' . $SQL->fieldName('death_id') . ' = ' . $SQL->quote($death['id']) . ' ORDER BY ' . $SQL->tableName('k') . '.' . $SQL->fieldName('final_hit') . ' DESC, ' . $SQL->tableName('k') . '.' . $SQL->fieldName('id') . ' ASC')->fetchAll();
                                $count = count($killers); $i = 0;
 
                                $others = false;
                                $main_content .= date("j M Y, H:i", $death['date']) . " <span style=\"font-weight: bold; color: " . ($death['enemy'] == $war['guild_id'] ? "red" :"lime") . ";\">+</span>
<a href=\"?subtopic=characters&name=" . urlencode($death['name']) . "\"><b>".htmlspecialchars($death['name'])."</b></a> ";
                                foreach($killers as $killer)
                                {
                                        $i++;
                                        if($killer['is_war'] != 0)
                                        {
                                                if($i == 1)
                                                        $main_content .= "killed at level <b>".$death['level']."</b> by ";
                                                else if($i == $count && $others == false)
                                                        $main_content .= " and by ";
                                                else
                                                        $main_content .= ", ";
 
                                                if($killer['player_exists'] == 0)
                                                        $main_content .= "<a href=\"?subtopic=characters&name=".urlencode($killer['player_name'])."\">";
 
                                                $main_content .= htmlspecialchars($killer['player_name']);
                                                if($killer['player_exists'] == 0)
                                                        $main_content .= "</a>";
                                        }
                                        else
                                                $others = true;
 
                                        if($i == $count)
                                        {
                                            if($others == true)
                                                $main_content .= " and few others";
                                            $main_content .= ".<br />";
                                        }
                                }
                        }
                }
                else
                        $main_content .= "<center>There were no frags on this war so far.</center>";
        }
        else
                $main_content .= "<center>This war did not began yet.</center>";
 
        $main_content .= "</td>
</tr>";
}
 
if($count == 0)
        $main_content .= "<tr style=\"background:".$config['site']['darkborder'].";\">
<td colspan=\"3\">Currently there are no active wars.</td>
</tr>";
 
$main_content .= "</table>";