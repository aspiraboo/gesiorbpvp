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
				<div class="Text">Mining System</div>
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
																		<td><div style="text-align: justify;">Um sistema que você pode utilizar uma pick para minerar os <b>Red Crystais</b> e possivelmente obter um minério chamado <b>Concentrated Red Crystal</b>. Ao minerar, você vai receber experiência de mining, aumentando sua chance de minerar mais facilmente. Você pode chegar até o nível 100 de mining.<br><br>Para saber seu nível de mining e maiores informações sobre, use o comando <b>!mining</b> dentro do jogo.</div></td>
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
																		<td><b>Sobre o Red Crystal (minério disponível para mineração):</b></td>
																	</tr>
																</table>
																<table width="100%">
																<tr>
																	<td>
																		<table width="100%">
																		<tr>
																			<td width="5%"><center><img src="/images/mining/blood_crystal_charged.gif"></center></td><td width="80%">&emsp;Ao usar uma <b>pick</b>, você pode minerar <b>Concentrated Red Crystals</b>.</td>
																		</tr>
																		</table>
																		<table width="100%">
																		<tr>
																			<td width="5%"><center><img src="/images/mining/blood_crystal.gif"></center></td><td width="80%">&emsp;Após 60 segundos, ele se transforma no item acima.<br>&emsp;Você não pode usar a <b>pick</b> neste item.</small></td>
																		</tr>
																		</table>
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
												<tr>
													<td><br>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="table3 table-offers" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr style="background-color:#505050;">
																		<td><font color="white"><b>Falhando na mineração:</b></font></td>
																		<td><font color="white"><b>Sucesso na mineração:</b></font></td>
																		<td><font color="white"><b>Upando Nível Mining:</b></font></td>
																	</tr>
																	<tr style="background-color:#d4c0a1;">
																		<td width="30%"><center><img src="images/mining/nothing.gif" width="230px"></center></td><td width="30%"><center><img src="images/mining/mining.gif" width="230px"></center></td><td width="30%"><center><img src="images/mining/upmining.gif" width="230px"></center></td>
																	</tr>																	
																</table>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><br>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr style="background-color:#D4C0A1;" >
																		<td><div style="text-align: justify;">
																			<p>O NPC <b>Negociante De Crystal</b> fica localizado dentro do templo, ao norte. Esse NPC troca itens exclusivos do servidor através do minério <b>Concentrated Red Crystals</b>. Basta perguntar sobre <b>Itens</b> e ele vai te dizer quais podem ser trocados.<br><br> <small>(<i>Clique na imagem pra ampliar</i>.)</small></p></div>
																		</td>
																		<td width="20%">
																			<a class="fancybox-media" href="/images/mining/npc_mining.png">
																				<img src="/images/mining/npc_mining.png" width="130px" border="1">
																			</a>
																		</td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-br.gif);" ></div>
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
	</div>';
?>