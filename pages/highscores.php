<style>
.page{display:inline-block;padding:2px 9px;margin-right:2px;border-radius:3px;border:1px solid silver;background:#e9e9e9;box-shadow:inset 0 1px 0 rgba(255,255,255,.8),0 1px 3px rgba(0,0,0,.1);font-size:.875em;font-weight:700;text-decoration:none;color:#717171;text-shadow:0 1px 0 rgba(255,255,255,1)}.page.gradient:hover,.page:hover{color:#fff;text-decoration:none;background:#fefefe;background:-webkit-gradient(linear,0 0,0 100%,from(#FEFEFE),to(#f0f0f0));background:-moz-linear-gradient(0% 0 270deg,#FEFEFE,#f0f0f0)}.pagination.dark{background:#414449;color:#feffff}.page.dark{border:1px solid #32373b;background:#3e4347;box-shadow:inset 0 1px 1px rgba(255,255,255,.1),0 1px 3px rgba(0,0,0,.1);color:#feffff;text-shadow:0 1px 0 rgba(0,0,0,.5)}.page.dark.gradient:hover,.page.dark:hover{background:#3d4f5d;background:-webkit-gradient(linear,0 0,0 100%,from(#547085),to(#3d4f5d));background:-moz-linear-gradient(0% 0 270deg,#547085,#3d4f5d)}.page.dark.active{color:#fff;text-decoration:none;border-radius:3px;border:1px solid silver;background:#2f3237;box-shadow:inset 0 0 8px rgba(0,0,0,.5),0 1px 0 rgba(255,255,255,.1)}.page.dark.gradient{background:-webkit-gradient(linear,0 0,0 100%,from(#565b5f),to(#3e4347));background:-moz-linear-gradient(0% 0 270deg,#565b5f,#3e4347)}.page.dark.disabled{background:-webkit-gradient(linear,0 0,0 100%,from(#36393B),to(#282A2B));background:-moz-linear-gradient(0% 0 270deg,#36393B,#282A2B);color:#CCC}a.skillTooltips{border:none;cursor:help}a.skillTooltips img{border:none}a.skillTooltips span{visibility:hidden;display:none}a.skillTooltips:hover{position:relative;text-decoration:none}a:hover.skillTooltips span{border-radius:3px 3px;-moz-border-radius:3px;-webkit-border-radius:3px;box-shadow:3px 3px 3px rgba(0,0,0,0.4);-webkit-box-shadow:3px 3px rgba(0,0,0,0.4);-moz-box-shadow:3px 3px rgba(0,0,0,0.4);font-family:Verdana,sans-serif;position:absolute;left:22px;top:-20px;z-index:99;background:#333;border:2px solid #111;font-weight:400;text-align:center;text-decoration:none;padding:.1em;width:100px;display:block;opacity:.95;filter:alpha(opacity=95);z-index:99}#skillTooltips .SkillText{font-size:12px;color:#fff}#skillTooltips a:hover span,#skillTooltips a:active span,#skillTooltips a:focus span{visibility:visible}#skillTooltips a:hover,#skillTooltips a:focus{visibility:visible}
</style>
<?PHP
if(!defined('INITIALIZED'))
	exit;
		
$list = 'experience';
if(isset($_REQUEST['list']))
	$list = $_REQUEST['list'];

$page = 0;
if(isset($_REQUEST['page']))
	$page = min(50, $_REQUEST['page']);

$vocation = '';
if(isset($_REQUEST['vocation']))
	$vocation = $_REQUEST['vocation'];

switch($list)
{
	case "fist":
		$id=Highscores::SKILL_FIST;
		$list_name='Fist Fighting';
		break;
	case "club":
		$id=Highscores::SKILL_CLUB;
		$list_name='Club Fighting';
		break;
	case "sword":
		$id=Highscores::SKILL_SWORD;
		$list_name='Sword Fighting';
		break;
	case "axe":
		$id=Highscores::SKILL_AXE;
		$list_name='Axe Fighting';
		break;
	case "distance":
		$id=Highscores::SKILL_DISTANCE;
		$list_name='Distance Fighting';
		break;
	case "shield":
		$id=Highscores::SKILL_SHIELD;
		$list_name='Shielding';
		break;
	case "fishing":
		$id=Highscores::SKILL_FISHING;
		$list_name='Fishing';
		break;
	case "magic":
		$id=Highscores::SKILL__MAGLEVEL;
		$list_name='Magic';
		break;
	default:
		$id=Highscores::SKILL__LEVEL;
		$list_name='Experience';
		break;
}
if(count($config['site']['worlds']) > 1)
{
	foreach($config['site']['worlds'] as $idd => $world_n)
	{
		if($idd == (int) $_REQUEST['world'])
		{
			$world_id = $idd;
			$world_name = $world_n;
		}
	}
}
if(!isset($world_id))
{
	$world_id = 0;
	$world_name = $config['server']['serverName'];
}
if(count($config['site']['worlds']) > 1)
{
	$main_content .= '
		<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%>
			<TR>
				<TD></TD>
				<TD>
					<FORM ACTION="" METHOD=get>
						<INPUT TYPE="hidden" NAME="subtopic" VALUE="highscores">
						<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4>
							<TR>
								<TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>World Selection</B></TD>
							</TR>
							<TR>
								<TD BGCOLOR="'.$config['site']['darkborder'].'">
									<TABLE BORDER=0 CELLPADDING=1>
										<TR>
											<TD>Best players on world:</TD>
											<TD><SELECT SIZE="1" NAME="world">';
											foreach($config['site']['worlds'] as $wid => $world_n)
											{
												if($wid == $world_id)
													$main_content .= '
														<OPTION VALUE="'.htmlspecialchars($wid).'" selected="selected">'.htmlspecialchars($world_n).'</OPTION>';
												else
													$main_content .= '
														<OPTION VALUE="'.htmlspecialchars($wid).'">'.htmlspecialchars($world_n).'</OPTION>';
											}
											$main_content .= '
												</SELECT> 
											</TD>
											<TD>
												<INPUT TYPE="image" NAME="Submit" ALT="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif">
											</TD>
										</TR>
									</TABLE>
								</TABLE>
							</FORM>
						</TABLE>';}
					$offset = $page * 100;
					$skills = new Highscores($id, 100, $page, $world_id, $vocation);
					$main_content .= '
  <div class="TableContainer" style="width:100%;">
  <table class="Table3" cellpadding="0" cellspacing="0">
  <div class="CaptionContainer">
  <div class="CaptionInnerContainer">
  <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    
  <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    
  <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    
  <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    
  <div class="Text">Ranking de '.htmlspecialchars($list_name).'</div>    
  <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>    
  <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>    
  <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>    
  <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>   
  </div>  
  </div>  
  <tr>   
  <td>    
  <div class="InnerTableContainer">     
<table style="width:100%;">
											<tbody><tr>
												<td>
													<div class="TableShadowContainerRightTop">
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-rt.gif);"></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-rm.gif);">
														<div class="TableContentContainer">  
<table class="TableContent" width="100%">
							<TR>
								<TD WIDTH=100% ALIGN=right VALIGN=bottom>';
					
					$main_content .= '
						<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%></TABLE>
						<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>
							<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
								<TD CLASS=whites><strong>Rank</strong></TD>
								<TD WIDTH=75% CLASS=whites><B>Nome</B></TD>
								<TD WIDTH=15% CLASS=whites><b>Level</B></TD>';
						if($list == "experience")
							$main_content .= '
								<TD CLASS=whites><b>Points</B></TD>';
						$main_content .= '
							</TR>';
						$number_of_rows = 0;
					foreach($skills as $skill)
					{
						if($list == "magic")
							$value = $skill->getMagLevel();
						elseif($list == "experience")
							$value = $skill->getLevel();
						else
							$value = $skill->getScore();
						$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
						$flagg = $skill->getCustomField("flag");
						if($flagg != unknown)
						{
							$flag = '<image src="/images/flags/'.$flagg.'.gif"/>';
						}
						else
						{
							$flag = '<image src="images/flags/unknown.gif"/>';
						}
						$main_content .= '
							<tr bgcolor="'.$bgcolor.'">
								<td>'.($offset + $number_of_rows).'</td>
								<td>'.$flag.' <a href="?subtopic=characters&name='.urlencode($skill->getName()).'">'.htmlspecialchars($skill->getName()).'</a></td>
								<td>'.$value.'</td>';
						if($list == "experience")
							$main_content .= '
								<td>'.$skill->getExperience().'</td>';
						$main_content .= '
							</tr>';
					}
					$main_content .= '
						</TABLE>
						<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>';
					if($page > 0)
						$main_content .= '
							<TR>
								<TD WIDTH=100% ALIGN=right VALIGN=bottom>
									<A HREF="?subtopic=highscores&list='.urlencode($list).'&page='.($page - 1).'&vocation=' . urlencode($vocation) . '&world=' . urlencode($world_id) . '" CLASS="size_xxs">Previous Page</A>
								</TD>
							</TR>';
					if($page < 50)
						$main_content .= '
							<TR>
								<TD WIDTH=100% ALIGN=right VALIGN=bottom>
									<A HREF="?subtopic=highscores&list='.urlencode($list).'&page='.($page + 1).'&vocation=' . urlencode($vocation) . '&world=' . urlencode($world_id) . '" CLASS="size_xxs">Next Page</A>
								</TD>
							</TR>';
					$main_content .= '
						</TABLE>
					</TD>
										<TD WIDTH=15% VALIGN=top ALIGN=right>
											<table border="0" cellpadding="4" cellspacing="1" id="skillTooltips" style="margin-top: -17px;">
												<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
													<br><TD CLASS=whites><B><center>Category</center></B></TD>
												</TR>
												<TR BGCOLOR="'.$config['site']['lightborder'].'">
													<td style="background-color: #F1E0C6;width:40px;text-align:center;padding:2px">
											<a href="?subtopic=highscores&amp;list=experience" class="skillTooltips">
												<img src="./images/skills/level.gif" width="40" height="40">
												<span><font class="SkillText">Experience</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=magic" class="skillTooltips">
												<img src="./images/skills/ml.gif" width="40" height="40">
												<span><font class="SkillText">Magic Level</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=shield" class="skillTooltips">
												<img src="./images/skills/def.gif" width="40" height="40">
												<span><font class="SkillText">Shielding</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=distance" class="skillTooltips">
												<img src="./images/skills/dist.gif" width="40" height="40">
												<span><font class="SkillText">Distance</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=club" class="skillTooltips">
												<img src="./images/skills/club.gif" width="40" height="40">
												<span><font class="SkillText">Club Skill</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=sword" class="skillTooltips">
												<img src="./images/skills/sword.gif" width="40" height="40">
												<span><font class="SkillText">Sword Skill</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=axe" class="skillTooltips">
												<img src="./images/skills/axe.gif" width="40" height="40">
												<span><font class="SkillText">Axe Skill</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=fist" class="skillTooltips">
												<img src="./images/skills/fist.gif" width="40" height="40">
												<span><font class="SkillText">Fisting Skill</font></span>
											</a><br>

											<a href="?subtopic=highscores&amp;list=fishing" class="skillTooltips">
												<img src="./images/skills/fish.gif" width="40" height="40">
												<span><font class="SkillText">Fishing Skill</font></span>
											</a><br>
										</td>
												</TR>
											</TABLE>
										</TD>
									</TR>
								</TABLE></div>
											</div>
											<div class="TableShadowContainer">
												<div class="TableBottomShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-bm.gif);">
													<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-bl.gif);"></div>
													<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-br.gif);"></div>
												</div>
											</div>
										</td>
									</tr>
								</tbody></table>	
							</div>
						</td>
					</tr>
				</tbody>
			</table>		
		</div>';
?>