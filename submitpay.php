<?php 
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);



define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if(!defined('ONLY_PAGE'))
	define('ONLY_PAGE', false);
	
// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if(DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

// LOGIN
if(!ONLY_PAGE)
	include_once('./system/load.login.php');
// LOGIN END

// COMPAT
// some parts in that file can be blocked because of ONLY_PAGE constant
include_once('./system/load.compat.php');
// COMPAT END

// LOAD PAGE
include_once('./system/load.page.php'); 

$pagamento = new Pagamento;

if(isset($_POST['valoBancoBrasil']) && $_POST['AccountBancoBrasil']){
    $valoBancoBrasil =  $_POST['valoBancoBrasil'];
    $AccountBancoBrasil = $_POST['AccountBancoBrasil'];
    $TypeBrasil = $_POST['TypeBrasil'];

    if ($valoBancoBrasil >= 1000){
        exit('O valor não pode ser maior que R$ 1000,00');
    }
    elseif($valoBancoBrasil <= 9){
        exit('O valor não pode ser menor que R$ 10,00');
    }
    else{

        if($pagamento->InsertPaymentNew($AccountBancoBrasil, $TypeBrasil, $valoBancoBrasil)){
            echo '
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
                     <div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <span class="swal2-success-line-tip" style="color: black;"></span>
                     <span class="swal2-success-line-long" style="color: black;"></span>
                     <div class="swal2-success-ring" style="color: black;"></div> 
                     <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
                     </div>
                     <div class="text-center text-success"> Pagamento Solicitado<br>
                     Para confirmar seu pagamento logue em sua conta e clique em <i>confirmar doação</i>.
                     </div>
            ';
            
        }
        else{
            echo '
            <div id="loadMsgCreateCharError" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                     <span class="swal2-x-mark">
                     <span class="swal2-x-mark-line-left"></span>
                     <span class="swal2-x-mark-line-right"></span></span>
                     </div>
            ';
        }

    }
}

if(isset($_POST['valorItau']) && $_POST['AccountItau']){
    $valorItau =  $_POST['valorItau'];
    $AccountItau = $_POST['AccountItau'];
    $TypeItau = $_POST['TypeItau'];

    if ($valorItau >= 1000){
        exit('O valor não pode ser maior que R$ 1000,00');
    }
    elseif($valorItau <= 9){
        exit('O valor não pode ser menor que R$ 10,00');
    }
    else{

        if($pagamento->InsertPaymentNew($AccountItau, $TypeItau, $valorItau)){
            echo '
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
                     <div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <span class="swal2-success-line-tip" style="color: black;"></span>
                     <span class="swal2-success-line-long" style="color: black;"></span>
                     <div class="swal2-success-ring" style="color: black;"></div> 
                     <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
                     </div>
                     <div class="text-center text-success"> Pagamento Solicitado<br>
                     Para confirmar seu pagamento logue em sua conta e clique em <i>confirmar doação</i>.
                     </div>
            ';
            
        }
        else{
            echo '
            <div id="loadMsgCreateCharError" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                     <span class="swal2-x-mark">
                     <span class="swal2-x-mark-line-left"></span>
                     <span class="swal2-x-mark-line-right"></span></span>
                     </div>
            ';
        }

    }
}

if(isset($_POST['valorCaixa']) && $_POST['AccountCaixa']){
    $valorCaixa =  $_POST['valorCaixa'];
    $AccountCaixa = $_POST['AccountCaixa'];
    $TypeCaixa = $_POST['TypeCaixa'];

    if ($valorCaixa >= 1000){
        exit('O valor não pode ser maior que R$ 1000,00');
    }
    elseif($valorCaixa <= 9){
        exit('O valor não pode ser menor que R$ 10,00');
    }
    else{

        if($pagamento->InsertPaymentNew($AccountCaixa, $TypeCaixa, $valorCaixa)){
            echo '
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
                     <div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <span class="swal2-success-line-tip" style="color: black;"></span>
                     <span class="swal2-success-line-long" style="color: black;"></span>
                     <div class="swal2-success-ring" style="color: black;"></div> 
                     <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
                     </div>
                     <div class="text-center text-success"> Pagamento Solicitado<br>
                     Para confirmar seu pagamento logue em sua conta e clique em <i>confirmar doação</i>.
                     </div>
            ';
            
        }
        else{
            echo '
            <div id="loadMsgCreateCharError" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                     <span class="swal2-x-mark">
                     <span class="swal2-x-mark-line-left"></span>
                     <span class="swal2-x-mark-line-right"></span></span>
                     </div>
            ';
        }

    }
}


if(isset($_POST['valoBancoNubank']) && $_POST['AccountNubank']){
    $valoBancoNubank =  $_POST['valoBancoNubank'];
    $AccountNubank = $_POST['AccountNubank'];
    $TypeNubank = $_POST['TypeNubank'];

    if ($valoBancoNubank >= 1000){
        exit('O valor não pode ser maior que R$ 1000,00');
    }
    elseif($valoBancoNubank <= 9){
        exit('O valor não pode ser menor que R$ 10,00');
    }
    else{

        if($pagamento->InsertPaymentNew($AccountNubank, $TypeNubank, $valoBancoNubank)){
            echo '
            <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
                     <div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <span class="swal2-success-line-tip" style="color: black;"></span>
                     <span class="swal2-success-line-long" style="color: black;"></span>
                     <div class="swal2-success-ring" style="color: black;"></div> 
                     <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
                     </div>
                     <div class="text-center text-success"> Pagamento Solicitado<br>
                     Para confirmar seu pagamento logue em sua conta e clique em <i>confirmar doação</i>.
                     </div>
            ';
            
        }
        else{
            echo '
            <div id="loadMsgCreateCharError" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                     <span class="swal2-x-mark">
                     <span class="swal2-x-mark-line-left"></span>
                     <span class="swal2-x-mark-line-right"></span></span>
                     </div>
            ';
        }

    }
}



