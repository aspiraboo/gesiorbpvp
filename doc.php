<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
 extract($_POST);

?>
	<table class="table">
  <thead class="thead-dark">
			<tr>
				<form method="post">
					<th scope="col">ID:</th>
					<th scope="col">Account Name:</th>
					<th scope="col">Valor:</th>
					<th scope="col">Pontos:</th>
					<th scope="col">Action:</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="hidden" id="id" name="id" value="<?php echo $id;?>"><?php echo $id;?></td>
				<td><input type="hidden" id="nome" name="nome" value="<?php echo $nome;?>"><?php echo $nome;?></td>
				<td><?php echo $valor;?></td>
				<td><input type="text" class ="form-control" id="pontos"></td>
				<td><input type="submit" id="send" value="ADD" class="btn btn-secondary btn-sm"></td>
			</tr>
		</tbody>
	</table>
	
	<script type='text/javascript'>
						$('#send').click(function() {
						$.post('./inserepontos.php', {
						id: $('#id').val(),
						nome: $('#nome').val(),
						pontos: $('#pontos').val()
						},  
						function( data ) {
							$( '#a' ).html( data );
						});
						});
					</script>