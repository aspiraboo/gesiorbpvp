$(document).ready(function () {
var BancoDoBrasilInv = $("#BancoDoBrasilInv");
    // $('#BtnBancoBrasil').click(function() {
    //     var valoBancoBrasil = $("#valoBancoBrasil").val();
    //     var dados = {
    //         valoBancoBrasil: valoBancoBrasil,
    //     }
    // $.post("payment23132.php", dados , function(retorna){
    //         //Subtitui o valor no seletor id="conteudo"
    //         $("#metodopaymentinv").html(retorna);
    //         //$("#carregando2").hide();

    // });
    // //alert("oi");
    // });

    //BancoDoBrasilInv.hide();


    //Verificação inputs
    $("#valoBancoBrasil").on('input', function(){
       var valoBancoBrasil =  $("#valoBancoBrasil");
       if (valoBancoBrasil.val() > 1000){
            $("#BtnConfirmBrasil").attr('disabled', true);
            $("#BancoDoBrasilInv").html("Valor precisa ser menor que R$ 1000,00.");
            valoBancoBrasil.attr('class', 'form-control is-invalid form-control-sm');            
       }else if(valoBancoBrasil.val() < 10){
            $("#BtnConfirmBrasil").attr('disabled', true);
            $("#BancoDoBrasilInv").html("Valor precisa ser maior ou igual a R$ 10,00.");
            valoBancoBrasil.attr('class', 'form-control is-invalid form-control-sm');            

       }
       else{
            valoBancoBrasil.attr('class', 'form-control is-valid form-control-sm');            
            $("#BtnConfirmBrasil").attr('disabled', false);
            $("#BancoDoBrasilInv").html("");
       }
    });

    $("#valoBancoNubank").on('input', function(){
       var valoNubank =  $("#valoBancoNubank");

       if (valoNubank.val() > 1000){
            $("#BtnConfirmNubank").attr('disabled', true);
            $("#NubankInv").html("Valor precisa ser menor que R$ 1000,00.");
            valoNubank.attr('class', 'form-control is-invalid form-control-sm');            
       }else if(valoNubank.val() < 10){
            $("#BtnConfirmNubank").attr('disabled', true);
            $("#NubankInv").html("Valor precisa ser maior ou igual a R$ 10,00.");
            valoNubank.attr('class', 'form-control is-invalid form-control-sm');            

       }
       else{
            valoNubank.attr('class', 'form-control is-valid form-control-sm');            
            $("#BtnConfirmNubank").attr('disabled', false);
            $("#NubankInv").html("");
       }
    });

    $("#valorItau").on('input', function(){
        var valorItau =  $("#valorItau");
        if (valorItau.val() > 1000){
             $("#BtnConfirmItau").attr('disabled', true);
             $("#ItauInv").html("Valor precisa ser menor que R$ 1000,00.");
             valorItau.attr('class', 'form-control is-invalid form-control-sm');            
        }else if(valorItau.val() < 10){
             $("#BtnConfirmItau").attr('disabled', true);
             $("#ItauInv").html("Valor precisa ser maior ou igual a R$ 10,00.");
             valorItau.attr('class', 'form-control is-invalid form-control-sm');            
 
        }
        else{
            valorItau.attr('class', 'form-control is-valid form-control-sm');            
             $("#BtnConfirmItau").attr('disabled', false);
             $("#ItauInv").html("");
        }
     });
     $("#valorCaixa").on('input', function(){
        var valorCaixa =  $("#valorCaixa");
        if (valorCaixa.val() > 1000){
             $("#BtnConfirmCaixa").attr('disabled', true);
             $("#CaixaInv").html("Valor precisa ser menor que R$ 1000,00.");
             valorCaixa.attr('class', 'form-control is-invalid form-control-sm');            
        }else if(valorCaixa.val() < 10){
             $("#BtnConfirmCaixa").attr('disabled', true);
             $("#CaixaInv").html("Valor precisa ser maior ou igual a R$ 10,00.");
             valorCaixa.attr('class', 'form-control is-invalid form-control-sm');            
 
        }
        else{
            valorCaixa.attr('class', 'form-control is-valid form-control-sm');            
             $("#BtnConfirmCaixa").attr('disabled', false);
             $("#CaixaInv").html("");
        }
     });

     /// Formularios

    $('#formBancoBrasil').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",            
            url: 'submitpay.php',        
            data: $(this).serialize(),
            success: function(response)
            {
                $("#metodopaymentinv").html(response);
                $("#loadConfirmPaymentDiv").fadeOut("slow").load("loadlistpayment.php").fadeIn("slow");  
            }

          });
     });
     
      $('#formNubank').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",            
            url: 'submitpay.php',        
            data: $(this).serialize(),
            success: function(response)
            {
                $("#metodopaymentinv").html(response);
                $("#loadConfirmPaymentDiv").fadeOut("slow").load("loadlistpayment.php").fadeIn("slow");  
            }

          });
     });

     $('#formBancoItau').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",            
            url: 'submitpay.php',        
            data: $(this).serialize(),
            success: function(response)
            {
                $("#metodopaymentinv").html(response);
                $("#loadConfirmPaymentDiv").fadeOut("slow").load("loadlistpayment.php").fadeIn("slow");  
            }

          });
     });

    $('#formBancoCaixa').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",            
            url: 'submitpay.php',        
            data: $(this).serialize(),
            success: function(response)
            {
                $("#metodopaymentinv").html(response);
                $("#loadConfirmPaymentDiv").fadeOut("slow").load("loadlistpayment.php").fadeIn("slow");  
            }

          });
     });
       


});

function carrega(id){
    $("#spinnerMetodo").show();
    $("#metodopaymentinv").hide();
    $("#metodopaymentinv").fadeOut("slow").load("payment.php?method="+id, function(){
    $("#spinnerMetodo").hide();
    $("#metodopaymentinv").show();


    }).fadeIn("slow");
}

//  $("#loadConfirmPaymentDiv").load("loadlistpayment.php", function(){
//     $("#loadPaymentStatus").hide();
// });
var qnt_result_pg = 5; //quantidade de registro por página
			var pagina = 1; //página inicial
			$(document).ready(function () {
				listar_usuario2(pagina, qnt_result_pg); //Chamar a função para listar os registros
});
            
function listar_usuario2(pagina, qnt_result_pg){
    $("#loadPaymentStatus").show();
    //$('html, body').animate({scrollTop:0}, 'slow');
    //$("html, body").animate({scrollTop:0}, "fast");
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post("loadlistpayment.php", dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#loadConfirmPaymentDiv").html(retorna);
        $("#loadPaymentStatus").hide();


    });
}
