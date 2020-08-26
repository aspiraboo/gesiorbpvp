<script src="confirm.js"></script>
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

$pagamento = new Pagamento;

$pagamento->getPagamentosId($id);

foreach($pagamento->GetItens() as $lista){
echo '

<form id="formConfirPag" method="post">
									<div class="TableContainer">
										<div class="CaptionContainer">
											<div class="CaptionInnerContainer">
												<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
												<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
												<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
												<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
												<div class="Text">Confirmar Pagamento 
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
																						
								<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
								<tr>
									<td width="30%"><b>Account</b></td>
									<td><input type="text" name="accountconfirm" id="accountconfirm" class="form-control form-control-sm"  style="width: 50%" value="'.$account_logged->getName().'"  readonly></td>
									</tr>
								<tr>								
									<td><b>Payment Method</b></td>
										<td>
                                        <input type="text" class="form-control form-control-sm" id="" name="" value="'.$lista['metodo'].'" style="width: 50%" readonly></td>
                                        <input type="hidden" id="id" name="id" value="'.$lista['id'].'">
                                </tr>
                                <tr>								
									<td><b>Valor:</b></td>
										<td>
										<input type="text" class="form-control form-control-sm" id="" name="" value="R$ '.number_format($lista['valor'], 2,',', '.').'" style="width: 50%" readonly></td>
								</tr>
										<tr>
										<td width="30%"><b>Anexo</b></td>
										<td>
										<div id="image_preview"><img id="previewing" src="images/nophoto-available-clip-art-free_68016.png" style="width: 250px; height: 230px;" /></div>
																
										<hr id="line">
										<div id="selectImage">
																
										<label>Select Your Image</label><br/>
										
											<input type="file" name="file" id="file" required />
																<br>
																
																

																										
																										</td>
																									</tr>
									<tr>
									<td colspan="2" align="center">
									<div id="loadSubmitConfirm" style="display:none; z-index: 1200;"><div class="spinner-border text-primary" role="status">
										<span class="sr-only">Loading...</span>
									  </div></div>
									</td>
									</tr>																
									<tr>
									<td colspan="2" align="center">
																										
										</td>
										</tr>							
										<tr>
									<tr>
									<td colspan="2">
										
									<center>
									<button class="btn btn-link" id="btnConfirmPayBlock">
									<div class="LeftButton" id="btnConfirmPayment">
									<div class="BigButton" id="myBtn3" style="background-image:url(layouts/tibiarl/images/global/buttons/sbutton_green.gif)">
									<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
									<div class="BigButtonOver"  style="background-image:url(layouts/tibiarl/images/global/buttons/sbutton_green_over.gif);"></div>
									<input type="hidden" name="filecomprovante" value="yes">
									<input class="ButtonText" type="image"   alt="Next" src="layouts/tibiarl/images/global/buttons/_sbutton_confirm_donate.gif">
									</button>
											</center>
											</td>
											</tr>
                                            <tr>
                                            <td colspan="2" align="center">
                                                                                                                
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
										
									</div>
									
									
									</form>


';
}

