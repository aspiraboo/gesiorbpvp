<?php
$time = time();

$main_content .= '
<br><br><div style="text-align: center;"><span style="color:black;text-shadow: black 1px 1px 10px;"><font size=5.5><span style="background: transparent url(/layouts/tibiarl/images/menu/bg_menu.gif)"><img src="/images/items/2159.gif" border="0">&nbsp;&nbsp;Ranking de mineração Baiak&nbsp;&nbsp;<img src="/images/items/2159.gif" border="0"></font></div></br><br><br>
<center><table border="1px" bordercolor="black" cellspacing="1" cellpadding="4" width="60%">
	<tr bgcolor="' . $config['site']['vdarkborder'] . '">
		<td class="white" style="text-align: center; font-weight: bold;">Name</td>
		<td class="white" style="text-align: center; font-weight: bold;">Level</td>
		<td class="white" style="text-align: center; font-weight: bold;">Experience</td>
	</tr></center>';

$i = 0;
foreach($SQL->query('SELECT `p`.`name` AS `name`, lvl as `lvl`, exp as experience
	FROM `top_mining` k
	LEFT JOIN `players` p ON `k`.`player_id` = `p`.`id`
WHERE `k`.`lvl` > 0
	GROUP BY `name`
	ORDER BY experience DESC, `name` ASC
	LIMIT 0,30;') as $player)
{
	$i++;
	$main_content .= '<tr bgcolor="' . (is_int($i / 2) ? $config['site']['lightborder'] : $config['site']['darkborder']) . '">
		<td style="text-align: center;"><a href="?subtopic=characters&name=' . urlencode($player['name']) . '">' . $player['name'] . '</a></td>
		<td style="text-align: center;">' . $player['lvl'] . '</td>
		<td style="text-align: center;"><b>' . $player['experience'] . '</b></td>
	</tr>';
}
$main_content .= '</table>';
?>

