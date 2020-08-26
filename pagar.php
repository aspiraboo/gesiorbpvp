<?php 


session_start();

if(isset($_POST['id'])):


	$id = $_POST['id'];
	
		
	include_once('classes/conexao.php');
	include_once('classes/website.php');
	include_once('classes/picpay.php');
	include_once('classes/fatura.php');
	
	
	
	// $picpay = new PicPay;

	$fat = new Fatura;
	
	

	$fat->getfatura3($id);
	foreach($fat->GetItens() as $fatura):
	echo '<div class="row">
	   <div class="col-md-12 text-center">
	   
	   ';

	   echo '<img width="250" class="img-responsive img-thumbnail" src="'.$fatura['link'].'" />';
	   echo '</div>';
	   echo '</div>';
	
	
	   endforeach;
	  

endif;