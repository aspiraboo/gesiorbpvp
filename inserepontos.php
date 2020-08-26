<?php
include 'classes/conexao.php';
include 'classes/pagamento.php';
 extract($_POST);

$pagamento = new Pagamento;

if($pagamento->GetUpdatePointsStatus($id,$pontos,$nome)):
echo '<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Pontos Adcionados</h4>
 Foram adcionados '.$pontos.' na account:
  <hr>
  <p class="mb-0">'.$nome.'.</p>
</div>';
else:

echo 'error';

endif;



echo "<script>setTimeout(function(){window.location.href='index.php?subtopic=adminpayment';},500);</script>";
 
