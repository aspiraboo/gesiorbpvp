<?php
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
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


if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 8000*1024)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
$errors = "yes";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$extensao = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
$extensao = strtolower($extensao);
$novoNome = uniqid ( time () ) . '.' . $extensao;
//echo $novoNome;
$targetPath = "upload/".$novoNome; // Target path where file is to be stored

move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
echo '
<div class="TableContainer">
<<div class="CaptionContainer">
<div class="CaptionInnerContainer">
												<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
												<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
												<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
												<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
												<div class="Text">Confirmar Pagamento 
												<button type="button" id="closeconfirmpay" class="close" data-dismiss="modal" aria-label="Fechar" style="color: rgba(255,255,255,1)">
												
												<span aria-hidden="true">&times;</span>
											  </button></div>
												<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
												<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
												<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
												<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
													</div>
														</div>
                            <div class="InnerTableContainer">
                            <div class="TableShadowContainerRightTop" >
								<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
												</div>
								<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
                            <div class="TableContentContainer" >

<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
<tr>
<td>
    
<div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
<div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
  <span class="swal2-success-line-tip" style="color: black;"></span>
  <span class="swal2-success-line-long" style="color: black;"></span>
  <div class="swal2-success-ring" style="color: black;"></div> 
  <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
  <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
  
 </div>
 <div class="text-center"> Comprovante enviado com sucesso.</div>
 </td>
 </tr>
 
 </table>
 </div>
 </div>
 <div class="TableShadowContainer" >
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
													</div>
																						</div>
 </div>
 </div>
 
 ';

 $errors = "no";
//echo $_POST['old'];
}
}
}
else
{
  $errors = "yes";
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}

$id = $_POST['id'];
if($errors == "no"){
  $pagamento = new Pagamento;
  $pagamento->updatePayment($id, $targetPath);

  }

//echo @$targetPath;


          

?>


<style>
.text-center{
    font-weight: bold;
    color:#008000;
}
.swal2-icon.swal2-success [class^=swal2-success-line]{
  display:block;
  position:absolute;
  height:.3125em;
  border-radius:.125em;
  background-color:#008000;
  z-index:2
}
.swal2-icon.swal2-success{
  border-color:#008000
}

.swal2-icon.swal2-success .swal2-success-ring{
  position:absolute;
  top:-.25em;
  left:-.25em;
  width:100%;
  height:100%;
  border:.25em solid rgba(165,220,134,.3);
  border-radius:50%;
  z-index:2;
  box-sizing:content-box
}
</style>