<?php 

include 'config/config.php';
extract($_POST);

$query = "UPDATE comprovante set mensagem = 'Reprovada', motivo ='".$motivo."' where id = '$id'";
$execute = mysqli_query($SQLlink, $query);
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Comprovante id:<?php echo $id;?></strong>, foi cancelado. Pelo motivo:<?php echo $motivo;?>
  </button>
</div>