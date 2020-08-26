<?php
	$result = $SQL->query('SELECT `frags_blue`,`frags_red`,`towers_blue`, `towers_red`, `data`,`hora` FROM `dtt_results` ORDER BY `id` DESC LIMIT 20;');

	$main_content .= '
		<center><h2>Evento Defend The Towers</h2></center>
		</br>
		<center>
Inspirado em jogos MOBA, o evento oferece uma grande arena de batalha com 3 lanes e jungle. Os times são separados em azul e vermelho e devem disputar para derrotar por primeiro as torres do time adversário, devem também garantir os buffs de ataque do seu time para aumentar as chances de vencer a batalha. Assista o video e leia as informacoes detalhas da tabela.

		</br>
			<img src="http://i.imgur.com/gEPHqUR.png">
			</br>

		</center>
		</br>
		<div class="TableContainer">
			<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Informacoes</div>
				<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>

		<table class="Table1" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tbody>
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b>
								<font color="white">Objetivo</font></b></td>
						</tr>
						<tr style="background-color:'.$config['site']['lightborder'].';">
								<center>
									<img src="http://i.imgur.com/xdpaof1.png"></br>
								</center>
							<td>
								<p> A principal necessidade do seu time é defender suas torres e destruir as do seu inimigo, quem derrubar as torres do adversário primeiro vence o evento. </p>
							</td>
						</tr>
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b><font color="white">Torres</font></b></td>
						</tr>
						<tr style="background-color:'.$config['site']['lightborder'].';">
							<td>
								<p> Cada time possui 4 torres para defender e atacar. Elas estão distribuidas da seguinte maneira 3 das torres estao nas lanes (top, middle e bottom) e 1 torre suprema na base.</p>
							</td>
						</tr>
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b><font color="white">Danos por morte</font></b></td>
						</tr>
						<tr style="background-color:'.$config['site']['lightborder'].';">
							<td>
								<p> Na arena de batalha a penalidade por morte não existe, o unico cuidado que deve se tomar é com os monstros buff que caso voce morra será penalizado como uma morte normal. </p>
							</td>
						</tr>
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b><font color="white">Magias Buff</font></b></td>
						</tr>
						<tr style="background-color:'.$config['site']['lightborder'].';">
							<td>
								<center>
								<h2>Aumente o poder do seu time</h2>
								</center>
								<p>Derrote os monstros, que dão buffs para os jogadores da sua equipe, para ter vantagens. A <b>Spider of Jungle</b> da buff para <i>Druids e Knights</i> e a <b>Serpent of Jungle</b> da buff para <i>Sorcerers e Paladins</i> do seu time, utilizando as magias:</p>
							</td>
						</tr>

						<TABLE WIDTH=100% BORDER=0 CELLPADDING=2 CELLSPACING=1>
						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'50%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/9/99/Giant_Spider.gif" border="0"></br>Spider of Jungle</b>
										</br>
										</td>
										<td width=\'50%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/4/4d/Serpent_Spawn.gif" border="0"></br>Serpent of Jungle</b></td>
						</tr>
						</table>
						<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=2>
						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/b/b4/Outfit_Druid_Male_Addon_3.gif" border="0"></br>Druids</b></td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/9/91/Outfit_Knight_Male_Addon_3.gif" border="0"></br>Knights</b></td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/d/da/Outfit_Mage_Male_Addon_3.gif" border="0"></br>Sorcerers</b></td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b><img src="http://www.tibiawiki.com.br/images/9/9a/Outfit_Hunter_Male_Addon_3.gif" border="0"></br>Paladins</b></td>
						</tr>
						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">Magician Buff</td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">Warrior Buff</td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">Wizard Buff</td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">Archer Buff</td>
						</tr>
						</table>

						<table width="100%">
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b><font color="white">Premio</font></b></td>
						</tr>
						<tr style="background-color:'.$config['site']['lightborder'].';">
							<td>
								<p> Os membros do time vencedor recebem 3 Event Coins cada. </p>
							</td>
						</tr>

			</tbody></table>
				</div>
			</td>
		</tr>
	</tbody></table>
		</div>
		</br>
		</br>



		<div class="TableContainer">
			<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Relatório das Batalhas</div>
				<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
			</div>
		</div><table class="Table1" cellpadding="0" cellspacing="0">

		<tbody><tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tbody>
						<tr style="background-color:#af2126;">
							<td class="LabelV150"><b><font color="white"> <center>Brasao Azul</font></b></center></td>
							<td class="LabelV150"><b><font color="white"><center>Detalhes</center></font></b></td>
							<td class="LabelV150"><b><font color="white"><center>Brasao Vermelho</center></font></b></td>
						</tr>
	';

	foreach($result as $info) {
	if ($info['towers_blue'] > $info['towers_red']){
		$colort1 = "green";
		$colort2 = "red";
	}
	else{
		$colort1 = "red";
		$colort2 = "green";
	}
	if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; }
		$number_of_rows++;
	$main_content .= '
	<tr bgcolor="'.$config['site']['lightborder'].'">
		<td></br>
			<center>
			<img src="http://i.imgur.com/4BUoi74.png" width="115" height="115" style="width: 115px; height: 115px; background-repeat: no-repeat; margin-top:0px;" >
			</center>
		</td>
		<td></br>
			<center>
			<h1><font color='.$colort1.'>'.$info['towers_blue'].'</font> x <font color='.$colort2.'>'.$info['towers_red'].'</font></h1>
			Foi realizada em '.$info['data'].' as '.$info['hora'].'. </br>
			Numero de baixas [<b><font color="blue">'.$info['frags_blue'].'</font>/<font color="red">'.$info['frags_red'].'</font></b>].</br>
			</center>
		</td>
		<td></br>
			<center>
	   <img src="http://i.imgur.com/hEI5O4a.png" width="115" height="115" style="width: 115px; height: 115px; background-repeat: no-repeat; margin-top:0px;" >
		 </center>
		</td>
	</tr>
		';
	}
	$main_content .= '
	</tbody></table>
				</div>
			</td>
		</tr>
	</tbody></table>
