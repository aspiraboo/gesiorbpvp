<?php
include_once './config/config.php';
include_once './classes/conexao.php';
include_once './classes/paypal.php';

$paypal = new Paypal;
$total = number_format($_POST['valor'], 2);

//echo $total;

$account_name = $_POST['account_name'];
if($account_name == null){
	header('Location: /?subtopic=accountmanagement');
}	
else{


//echo $account_name. '<br>';
$nvp = $paypal->getNvp($total);
//var_dump($cupom->GetItens());
$curl = curl_init();
if ($config['payment']['paypal']['paypal_sand'] == true){
	curl_setopt( $curl , CURLOPT_URL , 'https://api-3t.sandbox.paypal.com/nvp' );
}
else{
	curl_setopt( $curl , CURLOPT_URL , 'https://api-3t.paypal.com/nvp' );

}
curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false );
curl_setopt( $curl , CURLOPT_RETURNTRANSFER , 1 );
curl_setopt( $curl , CURLOPT_POST , 1 );
curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );
$response = urldecode( curl_exec( $curl ) );
curl_close( $curl );
$responseNvp = array();
if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
	foreach ( $matches[ 'name' ] as $offset => $name ) {
		$responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
	}
}
if ( isset( $responseNvp[ 'ACK' ] ) && $responseNvp[ 'ACK' ] == 'Success' ) {
	if ($config['payment']['paypal']['paypal_sand'] == true){
		$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	}
	else{
		$paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
	}
	$query = array(
		'cmd'	=> '_express-checkout',
		'token'	=> $responseNvp[ 'TOKEN' ]
	);
    header( 'Location: ' . $paypalURL . '?' . http_build_query( $query ) );
$paypal->insertPaymentinDb($account_name,$total,$responseNvp['TOKEN']);
//$cupom->updateAccountInApprov('EC-5CD34069CK359131C');

} else {
	echo 'Método de pagamento em manutenção, por favor aguarde.';
}

}