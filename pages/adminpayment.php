<?php

include 'config/config.php';
header( 'content-type: text/html; charset=utf-8' );

$query = "SELECT * FROM comprovante where mensagem ='Pendente'";
$allcomps = "SELECT * FROM comprovante";
$select_comp = mysqli_query($SQLlink, $query);
$data= date("d/m/y");
$hora= date("H:i:s");
$select_allcomps = mysqli_query($SQLlink, $allcomps);
if($group_id_of_acc_logged >= $config['site']['access_admin_panel']){
?>
<style>
  overlink a:hover {
	  text-decoration:none;
	  
	  
  }
 #adminpaymentlink a{
	text-decoration:none;
	float: left;
	color:#e6e6e6;
 }
#adminpaymentlink a:hover{
	text-decoration:none;
	color:#e6e6e6;
 }	  
 
</style>



<html lang="en">
<head>
  <meta charset="UTF-8">
<head>
  <title>Sua Página</title>
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="<?= $layout_name ?>/css/bootstrap.css">
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<div id="adminpaymentlink" class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
  <input type="radio" name="options" id="option1" autocomplete="off" checked>
<a href="javascript:void(0);" onclick="document.getElementById('divteste').style.display='block'; document.getElementById('divteste2').style.display='none'" >Pagamentos</a></label>
</div>
<div id="divteste">
<body>
  <div id="Nowx">
   <table border="0" cellspacing="0" cellpadding="0" width="100%" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Account</th>
        <th>Valor</th>
        <th>Status</th>
        <th>Método</th>
        <th>Anexo</th>
        <th>ADD</th>
        <th>Cancelar</th>
      </tr>
    </thead>
    <tbody>
	
	
		<?php 
		
			$i = 1;
			while($linha = mysqli_fetch_array($select_comp)){
				$i++;
			
			echo '<tr><td>'.$linha['id'].'<input type="hidden" id="id'.$linha['id'].'" value="'.$linha['id'].'"></td>';
			
			echo '<td>'.$linha['nome'].'<input type="hidden" id="nome'.$linha['id'].'" value="'.$linha['nome'].'"></td>';
			echo '<td>'.$linha['valor'].'<input type="hidden" id="valor'.$linha['id'].'" value="'.$linha['valor'].'"></td>';
			echo '<td>'.$linha['mensagem'].'<input type="hidden" id="mensagem'.$linha['id'].'" value="'.$linha['mensagem'].'"></td>';
			echo '<td>'.$linha['metodo'].'<input type="hidden" id="metodo'.$linha['id'].'" value="'.$linha['metodo'].'"></td>';
			echo '<td><img id="myImg'.$i.'" src="'.$linha['anexo'].'" alt="" style="width:100%;max-width:50px"></td> 
			
			<div id="myModal'.$i.'" class="modal'.$i.'">
  <span class="close'.$i.'">&times;</span>
  <img class="modal-content" id="img'.$i.'">
  <div id="caption"></div>
</div>


<style>

#myImg'.$i.' {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
  z-index: 3000;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal'.$i.' {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3000; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
  z-index: 1000;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close'.$i.' {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close'.$i.':hover,
.close'.$i.':focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>


			 
<script>
// Get the modal
var modal = document.getElementById("myModal'.$i.'");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg'.$i.'");
var modalImg = document.getElementById("img'.$i.'");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close'.$i.'")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script> ';
			
			
			echo '<td><div class="overlink"><button class="btn btn-secondary btn-sm" id="enviar'.$linha['id'].'">Enviar</button></div></td>';
			echo '<td><center><a href="javascript:void(0);" id="cancel'.$linha['id'].'" style="a text-decoration: none;" ><i class="fa fa-trash" width="50" height="50"></i></a></center></td>';

			 
echo '</tr></div>';
?>


					<?php
			
			echo "<script type='text/javascript'>
						
						$('#enviar".$linha['id']."').click(function() {
						$.post('doc.php', {
						id: $('#id".$linha['id']."').val(), 
						nome: $('#nome".$linha['id']."').val(),
						valor: $('#valor".$linha['id']."').val(),
						mensagem: $('#mensagem".$linha['id']."').val(),
						metodo: $('#metodo".$linha['id']."').val()
						
						},  
				function( data ) {
				$( '#a' ).html( data );
			});
			});
					</script>	";
					
					echo "<script type='text/javascript'>
						
						$('#cancel".$linha['id']."').click(function() {
						$.post('cancelpayment.php', {
						id: $('#id".$linha['id']."').val(), 
						mensagem: $('#mensagem".$linha['id']."').val()
						
						},  
				function( data ) {
				$( '#cancel' ).html( data );
			});
			});
					</script>	";
					
			?>
<?php }

?>

    </tbody>
	<div id="a"></div>
	<div id="cancel"></div>	
	<div id="cancelpaymentup"></div>	
	</table>
	</div>
	</div>


<div id="divteste2" style="display:none;">
<body>
  <div id="Nowx">
   <table border="0" cellspacing="0" cellpadding="0" width="100%" id="myTable2">
    <thead>
      <tr>
        <th width="1%" align="center">ID</th>
        <th width="20%" align="center">Account</th>
        <th width="20%" align="center">Valor</th>
        <th width="20%" align="center">Status</th>
        <th width="20%" align="center">Método</th>
        <th width="50%" align="center">Anexo</th>
      </tr>
    </thead>
    <tbody>
	
	
		<?php 
		
			while($linha = mysqli_fetch_array($select_allcomps)){
			
			echo '<tr><td>'.$linha['id'].'<input type="hidden" id="id1'.$linha['id'].'" value="'.$linha['id'].'"></td>';
			
			echo '<td>'.$linha['nome'].'<input type="hidden" id="nome1'.$linha['id'].'" value="'.$linha['nome'].'"></td>';
			echo '<td>'.$linha['valor'].'<input type="hidden" id="valor'.$linha['id'].'" value="'.$linha['valor'].'"></td>';
			echo '<td>'.$linha['mensagem'].'<input type="hidden" id="mensagem1'.$linha['id'].'" value="'.$linha['mensagem'].'"></td>';
			echo '<td>'.$linha['metodo'].'<input type="hidden" id="metodo1'.$linha['id'].'" value="'.$linha['metodo'].'"></td>';?>
			<td><img src="<?php echo $linha['anexo'];?>" style="width:30%;cursor:zoom-in"
  onclick="document.getElementById('<?php echo 'print'.$linha['id'].''; ?>').style.display='block'"></td>
			 
 <?php
  

			 
echo '</tr></div>';
?>

<div id="<?php echo 'print'.$linha['id'].''; ?>" style="z-index: 600;" class="w3-modal" onclick="this.style.display='none'">
					<span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
					<div class="w3-modal-content w3-animate-zoom">
					<img src="<?php echo $linha['anexo'];?>" style="width:100%; z-index: 600;">
					</div>
					</div>
					<?php
	
					 }
			?>



    </tbody>	
	<div id="b"></div>
	</table>
	</div>
	</div>
	
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('#myTable').DataTable( {				
					"language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
				"sSearch": "Pesquisar",
				"sPrevious":     "Anterior",
				"sNext":         "Próxima",
				
				}
            
				} );
			});
		