</div>
	</br>
	
	';

$main_content .= '

<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">NPC Event Seller</div>
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
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td>O NPC <b>Event Seller</b> fica localizado no templo da cidade principal, esse NPC vende itens exclusivos do server e s&oacute; negocia com a moeda Event Coins. Veja mais abaixo as op&ccedil;&otilde;es de itens a venda e os seus devidos valores.</td>
																</tr>									
															</table>
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
											
											
											
										
											
											
											
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Vip Donate</b> adiciona <b>1</b> dia de acesso a area donate.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 10 Event Coins</b></br><img src="/images/npcmega/10event.png"></td><td width="50%"><b>Vip Donate</b></br><img src="/images/npcmega/vipdonate.png"></td>
																</tr>									
															</table>
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

											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Addon Doll</b> adiciona <b>1</b> addon doll, para você comprar qualquer addon do servidor exceto gonka.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 2 Event Coins</b></br><img src="/images/npcmega/2event.png"></td><td width="50%"><b>Addon doll</b></br><img src="/images/npcmega/addondoll.png"></td>
																</tr>									
															</table>
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
											
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Escritura de Cave</b> recebe <b>1</b> item para usar no Super UP durante 1h.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 15 Event Coins</b></br><img src="/images/npcmega/15event.png"></td><td width="50%"><b>Cave Exclusiva</b></br><img src="/images/npcmega/escrituradecave.png"></td>
																</tr>									
															</table>
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

											
											
											
											
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Removedor de frags</b> remove <b>TODOS</b> os seus frags.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 15 Event Coins</b></br><img src="/images/npcmega/15event.png"></td><td width="50%"><b>Removedor de frags</b></br><img src="/images/npcmega/removedordefrags.png"></td>
																</tr>									
															</table>
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
											
											
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Critical Stone</b> Ganha <b>2</b> Critical Stone para evoluir seu level de skill.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 4 Event Coin</b></br><img src="/images/npcmega/4event.png"></td><td width="50%"><b>Critical Stone</b></br><img src="/images/npcmega/2critical.png"></td>
																</tr>									
															</table>
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

										<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td><b>Dodge Stone</b> Ganha <b>3</b> Dodge Stone para evoluir seu level de skill.</td>
																</tr>									
															</table>
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
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="50%"><b>Valor: 4 Event Coin</b></br><img src="/images/npcmega/4event.png"></td><td width="50%"><b>Dodge Stone</b></br><img src="/images/npcmega/3dodge.png"></td>
																</tr>									
															</table>
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
								
															</table>
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

';

?>
