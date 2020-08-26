function pagar(id){
	$("#btnPagar").prop('disabled', true);
	$.post('pagar.php',{id:id},function(data){
		$("#bodyModal").html(data);
		$("#ModalPicpay").modal('show');
		
	});
	
	setInterval(function(){
		$.post('verifica.php',{id:id},function(data){
				if(data == '1'){
				location.href="";
				}
		})
		},3000);
		
	
	
	$('#ModalPicpay').on('hide.bs.modal', function () {
	$("#btnPagar").prop('disabled', false);
	
});
	
}