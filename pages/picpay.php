  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="pagar.js"></script>


  <style>
  	.modal-backdrop {
  		position: absolute;
  		top: 0;
  		right: 0;
  		bottom: 0;
  		left: 0;
  		z-index: 1;
  		background-color: #000;
  	}
  </style>

  <?php


	$picpay = new PicPay;


	$fatura = new Fatura;
	$fatura->getfatura2();
	foreach ($fatura->GetItens() as $lastref) :
		$lastrefs = $lastref['ref'];
	endforeach;

	//print_r($fatura->fatura(1));



	//var_dump( $fatura->GetItens());

	//$referenceId = 8427396;

	//$s = 'pago';
	//$update = $fatura->update($referenceId,$s);

	if (isset($_POST['valor'])) :
		$account_name = $_POST['account_name'];
		$valor = $_POST['valor'];
		$ref = $_POST['ref'];

		$prod['ref']    = $ref;
		$prod['nome']  = "Fatura " . $ref . "";
		$prod['valor'] = $valor;



		$cli['nome']      = "" . $account_name . "";
		$cli['sobreNome'] = "Pontos Servidor";
		$cli['cpf']       = "000.000.000-00";
		$cli['email']     = "suporte@baiak.com";
		$cli['telefone']  = "2299999999";

		$produto = (object)$prod;
		$cliente = (object)$cli;

		$payment = $picpay->requestPayment($produto, $cliente);

		if (isset($payment->message)) :
			echo $payment->message;
		else :
			$link   = $payment->paymentUrl;
			$qrCode = $payment->qrcode->base64;
		//$updateRef = $fat->ref($id, $link);

		//$main_content .= '<a href="'.$link.'">Pagar com PicPay</a>';
		// echo '<br />';
		// echo '<div class="row">
		// <div class="col-md-12 text-center">

		// ';
		// echo '<img width="250" class="img-responsive img-thumbnail" src="'.$qrCode.'" />';
		// echo '</div>';
		// echo '</div>';

		endif;
		//$main_content .=   $qrCode;
		$fatura->Inserir($prod['ref'], $valor, $account_name, $qrCode);
		$fatura->InserirComp($prod['ref'], $valor, $account_name)
	?>



  	<div class="container">

  		<?php
			$fatura->getfatura($account_name);
			foreach ($fatura->GetItens() as $fat) :
				$fatid = $fat['id'];
				$link = $fat['link'];
			?>

  			<div class="TableContainer">
  				<table class="Table1" cellpadding="0" cellspacing="0">
  					<div class="CaptionContainer">
  						<div class="CaptionInnerContainer">
  							<span class="CaptionEdgeLeftTop" style="background-image:url(layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
  							<span class="CaptionEdgeRightTop" style="background-image:url(layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
  							<span class="CaptionBorderTop" style="background-image:url(layouts/tibiarl/images/content/table-headline-border.gif)"></span>
  							<span class="CaptionVerticalLeft" style="background-image:url(layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
  							<div class="Text">Pic Pay Pedido: <?php echo $fat['ref']; ?></div>
  							<span class="CaptionVerticalRight" style="background-image:url(layouts/tibiarl/images/content/box-frame-vertical.gif)"></span>
  							<span class="CaptionBorderBottom" style="background-image:url(layouts/tibiarl/images/content/table-headline-border.gif)"></span>
  							<span class="CaptionEdgeLeftBottom" style="background-image:url(layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
  							<span class="CaptionEdgeRightBottom" style="background-image:url(layouts/tibiarl/images/content/box-frame-edge.gif)"></span>
  						</div>
  					</div>
  					<tr>
  						<td>
  							<div class="InnerTableContainer">
  								<table width="100%">
  									<tr>
  										<td class="LabelV">Pedido</td>
  										<td class="LabelV">Valor</td>
  										<td class="LabelV">Status</td>
  									</tr>

  									<tr>
  										<td><?php echo $fat['ref']; ?></td>
  										<td><?php echo $fat['valor']; ?></td>
  										<td><?php echo $fat['status']; ?></td>
  									</tr>
  								</table>
  							</div>
  						</td>
  					</tr>
  				</table>
  			</div>

  			<center>
			  	<button class="btn btn-link" onClick="pagar(<?= $fatid ?>)" id="btnPagar">
  					<div class="BigButton" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_green.gif); ">
  						<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
  							<div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_green_over.gif);"></div>
  							<span class="ButtonTextInputs">Pagar</span>

  						</div>
  					</div>
  				</button>
			</center>



  		<?php endforeach; ?>

  		<div class="modal fade" id="ModalPicpay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  			<div class="modal-dialog modal-dialog-centered" role="document">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h5 class="modal-title" id="exampleModalCenterTitle">Pagar com o PicPay</h5>
  						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					</div>
  					<div class="modal-body" id="">
  						<center>
  							<img style="width: 80%" class="img-responsive img-thumbnail" src="<?php echo $link; ?>" />
  					</div>
  					<div class="text-center">
  						<p>
  							Utilize o Aplicativo do PicPay e escaneie o Qr Code
  						</p>
  					</div>
  				</div>
  			</div>
  		</div>


  	<?php
	else :
		header('Location: ?subtopic=accountmanagement');
	endif;