$('.alert').alert()
		
</script>
<script>
	$(document).ready(function(){
				$('#myTable2').DataTable( {				
					"language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
				"sSearch": "Pesquisar",
				"sPrevious":     "Anterior",
				"sNext":         "Próxima",
				
				}
            
				} );
			});

</script>
<script>
function Reload() {
  location.reload();
}
</script>
		
  
  <style>
 .backbutton {
    position: absolute;
    padding: 10px;
    background: #505050;
    color: white !important;
    border-radius: 8px;
    border: 2px solid #505050;
    margin-bottom: 10px;
}

.backbutton:hover {
    background: #303030;
	text-decoration: none !important;
}

.monstername {
    display: block;
    font-size: 25px;
    width: 100%;
    text-align: center;
    float: left;
    box-sizing: border-box;
    padding-top: 10px;
    padding-bottom: 15px;
}

#myTable, #myTable2, .myTable {
    width: 100%;
    border: 2px solid #505050;
    border-radius: 8px;
    overflow: hidden;
}

.myTable td {
    padding: 8px;
}

.dataTables_wrapper .dataTables_length {
	margin: 10px;
}

.dataTables_wrapper .dataTables_length select {
	border: 2px solid #793d03;
	border-radius: 8px;
}

.dataTables_wrapper .dataTables_paginate {
    padding: 7px;
    margin: 10px;
    border-radius: 8px;
    border: 2px solid #793d03;
    background: white;
    display: block;
    width: 410px;
}

.dataTables_wrapper .dataTables_info {
    padding: 14px;
    margin: 10px;
    border-radius: 8px;
    border: 2px solid #793d03;
    background: white;
    display: block;
    width: 200px;
}

.dataTables_wrapper .dataTables_filter input {
	padding: 7px;
    width: 200px;
    margin: 10px;
    border-radius: 8px;
    border: 2px solid #793d03;
}

.outfitImg {
    background-position: center center;
    background-repeat: no-repeat;
    width: 64px;
    height: 64px;
    padding: 5px;
    position: relative;
    overflow: hidden;
    border: 2px solid rgba(121, 61, 3, 0.65);
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.46);
}

.outfitImg2 {
    background-position: center center;
    background-repeat: no-repeat;
    width: 64px;
    height: 64px;
    padding: 5px;
    position: relative;
}

.Content .BoxContent .Odd {
    background-color: #D4C0A1;
    padding: 2px;
}

.Content .BoxContent .Even {
    background-color: #F1E0C6;
    padding: 2px;
}

.sorting_1 a {
	font-size: 18px;
}

  </style>

</body>

<?php }

else 
	
 echo ' <div class="alert alert-danger" role="alert"><strong>
  Atenção, area reservada para administradores.!</strong>
</div>';