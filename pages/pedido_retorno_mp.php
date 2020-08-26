<?php
// objetodo template 
//phpinfo();

// verifico se tem um COD REF na URL, se não tiver não mostro nada
echo '<h3><center>Seu pedido foi registrado, será informado o status do pagamento por email.</center></h3>';
echo '<h5><center>Caso nesta tela não tenha informações sobre o pagamento, fique tranquilo que receberá email do MercadoPago informando seu status.</center></h5>';
if(isset($_GET['collection_id']) || isset($_GET['id']) ) :
   
    if(isset($_GET['collection_id'])):
	$cod = $_GET['collection_id'];
	elseif(isset($_GET['id'])):
	$cod = $_GET['id'];
	endif;
   
// pega a transação por REF apos ter efetuado a compra
$pag = new PagamentoMP();
$pag->Retorno($cod);

else:
    
    
endif;