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
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
if($pagina == 0){
	$pagina = 1;
}

$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
if($qnt_result_pg == 0){
	$qnt_result_pg = 5;
}
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$pagamento = new Pagamento;
$pagamentos = new Pagamento;
$pagamentos->GetPagamentos2($account_logged->getName());
$row_pg = $pagamentos->TotalDados();
$quantidade_pg = $row_pg / $qnt_result_pg;
if((int) substr(strpbrk($quantidade_pg, '.,'), 1) <= 5){
	$quantidade_pg = number_format($quantidade_pg, 0);
	$quantidade_pg +=1;
}
else{
	$quantidade_pg = number_format($quantidade_pg, 0);
}
$pagamento->getDonateList($inicio, $qnt_result_pg, $account_logged->getName());
$resultado_usuario = $pagamento->TotalDados();
$max_links = 2;
echo substr(strpbrk($quantidade_pg, '.,'), 1);

echo '
<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span> 
								<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>							
								<div class="Text">Pagamentos</div>
								<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span> 
								<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
							</div>
							
						</div><table class="Table4" cellpadding="0" cellspacing="0">';

						echo "
						<tr><td>
<div class='pagination'>
					<div class='pagin'>
Pages:
<a href='javascript:void(0)' onclick='listar_usuario2(1, $qnt_result_pg)'>«</a> ";


for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
	if($pag_ant >= 1){
		
		echo "  
		 <a href='javasript:void(0);' onclick='listar_usuario2($pag_ant, $qnt_result_pg)'> $pag_ant  </a> ";
	}
}

echo " <strong>$pagina </strong>";

for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
	if($pag_dep <= $quantidade_pg){
		echo " <a href='javasript:void(0);'  onclick='listar_usuario2($pag_dep, $qnt_result_pg)'> $pag_dep  </a> ";
	}
}

echo " 
<a href='javascript:void(0);' onclick='listar_usuario2($quantidade_pg, $qnt_result_pg)'>»</a>

</div>
</div>
</td></tr>


                    
";
echo '
						
						
						<tbody><tr>
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
														<table border="1" cellpadding="4" cellspacing="1" class="TableContent" width="100%" style="border:1px solid #faf0d7;">
															<tbody><tr>
			
			</tr><tr bgcolor="#4d3319" style="border ">
			<td width="5%" align="center" class="white"><b>Account</b></td>
			<td width="10%" align="center" class="white"><b>Valor</b></td>
			<td width="10%" align="center" class="white"><b>Status</b></td>
			<td width="10%" align="center" class="white"><b>Método</b></td>
			<td width="1%" align="center" class="white"><b></b></td>
			</tr>';
			//$dntsfromaccount = $SQL->query("SELECT * FROM comprovante WHERE nome='".$account_logged->getName()."' ");
			
			// $pagamento = new Pagamento;
			
			// $pagamento->GetPagamentos($account_logged->getName());

			if ($pagamento->TotalDados() <= 0){
				echo '
				<tr bgcolor="#F1E0C6">
				<td align="center" colspan="5"><i>Você não tem nenhum pagamento pendente.</i></td>
				</tr>
				';
				
			}
		     foreach($pagamento->GetItens() as $dnts):
                    $idpayment = $dnts['id'];
			echo ' 
			<tr bgcolor="#F1E0C6">
                  <td align="center">'.$dnts['nome'].'</td>
                  <td align="center">R$ '.number_format($dnts['valor'], 2,',', '.').'</td>';
                  if($dnts['mensagem'] == 'Aprovado') echo' <td align="center"><span class="badge badge-success">'.$dnts['mensagem'].'</span></td>';
                  if($dnts['mensagem'] == 'Pendente') echo' <td align="center"><span class="badge badge-warning">'.$dnts['mensagem'].'</span></td>';
				  if($dnts['mensagem'] == 'Reprovada') echo' <td align="center"><span class="badge badge-danger">'.$dnts['mensagem'].'</span></td>';
				  if($dnts['mensagem'] == 'Aguardando Pagamento') echo' <td align="center"><span class="badge badge-primary">Aguardando Pagamento</span></td>';
                  echo' 
                  
                  <td align="center">'.$dnts['metodo'].'</td>
                  <td align="center">
                  ';
                  

                  if($dnts['mensagem'] == 'Aguardando Pagamento'){
                      echo '
                      <a href="javascript:void(0);" onclick="takeIdPayment2('.$idpayment.');" data-toggle="modal" data-target="#ExemploModalCentralizado">
                      <i class="fa fa-search"></i></a>
                      
                      ';
                  }
                  else{
                      echo '<a href="javascript:void(0);" onclick="takeIdPayment('.$idpayment.');" data-toggle="modal" data-target="#ModalPagamentoStatus"> <i class="fa fa-search"></i></a>';
                  }
				  echo '
				  </td>
				 <input type="hidden" id="idPayment" name="idPayment" value="'.$dnts['id'].'"></td>
				  
				  </tr>
                 
                </tr>
				';
				
				endforeach ;

			
			
			
				
				echo' 
				
			
			
			
			
			</tbody></table>
													</div>
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
							</td></tr></tbody></table>
                        </div>';