function takeIdPayment(id){
    dados ={
        id: id,
    }
    $.post("pegapamento.php", dados, function(response){
        $("#pegaPagamentoShow").html(response);
        

    });
}

function takeIdPayment2(id){
    dados ={
        id: id,
    }
    $.post("aprovarpagamento.php", dados, function(response){
        $("#aprovarPagamentoModal").html(response);
        

    });
}


$(document).ready(function (e) {

   
    var qnt_result_pg = 5; //quantidade de registro por página
    var pagina = 1; //página inicial
    $(document).ready(function () {
        listar_usuario2(pagina, qnt_result_pg); //Chamar a função para listar os registros
});
    






    $("#btnConfirmPayBlock").attr("disabled", true);

    $("#formConfirPag").on('submit',(function(e) {


    var qnt_result_pg = 5; //quantidade de registro por página
    var pagina = 1; //página inicial
    e.preventDefault();

    $("#btnConfirmPayment").hide();
    $("#messageSubmitConfirm").empty();
    $('#loadSubmitConfirm').show();
    $.ajax({
    // beforeSend: function () {
    //         $("#carregando").html("<img src='http://i.stack.imgur.com/MnyxU.gif'>");
    //     },   
            url: "ajax_php_file.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
            $('#loadSubmitConfirm').hide();
            $("#aprovarPagamentoModal").html(data);
            $("#btnConfirmPayment").show();
            $("#btnConfirmPayBlock").attr("disabled", true);
            // $("#loadConfirmPaymentDiv").fadeOut("slow", function(){
            //     listar_usuario2(pagina, qnt_result_pg);  

            // }).fadeIn("slow");
            listar_usuario2(1, 5);  


            }
    }); 
    }));


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
    
    // Function to preview image after validation
    $(function() {
    $("#file").change(function() {
    $("#messageSubmitConfirm").empty(); // To remove the previous error message
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
    $('#previewing').attr('src','noimage.png');
    $("#messageSubmitConfirm").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
    $("#btnConfirmPayBlock").attr("disabled", true);
    
    return false;
    }
    else
    {
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);
    $("#btnConfirmPayment").show();
    }
    });
    });
    function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '250px');
    $('#previewing').attr('height', '230px');
    $("#btnConfirmPayBlock").attr("disabled", false);
    };
    });



    $("#newcharname").focusout(function(){

        
        var valorconfirm = $("#newcharname").val();
        var newcharsex = $("#newcharsex").val();
        //$('#newcharname').attr('class', 'form-control is-valid form-control-sm');
        if(valorconfirm == ""){
            $('#name_check').attr('class', 'text-danger').html('Please digit valid nick.');
            $('#newcharname').attr('class', 'form-control is-invalid form-control-sm');
            $("#btnCreateChar").attr("disabled", true);
            return;
        }
        else if(valorconfirm.length < 4){
            $('#name_check').attr('class', 'text-danger').html('Min caracteres is 4.');
            $('#newcharname').attr('class', 'form-control is-invalid form-control-sm');
            $("#btnCreateChar").attr("disabled", true);
            return;
        }
           $.ajax({
            type: "POST",
            url: 'createcharnew.php',         
            data: $(this).serialize(),
            // beforeSend: function () {
            //     $("#carregando").html("<img src='http://i.stack.imgur.com/MnyxU.gif'>");
            // },         
            
            success: function(response)            
            {
                //$("carregando").html("Requisição concluída");
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    $('#name_check').attr('class', 'text-success').html('Nick name valid.');
                    $('#newcharname').attr('class', 'form-control is-valid form-control-sm');
                    $("#btnCreateChar").attr("disabled", false);

                    //location.href = 'my_profile.php';
                }
                else if (jsonData.success == "2"){
                    $('#name_check').attr('class', 'text-danger').html('Please use only a-Z, - , \' and space.');
                    $('#newcharname').attr('class', 'form-control is-invalid form-control-sm');
                     $("#btnCreateChar").attr("disabled", true);

                }
                else
                {
                    $('#name_check').attr('class', 'text-danger').html('Nickname exist, choose other nickname.');
                    $('#newcharname').attr('class', 'form-control is-invalid form-control-sm');
                    $("#btnCreateChar").attr("disabled", true);
                    



                   
                }
           }
       });


    });


    $("input[name='newcharvocation']").change(function(){
        var newcharvocation = $( "input:checked" ).val();
        var newcharvocation1 = $("input[id='newcharvocation-1']").val();
        if(newcharvocation == ''){
            $("#loadMsgCreateChar").html("<span class='text-center text-danger'>Please select your vocation.</span>")
        }
        else if(newcharvocation == 1){
        $('#imgCreateCharSorc').attr('class', 'img-ms-form2');
        $('#imgCreateCharDruid').attr('class', 'img-ms-form');
        $('#imgCreateCharPaladin').attr('class', 'img-ms-form');
        $('#imgCreateCharKnight').attr('class', 'img-ms-form');


        }else if(newcharvocation == 2){
            $('#imgCreateCharDruid').attr('class', 'img-ms-form2');
            $('#imgCreateCharSorc').attr('class', 'img-ms-form');
            $('#imgCreateCharPaladin').attr('class', 'img-ms-form');
            $('#imgCreateCharKnight').attr('class', 'img-ms-form');
        }else if(newcharvocation == 3){
            $('#imgCreateCharSorc').attr('class', 'img-ms-form');
            $('#imgCreateCharDruid').attr('class', 'img-ms-form');
            $('#imgCreateCharPaladin').attr('class', 'img-ms-form2');
            $('#imgCreateCharKnight').attr('class', 'img-ms-form');
        }else if(newcharvocation == 4){
            $('#imgCreateCharSorc').attr('class', 'img-ms-form');
            $('#imgCreateCharDruid').attr('class', 'img-ms-form');
            $('#imgCreateCharPaladin').attr('class', 'img-ms-form');
            $('#imgCreateCharKnight').attr('class', 'img-ms-form2');
        }
        else{
            
        }
        //alert(newcharvocation);
        // if(newcharvocation == "1"){
        //   alert("Opa");
        // //$('#newcharvocation').attr('class', 'form-control is-invalid form-control-sm');
        
        // }


    });



    $(document).ready(function() {
        var newcharvocation = $( "input:checked" ).val();
        $('#formCreateChar').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                
                url: 'createcharnew2.php',
                beforeSend: function () {
                    $("#loadCreateChar").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
                },         
                
                data: $(this).serialize(),
                
                success: function(response)            
                {
                    //$("carregando").html("Requisição concluída");
                    var jsonData = JSON.parse(response);
     
                    // user is logged in successfully in the back-end
                    // let's redirect
                    if (jsonData.success == "1")
                    {
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateChar').show();
                        $("#newcharname").val('');
                        $('#loadMsgCreateCharError').hide();
                        $("#btnCreateChar").attr("disabled", true);


                        //alert("passou");
                        //location.href = 'my_profile.php';
                        $("#loadCharList").fadeOut("slow").load("loadListChar.php").fadeIn("slow");  

                    }
                    else if(jsonData.success == 'notDigit' && jsonData.success == 'charInvalid'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Digit your nick name");
                    }
                    else if(jsonData.success == 'existchar'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Nickname exist, choose other nickname.");
                    }
                    else if(jsonData.success == 'notDigit'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Please digit your nick name.");
                    }
                    else if(jsonData.success == 'noCharSex'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Please select your sex.");
                    }
                    else if(jsonData.success == 'noVocation'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Please select your vocation.");
                    }
                    else if(jsonData.success == 'noTown'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Please select your city.");
                    }
                    else if(jsonData.success == 'charInvalid'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Nick Name invaid.");
                    }
                    else if(jsonData.success == 'invalidCharSex'){
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Invalid sex.");
                    }

                    else
                    {
                        $('#loadCreateChar').html('');
                        $('#loadMsgCreateCharError').show();
                        $('#loadMsgCreateChar').hide();
                        $('#msgErrorCreateChar').html("Error. Can\'t create character. Probably problem with database. Try again or contact with admin.");
                    }
               }
           });
         });
    });