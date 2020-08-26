<?PHP
	$main_content .= '
	 <script src="'.$layout_name.'/fancy/jquery.fancybox.js"></script>
        <script src="'.$layout_name.'/fancy/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
        <link href="'.$layout_name.'/fancy/jquery.fancybox.css" rel="stylesheet" />
		<script>
			$(document).ready(function(){
				 $(\'.fancybox-media\').fancybox({
					openEffect  : \'none\',
					closeEffect : \'none\',
					helpers : {
						media : {}
					}
				});
			});
		</script>';
	$main_content .= '<br>
		<a name="Shop" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="'.$layout_name.'/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
		<div class="TableContainer">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer"> 
					<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Mining System by <a href="https://www.facebook.com/henrique.matheus.31" target="_blanck"><font color="white">Henrique Matheus</font></a></div>
					<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span> 
					<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
				</div>
			</div>
			<table class="Table5" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>
							<div class="InnerTableContainer" >
								<table style="width:100%;" >
									<tr>
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td><div style="text-align: justify;"><b>Como funciona? --></b> Existe uma área de mineração no servidor que pode ser acessada pela sala de Games (TP NO TEMPLO) . Dentro dela é possível usar uma pick para minerar nas paredes de terra. Conforme você vai minerando, vai podendo  subir em level de mineração e, a cada level, os itens que você consegue minerar melhoram. Você pode vender todos os itens que você minera para o NPC Minerador Aprendiz que fica localizado na área. Este é um bom método para juntar dinheiro no servidor (aconselhamos minerar de bot). Use o comando <b>!mining</b> para ver suas informações. <a href="?subtopic=miningrank">Confira aqui </a>o Ranking de mineração.</div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td><div style="text-align: justify;"><b><center>Confira abaixo um exemplo das informações do comando:</center></b></div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td><div style="text-align: justify;">
																<p><center><img src="images/mining/mininginfo.png" border="0">&nbsp;&nbsp;<img src="images/mining/mininginfo2.png" border="0"></center></div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td><div style="text-align: justify;"><b><center>Confira quais itens podem ser minerados a cada level: </b></center></div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														
						


						<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=2>
						</tr>

						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b>Level</b></td>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center"><b>Itens</b></td>
										
									
						</tr>
						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[0] - Desentendido</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"></td>
								
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[1] - Curioso</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"></td>
										
						<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[2] - Iniciante</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"></td>
								
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[3] - Aprendiz</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"></td>
						
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[4] - Aspirante</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"></td>
									
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[5] - Minerador Iniciante</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center">	<img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"></td>
									
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[6] - Minerador</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"></td>
										
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[7] - Minerador II</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"></td>
									
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[8] - Minerador III</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"><img src="/images/items/5889.gif" border="0"></td>
									
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[9] - Minerador Dedicado</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"><img src="/images/items/5889.gif" border="0"></td>
									
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[10] - Minerador Experiente</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"><img src="/images/items/5889.gif" border="0"><img src="/images/items/5904.gif" border="0"></td>
										
										<tr bgcolor=\'#F1E0C6\'>
										<td width=\'25%\' class=\'tr_info_sec\' p align="center">[11+] - Mestre Minerador</br></td>
										<td width=\'35%\' class=\'tr_info_sec\' p align="center"><img src="/images/items/2229.gif" border="0"><img src="/images/items/1294.gif" border="0"><img src="/images/items/2144.gif" border="0"><img src="/images/items/2143.gif" border="0"><img src="/images/items/5880.gif" border="0"><img src="/images/items/2159.gif" border="0"><img src="/images/items/2151.gif" border="0"><img src="/images/items/5944.gif" border="0"><img src="/images/items/5889.gif" border="0"><img src="/images/items/5904.gif" border="0"><br><center>(A partir desse level cada level upado aumenta a chance de vir Magic Sulphur)</center></td>
						


						</table>

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
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td><div style="text-align: justify;"><b><center>Script minerar com ElfBOT:</b><br>auto 200 listas \'Mining Baiak\' | useongrounditem 3456 5632 | useongrounditem 3456 5636 | useongrounditem 3456 5631 | useongrounditem 3456 5635 | useongrounditem 3456 5634 |useongrounditem 3456 5632 | useongrounditem 3456 5651| useongrounditem 3456 5638 | useongrounditem 3456 5649 | useongrounditem 3456 5650 | useongrounditem 3456 5633 | useongrounditem 3456 5637 | useongrounditem 3456 5630 | dropitems 3114 1781 |</center></div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#505050;" >
															<td>
																<center><font color="white"><b>-=Mining System=-</b></font></center>
															</td>
														</tr>
													</table>
												</div>
											</div>
											
													</div>
												</td>
											</tr>
	
											

									
							</tbody>
						</table>
			
		</tbody>
	</table>
</div>
';
?>
