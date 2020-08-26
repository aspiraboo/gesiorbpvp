<?php


$array = array(
'cli_nome' => '',
'cli_email' => '',
'cli_ddd' => '',
'cli_celular' => '',
'cli_cpf' => '',
'cli_endereco' => '',
'cli_numero' => '',
'cli_cep' => '',
);

$account_name = $account_logged->getName();




//$main_content .= $ref_cod_pedido;

$pagmp = new PagamentoMP();

$valor = (int)$_POST['itemCount'];

$ref_cod_pedido = (int)$_POST['ref_cod_pedido'];


$pagmp->VerificaID($ref_cod_pedido);
foreach($pagmp->GetItens() as $lista):
	$pedidoexist = $lista['ped_ref'];
endforeach;


if($ped_ref < 1){
	$sub = (int)date('ymdHism');
	
	$ref_cod_pedido = $ref_cod_pedido + $sub;



}

$pagamento = new Pagamento;
$pagamento->insertMercadoPago($account_name, $valor, $ref_cod_pedido);

//echo $ref_cod_pedido;
$pagmp->PagarMP($ref_cod_pedido, $valor, $array, $account_name);     
              

$main_content .= ' <center> '.$pagmp->btn_mp.' </center><br>' ;
              