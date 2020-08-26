<?php 

//echo date("d/m/Y");

$dayNow = date("Y/m/d");
$dat = $SQL->query("SELECT * FROM `monster_boost`")->fetchAll();

$creatureToday = $SQL->query("SELECT * FROM monster_boost ORDER BY id DESC LIMIT 1 " )->fetch();
$creatureWeek = $SQL->query("SELECT * FROM monster_boost ORDER BY id DESC LIMIT 7 " )->fetchAll();


?>


<div class="TableContainer">
    <div class="CaptionContainer">
        <div class="CaptionInnerContainer">
            <span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
            <span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
            <span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
            <div class="Text">Boosted Creature on Baiak</div>
            <span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
            <span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
            <span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
            <span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
        </div>
    </div>
    <table class="Table1" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td>
                    <div class="InnerTableContainer">
                        <p><img src="/images/monsterboost/<?= $creatureToday['monster'] ?>.gif" style="float:right; margin-right: 14px;">Hoje criatura impulsionada é: <span class="nameMonster"><?= $creatureToday['monster']; ?></span></p>
                        <p>Para evitar que sempre os mesmos tipos de criatura sejam caçados e eventualmente exterminados, os deuses tibianos surgiram com a idéia do boosted creature. Todos os dias escolhe-se uma criatura que é particularmente gratificante para este dia. Desta forma, os aventureiros de todo o baiak devem ser atraídos para caçar uma variedade maior de monstros.</p>
                        <p>A criatura impulsionada está dando <b><?= $creatureToday['exp'] ?>%</b> de <b>experiência</b> e <b><?= $creatureToday['loot'] ?>%</b> de <b>loot</b> a mais.</p>
                        <p>Boa caçada!</p>
                        <table style="width:100%;"> </table>
                        <div class="info">
							<i class="fa fa-bug" aria-hidden="true"></i> Monstros que podem ser impulsionados:
						</div>
                    </div>
                    <br>
                    <div style="display: table; width: 100%; ">
    					<div style="text-align: -webkit-center; margin-left: 18px;">
						<?php foreach($monstersBoost as $key => $monsterName ): ?>
							<div style="width: 100px; height: 100px; margin: 0px; float: left;">
								<?php if($monsterName == "Warlock"): ?>
									<div class="outfitMonster" style="padding-left: 10px;"><br><img src="images/monsterboost/<?= $monsterName; ?>.gif"></div>
								<?php elseif($monsterName == "Dawnfire Asura"): ?>
									<div class="outfitMonster"><br>
									<img src="images/monsterboost/<?= $monsterName; ?>.gif"></div>
								<?php elseif($monsterName == "Midnight Asura"): ?>
									<div class="outfitMonster"><br>
									<img src="images/monsterboost/<?= $monsterName; ?>.gif"></div>
								<?php elseif($monsterName == "Skeleton Elite Warrior"): ?>
									<div class="outfitMonster"><br>
									<img src="images/monsterboost/<?= $monsterName; ?>.gif"></div>
								<?php elseif($monsterName == "Fury"): ?>
									<div class="outfitMonster">
									<img src="images/monsterboost/<?= $monsterName; ?>.gif" style="margin-top: -10px"></div>
								<?php else: ?>
									<div class="outfitMonster"><img src="images/monsterboost/<?= $monsterName; ?>.gif"></div>
								<?php endif; ?>
		        					
									<div><?= $monsterName ?></div>
		        				</div>
						<?php endforeach; ?>
		        				
						</div>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<br>
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Histórico da semana</div>
			<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
				</div>
					</div>
						<table class="Table3" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%">
																<tr bgcolor="">
																	<td width="5%" style="text-align: center; font-weight: bold;">Outfit</td>
																	<td width="35%" style="text-align: center; font-weight: bold;">Monster</td>
																	<td width="15%" style="text-align: center; font-weight: bold;">Day</td>
																	<td width="10%" style="text-align: center; font-weight: bold;">Exp</td>
																	<td width="10%" style="text-align: center; font-weight: bold;">Loot</td>
																</tr>
																<?php foreach($creatureWeek as $list):  ?>
																
																<?php
																$date = date_parse($list['date']); 
																
																?>
																	<tr bgcolor="#F1E0C6">
																		<td>
																		<?php if($list['monster'] == "Warlock"): ?>
																			<div class="outfitMonster" style="padding-left: 10px;"><br><img src="images/monsterboost/<?= $list['monster']; ?>.gif"></div>
																		<?php elseif($list['monster'] == "Dawnfire Asura"): ?>
																			<div class="outfitMonster"><br>
																			<img src="images/monsterboost/<?= $list['monster']; ?>.gif"></div>
																		<?php elseif( $list['monster'] == "Midnight Asura"): ?>
																			<div class="outfitMonster"><br>
																			<img src="images/monsterboost/<?= $list['monster']; ?>.gif"></div>
																		<?php elseif($list['monster'] == "Skeleton Elite Warrior"): ?>
																			<div class="outfitMonster"><br>
																			<img src="images/monsterboost/<?= $list['monster']; ?>.gif"></div>
																		<?php elseif($list['monster'] == "Fury"): ?>
																			<div class="outfitMonster">
																			<img src="images/monsterboost/<?= $list['monster']; ?>.gif" style="margin-top: -10px"></div>
																		<?php else: ?>
																			<div class="outfitMonster"><img src="images/monsterboost/<?= $list['monster']; ?>.gif"></div>
																		<?php endif; ?>														
																		</td>
																		<td><span class="nameMonster"><?= $list["monster"]; ?></span></td>
																		<td align="center"><?= $date['day'] . '/' . $date['month'] . '/' . $date['year']; ?></td>
																		<td align="center"><?= $list["exp"]; ?>%</td>
																		<td align="center"><?= $list["loot"]; ?>%</td>
																	</tr>																
																<?php endforeach; ?>
																	
																	
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiarl/images/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					
				</td>
			</tr>
		</tbody>
	</table>
	</div>
	
