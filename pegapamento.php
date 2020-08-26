<?php
header( 'content-type: text/html; charset=utf-8' );
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);



define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if(!defined('ONLY_PAGE'))
	define('ONLY_PAGE', false);
	
// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if(DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

// LOGIN
if(!ONLY_PAGE)
	include_once('./system/load.login.php');
// LOGIN END

// COMPAT
// some parts in that file can be blocked because of ONLY_PAGE constant
include_once('./system/load.compat.php');
// COMPAT END

// LOAD PAGE
include_once('./system/load.page.php'); 

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

echo '
<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
								<div class="Text">Donate
								<button type="button" id="closeconfirmpay" class="close" data-dismiss="modal" aria-label="Fechar" style="color: rgba(255,255,255,1)">
								
								<span aria-hidden="true">&times;</span>
							  </button></div>
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
																		
                <table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >';

                $pagamento = new Pagamento;
                
                $pagamento->getPagamentosId($id);

                //echo $id;
                //$pagamento = $SQL->query("SELECT * FROM comprovante = ".$id." ;");

                foreach($pagamento->GetItens() as $lista){
                   
				echo '
				<tr style="border: 1px solid #faf0d7">
				<td><b>Status:</b> </td>';
              
                if($lista['mensagem'] == 'Aprovado') echo' <td align=""><span class="badge badge-success">'.$lista['mensagem'].'</span></td>';
                if($lista['mensagem'] == 'Pendente') echo' <td align=""><span class="badge badge-warning">'.$lista['mensagem'].'</span></td>';
                if($lista['mensagem'] == 'Reprovada') echo' <td align=""><span class="badge badge-danger">'.$lista['mensagem'].'</span></td>';
                if($lista['mensagem'] == 'Aguardando Pagamento') echo' <td align=""><span class="badge badge-warning">Aguardando Pagamento</span></td>';
                    echo '
                </tr>
                <tr style="border: 1px solid #faf0d7">
				<td><b>Metodo:</b> </td>
				<td>'.$lista['metodo'].'</td>
                </tr>
                <tr style="border: 1px solid #faf0d7">
				<td><b>Valor:</b> </td>
				<td>R$ '.number_format($lista['valor'], 2,',', '.').'</td>
                </tr>';
				if (!empty($lista['motivo'])){
				echo '
                <tr style="border: 1px solid #faf0d7">
				<td><b>Motivo:</b> </td>
				<td>'.$lista['motivo'].'</td>
                </tr>
                ';
				}
                }						
                        echo '
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
					
					

					
					
					
					
					

';