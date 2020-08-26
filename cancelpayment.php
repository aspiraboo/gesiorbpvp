<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
 extract($_POST);

?>
	<table class="table">
  <thead class="thead-dark">
			<tr>
				<form method="post">
					<th scope="col">ID:</th>
					<th scope="col">Motivo do cancelamento:</th>
					<th scope="col">Action:</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="hidden" id="id" name="id" value="<?php echo $id;?>"><?php echo $id;?></td>
				<td><select id="motivo">
				<option value="Foto nao legivel.">Foto nao legivel.</option>
				<option value="Cancelamento da compra.">Cancelamento da compra.</option>
				<option value="Reembolso.">Reembolso.</option>
				<option value="Pagamento nao debitado.">Pagamento nao debitado.</option>
				<option value="Cartao clonado.">Cartao clonado.</option>
				
				</select></td>
				<td><input type="submit" id="cancelpay" value="ADD" class="btn btn-secondary btn-sm" onclick="location.reload();"></td>
			</tr>
		</tbody>
	</table>
	
	<script type='text/javascript'>
						$('#cancelpay').click(function() {
						$.post('cancelpaymentup.php', {
						id: $('#id').val(),
						motivo: $('#motivo').val()
						},  
						function( data ) {
							$( '#cancelpaymentup' ).html( data );
						});
						});
					</script>