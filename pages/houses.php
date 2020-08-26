<?php
	$main_content .= '
		<script src="'.$layout_name.'/fancy/jquery.fancybox.js"></script>
        <script src="'.$layout_name.'/fancy/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <link href="'.$layout_name.'/fancy/jquery.fancybox.css" rel="stylesheet" />
		<script>
			$(document).ready(function(){
				 $(\'.fancybox-media\').fancybox({
					openEffect  : \'elastic\',
					closeEffect : \'elastic\',
					helpers : {
						media : {}
					}
				});
			});
		</script>';
$main_content .= '

	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Houses</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table3" cellpadding="0" cellspacing="0">
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
																		<td><div style="text-align: justify;">Todos os Jogadores têm a opção de alugar uma casa ou loja para guardar itens ou dormir. Também podem invitar amigos para entrarem em suas casas e se encontrarem.<br><br>Os jogadores que possui uma casa tem os seguintes benefícios:<br><li>Controlar quem tem acesso à casa, e quem pode abrir/fechar cada porta.<br><li>Guardar um número infinito de itens.<br><li>Mostrar com segurança seus itens a outros jogadores.<br><li>Se proteger dentro da casa(todas as houses são Pz Zone).<br><li>Com o passar do tempo, a tendência será a valorização das casas. Você pode vender casas por grandes quantidades de dinheiro.<br><br>Você pode dormir nas camas que se encontram dentro de casas e possuem os seguintes benefícios: <br><li>Seu <b>Soul Points</b> será regenerado mais rapidamente;<br><li>Sua <b>Stamina</b> será regenerada mais rapidamente;<br></div></td>
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
																<table width="100%">
																	<tr>
																		<td><b>Comandos:</b></td>
																	</tr>
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>alana res<br>/buyhouse</b></center></td><td width="80%">Caso tenha dinheiro suficente na sua Backpack, você poderá comprar a casa, basta ficar em de frente para a porta e usar o comando.</td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>alana grav<br>/sellhouse</b></center></td><td width="80%">Utilizado para vender sua casa.</td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>alana sio</b></center></td><td width="80%">Utilizado para remover algum jogador de dentro da casa. Ex: alana sio "nome do personagem".</td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>aleta grav</b></center></td><td width="80%">Edita as permissões da porta. Use enquanto estiver de frente para a porta. Edite a lista de personagens que podem ou não abrir a porta desejada. <b>Cuidado: todos os personagens invitados na casa podem passar por portas que estão abertas, até mesmo se eles não estiverem na lista de quem pode abrir ou fechar a porta.</b></td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>aleta sio</b></center></td><td width="80%">Edita a lista de convidados. Edita todos os personagens que podem entrar na casa.</td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>aleta som</b></center></td><td width="80%">Edita sub-donos. Necessário ser o dono da casa para usar esse comando. Os sub-donos não podem usar esse comando, vender a casa ou utilizar leavehouse.</td>
																	</tr>									
																</table>
																<table width="100%">
																	<tr>
																		<td width="20%"><center><b>alana som<br>/leavehouse</b></center></td><td width="80%">Você deixa a sua casa. Ao utilizar esse comando, você perde sua casa. Necessário ser o dono da casa para utilizar esse comando.</td>
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
	</div><br>';


$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Informações</div>
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
														<td><b>Preço por SQM: <span style="color:red;">9.095 Golds.</span></b><br><br><b>O aluguel da casa é de 7 dias.</b><br> A cada 7 dias será descontado o valor da casa através do Bank. Caso você não tenha dinheiro no Banco o sistema vai checar através do seu Depot. Caso não tenha o dinheiro para pagar a casa, o sistema vai lhe enviar uma carta 3 dias antes, 2 dias antes e 1 dia antes. Caso você não consiga o dinheiro, perderá ela.</td>
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
							</tbody>
						</table>
					</div>										
				</td>
			</tr>
		</tbody>
	</table>
</div>';
?>