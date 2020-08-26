<?php

$main_content .= '
<table width="100%" border="0" cellpadding="4" cellspacing="1">
	<tbody>
		<tr>
			<td class="white" colspan="3" bgcolor="#505050"><span class="style4">Detalhes da bonifica&ccedil;&atilde;o de Points.</span></td>
		</tr>
		<tr bgcolor="#f1e0c6"><td width="35%"><b>Doa&ccedil;&atilde;o</b></td><td width="35%"><b>Points</b></td></tr>
		<tr bgcolor="#d4c0a1"><td>R$5,00</td><td><img src="layouts/tibiarl/images/content/bullet.gif"> 5 Points</td></tr>
		<tr bgcolor="#f1e0c6"><td>R$10,00</td><td><img src="layouts/tibiarl/images/content/bullet.gif"> 10 Points</td></tr>
		<tr bgcolor="#d4c0a1"><td>R$20,00</td><td><img src="layouts/tibiarl/images/content/bullet.gif"> 20 Points</td></tr>
		<tr bgcolor="#f1e0c6"><td>R$40,00</td><td><img src="layouts/tibiarl/images/content/bullet.gif"> 40 Points</td></tr>
		<tr bgcolor="#d4c0a1"><td>R$60,00</td><td><img src="layouts/tibiarl/images/content/bullet.gif"> 60 Points</td></tr>
		<tr bgcolor="#f1e0c6"><td><center><img src="layouts/tibiarl/images/content/bullet.gif"> E assim por diante!!! <img src="layouts/tibiarl/images/content/bullet.gif"></center><td><center><img src="layouts/tibiarl/images/content/bullet.gif"> E assim por diante!!! <img src="layouts/tibiarl/images/content/bullet.gif"></center></td></tr>
	</tbody>
</table></br>
<form target="pagseguro" method="post" action="dntpagseguro.php">
	<input type="hidden" name="reference" value="'.$account_logged->getCustomField("name").'">
	<table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo"><tbody>
		<tr bgcolor="#505050" class="white">
			<th colspan="2"><strong>Escolha a quantidade de pontos que deseja DONATAR.</strong></th>
		</tr>
		<tr bgcolor="#d4c0a1">
			<td width="10%">Sua conta</td>
			<td><strong>'.$account_logged->getCustomField("name").'</strong></td>
		</tr>
		<tr bgcolor="#d4c0a1">
			<td width="10%">Pontos</td>
			<td><input name="itemCount" type="number" min="1" size="5" maxlength="5"></td>
		</tr>
		<tr bgcolor="#d4c0a1">
			<td colspan="2">
				<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg" name="submit"/>
			</td>
		</tr>
	</tbody>
</table>
</form><br>
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text"><font color="red">AVISO</font></div>
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
																	<td><div style="text-align: justify;">Os pontos são entregues automaticamente após a aprovação do seu pagamento pelo <b>PagSeguro</b>.<br><br><font color="red">Em caso de estorno, sua conta será excluída e seus itens rastreados.</font></div></td>
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
</div>
<?php } ?>';
