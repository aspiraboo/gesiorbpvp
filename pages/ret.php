<?php
include_once './classes/conexao.php';
include_once './classes/paypal.php';

$paypal = new Paypal;

if ( isset( $_GET[ 'token' ] ) ) {
	$token = $_GET[ 'token' ];
    $nvp = $paypal->getNvpRet($token);
    
	$curl = curl_init();
	//curl_setopt( $curl , CURLOPT_URL , 'https://api-3t.sandbox.paypal.com/nvp' ); //Link para ambiente de teste: https://api-3t.sandbox.paypal.com/nvp
	curl_setopt( $curl , CURLOPT_URL , 'https://api-3t.paypal.com/nvp' );
	curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false );
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , 1 );
	curl_setopt( $curl , CURLOPT_POST , 1 );
	curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );
	$response = urldecode( curl_exec( $curl ) );
	$responseNvp = array();
	if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
		foreach ( $matches[ 'name' ] as $offset => $name ) {
			$responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
		}
	}
	echo '<table class="tablebody"><tbody style="text-align:left;">
	<tr style="text-align:left;">
	<td class="tdbody" style="">Paypal payment. </td></tr></tbody></table><br>';

	echo '<table class="tableunline" id="effect" style="width: 90%; margin-left: 20px; margin-top: 20px">
	<tr>
	<td class="color" colspan="2"> <span style="margin-left: 4px;">Pay Pal</span> </td>
	</tr>
	<tr>
	<td colspan="2">';
	if ( isset( $responseNvp[ 'TOKEN' ] ) && isset( $responseNvp[ 'ACK' ] ) ) {
		if ( $responseNvp[ 'TOKEN' ] == $token && $responseNvp[ 'ACK' ] == 'Success' ) {
			$nvp[ 'PAYERID' ]							= $responseNvp[ 'PAYERID' ];
			$nvp[ 'PAYMENTREQUEST_0_AMT' ]				= $responseNvp[ 'PAYMENTREQUEST_0_AMT' ];
			$nvp[ 'PAYMENTREQUEST_0_CURRENCYCODE' ]		= $responseNvp[ 'PAYMENTREQUEST_0_CURRENCYCODE' ];
			$nvp[ 'METHOD' ]							= 'DoExpressCheckoutPayment';
			$nvp[ 'PAYMENTREQUEST_0_PAYMENTACTION' ]	= 'Sale';
			curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );
			$response = urldecode( curl_exec( $curl ) );
			$responseNvp = array();
			if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
				foreach ( $matches[ 'name' ] as $offset => $name ) {
					$responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
				}
			}
			if ( $responseNvp[ 'PAYMENTINFO_0_PAYMENTSTATUS' ] == 'Completed' ) {
				echo '<div class="alert alert-success">Parabéns, sua compra no valor de <strong> R$ '.$responseNvp[ 'PAYMENTINFO_0_AMT' ].' </strong>foi concluída com sucesso e os pontos ja foram adcionado em sua conta.</div>';

                if ($paypal->getVerifyPayment($token) == 'Waiting'):
                    $paypal->updateAccountInApprov($token, $responseNvp['PAYMENTINFO_0_PAYMENTSTATUS'], $account_logged->getName(), $responseNvp[ 'PAYMENTINFO_0_AMT' ]);
					//echo 'Update';					

                else:
                    //echo 'Sem Update';
                endif;
                //echo $token;
                //var_dump($paypal->GetItens());
            
               
			} else {
				$paypal->updateAccountInCancel($token, $responseNvp['PAYMENTINFO_0_PAYMENTSTATUS']);
				echo '<div class="alert alert-warning">Não foi possível concluir a transação</div>';
			}
		} else {
			$paypal->updateAccountInCancel($token, $responseNvp['PAYMENTINFO_0_PAYMENTSTATUS']);
			echo '<div class="alert alert-warning">Não foi possível concluir a transação</div>';
		}
	} else {
		$paypal->updateAccountInCancel($token, $responseNvp['PAYMENTINFO_0_PAYMENTSTATUS']);
		echo '<div class="alert alert-warning">Não foi possível concluir a transação</div>';
	}

	echo '</td></tr></table>';
	curl_close( $curl );
}