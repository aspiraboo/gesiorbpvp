<script src="donates.js"></script>
<?php

error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);



define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if (!defined('ONLY_PAGE'))
  define('ONLY_PAGE', false);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if (DEBUG_DATABASE)
  Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

// LOGIN
if (!ONLY_PAGE)
  include_once('./system/load.login.php');
// LOGIN END

// COMPAT
// some parts in that file can be blocked because of ONLY_PAGE constant
include_once('./system/load.compat.php');
// COMPAT END

// LOAD PAGE
include_once('./system/load.page.php');

if ($logged) { ?>


  <?php if ($_GET['method'] == "Paygol") : ?>


    <center>

      <img src="https://s3.amazonaws.com/files.enjin.com/950672/paygol.png" title="Paygol Image">
      <!-- PayGol JavaScript -->
      <script src="http://www.paygol.com/micropayment/js/paygol.js" type="text/javascript"></script>

      <!-- PayGol Form -->
      <form name="pg_frm" method="post" action="paygol.php"><br>
        <table class="tableunline" style="width: 95%" border="0" cellpadding="4" cellspacing="1">

          <tr class="color">
            <td colspan=""><strong></strong></td>
          </tr>

          <tr bgcolor="#505050">
            <td><b>
                <font color="white">Paygol Donate</font>
              </b><br /></td>
          </tr>

          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td>
              Paygol is automatic, when payout the points will automatic in your account.
            </td>
          </tr>

          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td>
              Yout account name: <strong><?= $account_logged->getName(); ?> </strong>.<p>
                <input type="hidden" name="pg_custom" value="<?= $account_logged->getName(); ?>">
                <p>
                  <input type="hidden" name="id_acc" value="<?= $account_logged->getId(); ?>">
                  <p>
                    <input type="hidden" name="sort" value="<?= (int)date('ymdHism') . (int)$account_logged->getId() ?>">
                    <p>
                      <label>Digite o valor:</label>
                      <input type="number" name="pg_price" value="" placeholder="Digite o valor"><br>


    </center>
    </td>
    </tr>
    <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
      <td><input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg" name="pg_button" /> </td>

    </tr>
    </table>
    </form>

  <?php endif; ?>


  <?php
  if ($_GET['method'] == "BancodoBrasil") { // Voc~s tem banco do brasil? 
  ?>
    <form id="formBancoBrasil" method="post">
      <center> <img src="images/brasil.jpeg" width="380" height="78"></center><br><br>
      <table border="0" cellspacing="1" cellpadding="4" width="100%">
        <tr bgcolor="#505050">
          <td colspan="1" class="white">
            <center><b>Informa&ccedil;&otilde;es da Conta</b></center>
          </td>
        </tr>
        <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
          <td>
            Titular: Seu nome/Your name<br>
            CPF: 000.000.000-00<br>
            Banco: Banco do Brasil<br>
            Variação: 51<br>
            Agência: 0000-0<br>
            Conta Poupança: 00000-0<br><br><br><b>1 premium point = 1R$ </br>(ou de acordo com a atual promoção, <font color="red">caso</font> esteja havendo alguma)</b><br>
        <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
          <td>
            Valor<br>
            <input type="text" class="form-control form-control-sm" name="AccountBancoBrasil" id="AccountBancoBrasil" style="width: 50%" value="<?php echo $account_logged->getName(); ?>" readonly>
            <input type="number" class="form-control form-control-sm" name="valoBancoBrasil" id="valoBancoBrasil" min="1" placeholder="Digite o valor da doação." style="width: 50%" required>
            <div id="BancoDoBrasilInv" style="color:red; font-size: 10px"></div><br>
            <button class="btn btn-link" id="BtnConfirmBrasil">
              <div class="BigButton" id="" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton.gif)">
                <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
                  <div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                  <input id="TypeBrasil" name="TypeBrasil" type="hidden" value="Banco Do Brasil">
                  <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiarl/images/buttons/_sbutton_submit.gif">
                </div>
              </div>
            </button>
          </td>
        </tr>


        <br>
        </tr>


        </td>
        </tr>


      </table>
    </form>
  <?php

  } elseif ($_GET['method'] == "Caixa") {
  ?>
    <form id="formBancoCaixa" method="post">
      <center> <img src="images/caixa.png" width="160" height="50"></center><br><br>
      <table border="0" cellspacing="1" cellpadding="4" width="100%">
        <tr bgcolor="#505050">
          <td colspan="1" class="white">
            <center><b>Informa&ccedil;&otilde;es da Conta</b></center>
          </td>
        </tr>
        <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
          <td>
            Titular:<br>
            CPF:<br>
            Banco: Caixa Econômica<br>
            Conta: Poupança<br>
            Agência: <br>
            Variação: <br>
            Conta Poupança: <br><br><br><b>1 premium point = 1R$ </br>(ou de acordo com a atual promoção, <font color="red">caso</font> esteja havendo alguma)</b><br><br>
        </tr>
        <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
          <td>
            Valor<br>
            <input type="text" class="form-control form-control-sm" name="AccountCaixa" id="AccountCaixa" style="width: 50%" value="<?php echo $account_logged->getName(); ?>" readonly>
            <input type="number" class="form-control form-control-sm" name="valorCaixa" id="valorCaixa" min="1" placeholder="Digite o valor da doação." style="width: 50%" required>
            <div id="CaixaInv" style="color:red; font-size: 10px"></div><br>
            <button class="btn btn-link" id="BtnConfirmCaixa">
              <div class="BigButton" id="" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton.gif)">
                <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
                  <div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                  <input id="TypeCaixa" name="TypeCaixa" type="hidden" value="Itau">
                  <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiarl/images/buttons/_sbutton_submit.gif">
                </div>
              </div>
            </button>
          </td>
        </tr>


        </td>
        </tr>

      </table>
    </form>
  <?php
  } elseif ($_GET['method'] == "MercadoPago") {
  ?>
    <center><img src="images/mercado.png" style="width:400px; height: 200px"></center><br>
    <form target="pagseguro" method="post" action="?subtopic=mpteste">
      <input type="hidden" name="reference" value="<?php echo $account_logged->getCustomField("name"); ?>">
      <input type="hidden" name="ref_cod_pedido" value="<?php echo (int)date('ymdHism') . (int)$account_logged->getId(); ?>">

      <table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo">
        <tbody>
          <tr bgcolor="#505050" class="white">
            <th colspan="2"><strong>Escolha a quantidade de pontos que deseja DONATAR.</strong></th>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td width="10%"></td>
            <td><strong><?php echo $account_logged->getCustomField("name"); ?></strong></td>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td width="10%">Pontos</td>
            <td><input name="itemCount" type="number" min="1" size="5" maxlength="5"></td>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td colspan="2">

              <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg" name="submit" />
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <script>
      $(document).ready(function() {
        var newcharvocation = $("input:checked").val();

      });
    </script>
  <?php
  } elseif ($_GET['method'] == "PagSeguro") {
  ?>
    <center><img src="images/pagseguro.png"></center><br>
    <form target="pagseguro" method="post" action="dntpagseguro.php">
      <input type="hidden" name="reference" value="<?php echo $account_logged->getCustomField("name"); ?>">
      <table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo">
        <tbody>
          <tr bgcolor="#505050" class="white">
            <th colspan="2"><strong>Escolha a quantidade de pontos que deseja DONATAR.</strong></th>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td width="10%">Sua conta</td>
            <td><strong><?php echo $account_logged->getCustomField("name"); ?></strong></td>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td width="10%">Pontos</td>
            <td><input name="itemCount" type="number" min="1" size="5" maxlength="5"></td>
          </tr>
          <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
            <td colspan="2">
              <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg" name="submit" />
            </td>
          </tr>
        </tbody>
      </table>
    </form>

  <?php
  } elseif ($_GET['method'] == "PicPay") {
  ?>
    <center><img src="https://static.wixstatic.com/media/12c7b1_b23928a1d27c43aa90adaca394206529~mv2_d_4822_2241_s_2.png/v1/crop/x_675,y_522,w_3448,h_1245/fill/w_429,h_156,al_c,usm_0.66_1.00_0.01/12c7b1_b23928a1d27c43aa90adaca394206529~mv2_d_4822_2241_s_2.png"></center><br>
    <table border="0" cellspacing="1" cellpadding="4" width="100%">
      <tr bgcolor="#505050">
        <td colspan="1" class="white">
          <center><b>Informa&ccedil;&otilde;es da Conta</b></center>
        </td>
      </tr>
      <tr bgcolor="<?php echo $config['site']['lightborder'] ?>">
        <td>

          <br><br><b>1 premium point = 1R$ </br>(ou de acordo com a atual promoção, <font color="red">caso</font> esteja havendo alguma)</b><br><br>
          Pagamentos via Pic Pay são entregues automaticamente.<br>

          <br>
          <?php

          $fatura = new Fatura;
          $fatura->getfatura2();
          foreach ($fatura->GetItens() as $lastref) :
            $lastrefs = $lastref['ref'];
          endforeach;


          ?>
          <form action="?subtopic=picpay" method="post" onsubmit="bloqueia23.disabled = true; return true;">
            <div class="row">
              <div class="col-sm-4">
                <input type="hidden" name="ref" class="form-control" value="<?php echo (int)date('ymdHism') ?>">
                <font size="2px">Account</font>
                <input type="text" name="account_name" class="form-control form-control-sm" value="<?php echo $account_logged->getName(); ?>" readonly>
              </div>
              <div class="col-sm-4">
                <font size="2px">Valor</font>
                <input type="number" name="valor" min="0" max="500" class="form-control form-control-sm" required>
              </div>

              <div class="col-sm-4" style="margin-top: 10px">

                <center>
                  <button class="btn btn-link" id="BtnConfirmBrasil">
                    <div class="BigButton" id="" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton.gif)">
                      <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
                        <div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                        <input id="TypeBrasil" name="TypeBrasil" type="hidden" value="Banco Do Brasil">
                        <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiarl/images/buttons/_sbutton_submit.gif">
                      </div>
                    </div>
                  </button>
                </center>
              </div>

            </div>
          </form>



        <?php
      } elseif ($_GET['method'] == "Paypal") {
        ?>
          <form method="post" action="first.php">
            <table class="" style="width: 100%; margin-top: 20px" bgcolor="<?php echo $config['site']['lightborder'] ?>">
              <tr>
                <td class="white" bgcolor="#505050" colspan="2"> <span style="margin-left: 4px;">Pay Pal</span> </td>
              </tr>
              <tr>
                <td class="borderleft" style="width:50%">

                  <div class="row">
                    <div class="col-sm-4">
                      <font size="2px"><strong>Account</strong></font>
                </td>
                <td class="borderleft">
                  <input type="hidden" name="account_name" class="form-control form-control-sm" value="<?php echo $account_logged->getName(); ?>">
                  <strong><?php echo $account_logged->getName(); ?></strong>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="borderleft" colspan="2">
                  Paypal is automatic, when payout the points will automatic in your account. </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label class=""><strong>Valor:</strong></label>
                  <input class="form form-control form-control-sm" name="valor" type="number" style="width: 50%;" /></td>
              </tr>
              <tr>
                <td colspan="2">

                  <span id="csd"></span><br>
                  <center>
                    <button class="btn btn-link" id="BtnConfirmBrasil">
                      <div class="BigButton" id="" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton.gif)">
                        <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
                          <div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                          <input id="TypeBrasil" name="TypeBrasil" type="hidden" value="Banco Do Brasil">
                          <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiarl/images/buttons/_sbutton_submit.gif">
                        </div>
                      </div>
                    </button>
                  </center>
                  </div>
                  <div class="col-sm-4">



                  </div>
                  </div>
                  </div>

                  </div>

                </td>
              </tr>
            </table>
          </form>

        <?php

      } elseif ($_GET['method'] == "Nubank") {
        ?>
          <form id="formNubank" method="post">
            <center> <img src="images/nubank.png" width="380" height="78"></center><br><br>
            <table border="0" cellspacing="1" cellpadding="4" width="100%">
              <tr bgcolor="#505050">
                <td colspan="1" class="white">
                  <center><b>Informa&ccedil;&otilde;es da Conta</b></center>
                </td>
              </tr>
              <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
                <td>
                  Titular: Seu nome/Your name<br>
                  CPF: 000.000.000-00<br>
                  Banco: Nu Pagamentos S.A.<br>
                  Agência: 0000<br>
                  Conta Corrente: 0000000-0<br><br><br><b>1 premium point = 1R$ </br>(ou de acordo com a atual promoção, <font color="red">caso</font> esteja havendo alguma)</b><br>
              <tr bgcolor="<?php echo $config['site']['lightborder']; ?>">
                <td>
                  Valor<br>
                  <input type="text" class="form-control form-control-sm" name="AccountNubank" id="AccountNubank" style="width: 50%" value="<?php echo $account_logged->getName(); ?>" readonly>
                  <input type="number" class="form-control form-control-sm" name="valoBancoNubank" id="valoBancoNubank" min="1" placeholder="Digite o valor da doação." style="width: 50%" required>
                  <div id="NubankInv" style="color:red; font-size: 10px"></div><br>
                  <button class="btn btn-link" id="BtnConfirmNubank">
                    <div class="BigButton" id="" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton.gif)">
                      <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);">
                        <div class="BigButtonOver" style="background-image:url(./layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                        <input id="TypeNubank" name="TypeNubank" type="hidden" value="Nubank">
                        <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiarl/images/buttons/_sbutton_submit.gif">
                      </div>
                    </div>
                  </button>
                </td>
              </tr>


              <br>
      </tr>


      </td>
      </tr>


    </table>
    </form>

  <?php
      }
  ?>
<?php
} else {
  header("Location: " . $_SERVER['"127.0.0.1"'] . "");
}
