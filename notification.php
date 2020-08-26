<?php
	
  /* Simples integração com PicPay
   * Arquivo de Notificação
   * @author: Script Mundo
   */
   
   
  /* Este arquivo deve estar configurado em sua callback url
   * para o PicPay posso enviar as requisições aqui.
   * O picpay irá esperar uma resposta HTTP 200 do seu site
   * Acesse a documentação do PicPay para ver mais detalhes.
   * https://ecommerce.picpay.com/doc/
   */
  
  // class PicPay	
	include_once('classes/conexao.php');
	include_once('classes/fatura.php');
	include_once('classes/picpay.php');
  
  $picpay = new PicPay;
  
  $fatura = new Fatura;
  
 

  
  
  // função que verifica a requisição
  $notification = $picpay->notificationPayment();
   //echo $notification->status;
	  if($notification){
		  
		  $status 	   	   = $notification->status;
		  $authorizationId = $notification->authorizationId;
		  $referenceId     = $notification->referenceId;
		  
		  
		  
		  
		  /* -- Tratar dados -- */
		  
		  switch($status):
			case "created" : $s = "Pendente"; break;
			case "expired" : $s = "Expirado"; break;
			case "analysis" : $s = "Pendente"; break;
			case "paid" : $s = "Pago"; break;
			case "completed" : $s = "Pago"; break;
			case "refunded" : $s = "Devolvido"; break;
			case "chargeback" : $s = "Pago com chargeback"; break;
		  
		  endswitch;
		  
		   
		  
		  
		  $update = $fatura->update($referenceId,$s);
		  
		  

	  }
	   
	 
 
 ?>