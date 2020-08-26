<?PHP
if(!defined('INITIALIZED'))
  exit;

if($action == '')
{
    $main_content .='
    <div id="ProgressBar">
        <div id="Headline">Getting Started</div>
        <div id="MainContainer">
            <div id="BackgroundContainer">
                <img id="BackgroundContainerLeftEnd" src="layouts/tibiarl/images/vips/stonebar-left-end.gif">
                <div id="BackgroundContainerCenter">
                    <div id="BackgroundContainerCenterImage" style="background-image: url(layouts/tibiarl/images/content/stonebar-center.gif);">
                    </div>
                </div>
                <img id="BackgroundContainerRightEnd" src="layouts/tibiarl/images/vips/stonebar-right-end.gif">
            </div>
            <img id="TubeLeftEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-left-blue.gif">
            <img id="TubeRightEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-right-blue.gif">
            <div id="FirstStep" class="Steps">
                <div class="SingleStepContainer">
                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-0-blue.gif">
                    <div class="StepText" style="font-weight: normal;">Donation Rules</div>
                </div>
            </div>
            <div id="StepsContainer1">
                <div id="StepsContainer2">
                    <div class="Steps" style="width: 33%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-1-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Payment method</div>
                        </div>
                    </div>
                    <div class="Steps" style="width: 33%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-2-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Request information</div>
                        </div>
                    </div>
                    <div class="Steps" style="width: 33.5%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-4-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Request realized</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="TableContainer">
        <div class="CaptionContainer">
            <div class="CaptionInnerContainer">
                <span class="CaptionEdgeLeftTop" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionEdgeRightTop" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionBorderTop" style="background-image: url(layouts/tibiarl/images/content/table-headline-border.gif);"></span>
                <span class="CaptionVerticalLeft" style="background-image: url(layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
                <div class="Text">Informações iniciais para sua doação.</div>
                <span class="CaptionVerticalRight" style="background-image: url(layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
                <span class="CaptionBorderBottom" style="background-image: url(layouts/tibiarl/images/content/table-headline-border.gif);"></span>
                <span class="CaptionEdgeLeftBottom" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionEdgeRightBottom" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
            </div>
        </div>
        <table class="Table1" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div class="InnerTableContainer">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td align="Justify">
                                            Informamos aos jogadores que o '.$config['server']['serverName'].' Alternate Tibia Server não possui interesse financeiro. Toda a renda obtida é diretamente reaplicada para a manutenção do servidor - isso significa que, ao fazer uma doação, você está garantindo estabilidade e aumentando a qualidade do servidor.</br></br>
                                            Os pontos que são passados aos jogadores que realizam as doações não são nada além de nossa gratificação, ou seja, você não está comprando pontos, mas recebendo uma gratificação simbólica (em forma de pontos) que irá beneficiar você no jogo; você pode usar seus pontos da maneira que quiser.</br></br>
                                            O espírito deste sistema é simples: para abordar os jogadores e fazer você se sentir em casa, entendemos sua doação como uma via de mão dupla na questão da credibilidade. Para acreditar que vale a pena investir na manutenção do servidor. Investimos em você creditando-os com pontos, que conforme mencionado acima, podem ser usados da maneira que melhor lhes convier.</br></br>
                                            Veja as <a href="?subtopic=serverinfo#vip">Vips Advantages</a> e <a href="?subtopic=shopsystem">'.$config['server']['serverName'].' Shop</a>.<br>Nosso servidor não é P2W. Todos os melhores itens você pode conseguir jogando.</br><br>
											<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
														<td>
														<b>REGRAS referentes ao sistema de doação:</b><br><br>
														&emsp;<b>1º)</b> O doador está ciente que a doação não pode ser devolvida.<br>
														&emsp;<b>2º)</b>O doador está ciente que não está comprando e sim, fazendo uma doação, e como forma de gratificação iremos adicionar as <b>Premium Points<small>(moeda virtual do jogo)</small></b> na conta do doador.<br><br>
														&emsp;<b>Se aceitar as regras informadas acima, clique em NEXT.<br>
														&emsp;Se não aceitar, NÃO PROSSIGA COM A DOAÇÃO!</b>
														</td>					
													</table>
												</div>
											</div>

                                            <h3>Perguntas frequentes</h3>
                                            <b>Mas o que são pontos premium?</b><br>
                                            Premium Points fazem parte do nosso sistema de doação, com eles você pode obter um VIP ou qualquer outra coisa que esteja disponível em <a href="?subtopic=shopsystem">'.$config['server']['serverName'].' Shop</a>.</br></br>

                                            <b>O que é uma conta VIP?</b><br>
                                            Uma Conta VIP traz algumas vantagens dentro e fora do jogo por um certo período de tempo. Para saber mais sobre as vantagens, visite a seção <a href="?subtopic=serverinfo#vip">Vips Advantages</a>.</br></br>

                                            <b>Como fazer uma doação?</b>
                                            <br>Clique em <b>"Next"</b> e siga todos os procedimentos para fazer sua doação.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><br>
    <center>
        <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="border: 0px none;">
                        <div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
                            <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                            <a href="?subtopic=donate&action=rules">
                                <input class="ButtonText" name="next" alt="next" onclick=location.href="index.php?subtopic=donate&action=rules" src="layouts/tibiarl/images/vips/_sbutton_next.gif" type="image">
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</center>
';
}
elseif($action == 'rules')
{
    if(!$logged) {
      $main_content .= 'You are not logged in. <a href="?subtopic=accountmanagement">Log in</a> first to make a donate.';
  }
  else
  {
    $main_content .='
    <div id="ProgressBar">
        <div id="Headline">Rules and Information</div>
        <div id="MainContainer">
            <div id="BackgroundContainer">
                <img id="BackgroundContainerLeftEnd" src="layouts/tibiarl/images/vips/stonebar-left-end.gif">
                <div id="BackgroundContainerCenter">
                    <div id="BackgroundContainerCenterImage" style="background-image: url(layouts/tibiarl/images/content/stonebar-center.gif);">
                    </div>
                </div>
                <img id="BackgroundContainerRightEnd" src="layouts/tibiarl/images/vips/stonebar-right-end.gif">
            </div>
            <img id="TubeLeftEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-left-green.gif">
            <img id="TubeRightEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-right-blue.gif">
            <div id="FirstStep" class="Steps">
                <div class="SingleStepContainer">
                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-0-green.gif">
                    <div class="StepText" style="font-weight: bold;">Donation Rules</div>
                </div>
            </div>
            <div id="StepsContainer1">
                <div id="StepsContainer2">
                    <div class="Steps" style="width: 33%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-1-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Payment method</div>
                        </div>
                    </div>
                    <div class="Steps" style="width: 33%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-2-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Request information</div>
                        </div>
                    </div>
                    <div class="Steps" style="width: 33.5%;">
                        <div class="TubeContainer">
                            <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                        </div>
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-4-blue.gif">
                            <div class="StepText" style="font-weight: normal;">Request realized</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="TableContainer">
        <div class="CaptionContainer">
            <div class="CaptionInnerContainer">
                <span class="CaptionEdgeLeftTop" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionEdgeRightTop" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionBorderTop" style="background-image: url(layouts/tibiarl/images/content/table-headline-border.gif);"></span>
                <span class="CaptionVerticalLeft" style="background-image: url(layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
                <div class="Text">Read Donations Rules</div>
                <span class="CaptionVerticalRight" style="background-image: url(layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
                <span class="CaptionBorderBottom" style="background-image: url(layouts/tibiarl/images/content/table-headline-border.gif);"></span>
                <span class="CaptionEdgeLeftBottom" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
                <span class="CaptionEdgeRightBottom" style="background-image: url(layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
            </div>
        </div>
        <table class="Table1" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div class="InnerTableContainer">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td valign="middle" width="25px;" align="Justify">
                                            <B>Antes de fazer uma doação, lembre-se de cumprir as regras atuais e ter conhecimento de todas as informações necessárias.</B>
                                            <br><br>
                                            <TEXTAREA ROWS="5" WRAP="physical" COLS="80" READONLY="true" style="width:100%; height:400px; resize: none;">
1. General

a) O '.$config['server']['serverName'].' é um servidor alternativo de Tibia customizado feito por Administrador, construído e executado dentro das regras vigentes que possibilitam o funcionamento do mesmo sem infringir nenhuma lei (seja ela nacional ou não).
b) Nosso servidor como qualquer outro Open Tibia Server, foi desenvolvido inteiramente utilizando software Open Source.
c) A Administração do '.$config['server']['serverName'].' trabalha pela sua estabilidade, entretando, não podemos impedir que erros venham a acontecer.
d) O histórico de doações está sendo salvado, ou seja, você nunca será esquecido.
e) O nome atribuído às trocas digitais - '.$config['server']['serverName'].' Shop - é totalmente fictícia; O '.$config['server']['serverName'].' não vende qualquer tipo de produto. Apenas damos Points/Coins em troca como forma de gratificação por ajudar o servidor a se manter online.
e) O '.$config['server']['serverName'].' é uma servidor sem fins lucrativos.
f) Todo o dinheiro depositado e creditado no servidor é diretamente aplicado em sua própria manutenção, isto é, todo o capital girado em torno do mesmo é diretamente canalizado para o rumo de sua autossuficiência.
g) Os Coins/Pontos que são entregues aos jogadores que efetuam as doações não representam nada, é apenas uma forma de gratificação pela ajuda para manter o servidor funcionando, isto é, você não está comprando pontos e sim recebendo uma gratificação simbólica de Coins/Pontos que te beneficie de alguma forma dentro do jogo.

2. Perdas e danos

a) Salve seu comprovante do deposito. É o único documento que comprova sua ajuda na manutenção do servidor.
b) Em caso de algum reset, todas as doações que foram feitas dentro de dois meses (contados a partir do dia do reset), serão totalmente recreditadas às contas dos jogadores. Lembre-se que a história da doação está sendo salva, mas você também precisa provar sua participação em doações.
c) Em caso de quedas e (ou) problemas que façam o '.$config['server']['serverName'].' fique offline no modo de segurança ou esperando por três dias consecutivos ou mais, os jogadores que escolherem cobrar seus pontos de tempo VIP serão creditados novamente da mesma forma, os dias perdidos (contados a partir do terceiro dia).
d) Em caso de paralisação inesperada de atividades, não haverá substituição ou recreditação de capital investido no servidor, uma vez que toda doação é enviada diretamente para manutenção. Neste caso, os jogadores serão notificados pelas informações do veículo (site oficial ou algum outro meio oficial de comunicação do servidor).
e) Em caso de paralisação pré-programada de atividades, os jogadores serão informados através das informações do veículo e da data em que o sistema de doação estará fora do ar.
f) O '.$config['server']['serverName'].' fornece e investe em segurança básica para o servidor, até você para mantê-lo seguro; ou seja, não é responsável por seus pertencens, personagens e contas.

3. Você está ciente de que
a) Doação é o ato ou efeito de doar.
b) Aquilo que se doa.
c) O doador está ciente que a doação não pode ser devolvida.
                                            </TEXTAREA>
                                            <br><br>
                                            As regras e informações definidas na caixa de diálogo acima podem ser modificadas sem aviso prévio.<br>Se você não concordar com a contratação da doação simples, por favor, não continue.
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>

            <table width="100%"><tbody><tr align="center"><td><table border="0" cellpadding="0" cellspacing="0">
                <tbody><tr><td style="border: 0px none;">
                  <a href="javascript:void();" onclick=location.href="?subtopic=donate">
                    <div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
                      <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
                      <input class="ButtonText" name="Back" alt="Back" src="layouts/tibiarl/images/vips/_sbutton_back.gif" type="image">

                  </div></div></a></td></tr><tr></tr></tbody></table></td>

                  <td><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="border: 0px none;">
                      <a href="javascript:void();" onclick=location.href="?subtopic=donate&action=pag_form"><div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
                        <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif); visibility: hidden;"></div>
                        <input class="ButtonText" name="Next" alt="Next" src="layouts/tibiarl/images/vips/_sbutton_next.gif" type="image">
                    </table></td></tr></tbody></table>';
                }
            }
            elseif($action == 'selectchar')
            {
             if(!$logged) {
                $main_content .= 'You are not logged in. <a href="?subtopic=accountmanagement">Log in</a> first to make a donate..';
            }
            else
            {

                $main_content .= '

                <h1>Selecione o player</h1><BR>
                <form action="index.php?subtopic=donate&action=pag_form" method=POST>
                   <table border="0" cellpadding="1" cellspacing="1" width="100%">
                     <tr bgcolor="#505050"><td colspan="2"><font color="#FFFFFF"><b>Select the character you want receive the donate.</b></font></td></tr>
                     <tr bgcolor="#D4C0A1"><td width="110"><b>Nome:</b></td><td width="550"><select name="buy_name">';
                        $players_from_logged_acc = $account_logged->getPlayersList();
                        if(count($players_from_logged_acc) > 0)
                        {
                          $players_from_logged_acc->orderBy('name');
                          foreach($players_from_logged_acc as $player)
                          {
                            $main_content .= '<option>'.$player->getName().'</option>';
                        }
                    }
                    else
                    {
                      $main_content .= 'Voce nсo tem nenhum char nessa account.';
                  }
                  $main_content .= '</table>
                  <br><center><input type="image" value="submit" src="layouts/tibiarl/images/buttons/sbutton_submit.gif"/>
              </form>';
          }


      }
      elseif($action == 'pag_form')
      {
         if(!$logged) {
            $main_content .= 'You are not logged in. <a href="?subtopic=accountmanagement">Log in</a> first to make a donate..';
        }
        else
        {
            $buy_name = stripslashes(urldecode($_POST['buy_name']));
            $main_content .= '
            <div id="ProgressBar">
                <div id="Headline">Payment method</div>
                <div id="MainContainer">
                    <div id="BackgroundContainer">
                        <img id="BackgroundContainerLeftEnd" src="layouts/tibiarl/images/vips/stonebar-left-end.gif">
                        <div id="BackgroundContainerCenter">
                            <div id="BackgroundContainerCenterImage" style="background-image: url(layouts/tibiarl/images/content/stonebar-center.gif);">
                            </div>
                        </div>
                        <img id="BackgroundContainerRightEnd" src="layouts/tibiarl/images/vips/stonebar-right-end.gif">
                    </div>
                    <img id="TubeLeftEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-left-green.gif">
                    <img id="TubeRightEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-right-blue.gif">
                    <div id="FirstStep" class="Steps">
                        <div class="SingleStepContainer">
                            <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-0-green.gif">
                            <div class="StepText" style="font-weight: normal;">Donation Rules</div>
                        </div>
                    </div>
                    <div id="StepsContainer1">
                        <div id="StepsContainer2">
                            <div class="Steps" style="width: 33%;">
                                <div class="TubeContainer">
                                    <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                </div>
                                <div class="SingleStepContainer">
                                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-1-green.gif">
                                    <div class="StepText" style="font-weight: bold;">Payment method</div>
                                </div>
                            </div>
                            <div class="Steps" style="width: 33%;">
                                <div class="TubeContainer">
                                    <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green-blue.gif">
                                </div>
                                <div class="SingleStepContainer">
                                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-2-blue.gif">
                                    <div class="StepText" style="font-weight: normal;">Request information</div>
                                </div>
                            </div>
                            <div class="Steps" style="width: 33.5%;">
                                <div class="TubeContainer">
                                    <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-blue.gif">
                                </div>
                                <div class="SingleStepContainer">
                                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-4-blue.gif">
                                    <div class="StepText" style="font-weight: normal;">Request realized</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>You are about to choose a payment method to your donation!<br><br>

	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Choose Payment Method</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table3" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>
	
	
	
	
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
            <TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
              <form action="index.php?subtopic=donate&action=tipo" method="POST"><input type="hidden" name="char_name" value="">  ';
               if ($config['site']['usePagseguro']) {
                $main_content .= '   <TR BGCOLOR=#D4C0A1>
                <TD><input type="radio" name="method" value="1" checked="checked"> PagSeguro - Cartão de crédito/boleto</TD>
            </TR>';
        }
        if ($config['site']['usePaypal']) {
          $main_content .= '
          <TR BGCOLOR="#505050">
            <TR BGCOLOR=#D4C0A1>
              <TD><input type="radio" name="method" value="2"> Paypal - Credit Cards/International Transactions</TD>
          </TR>';
      }
      if ($config['site']['useDeposit']) {
        $main_content .= '
        <TR BGCOLOR="#505050">
          <TR BGCOLOR=#D4C0A1>
            <TD><input type="radio" name="method" value="3"> Depósito bancário - Depósitos/DOCS/Transferências bancárias <b><small><font color="green">(Com Bonificação)</font></small></b></TD>
        </TR>';
    }

    if ($config['site']['useOnebip']) {
      $main_content .= '<TR BGCOLOR="#505050">
      <TR BGCOLOR=#D4C0A1>
        <TD><input type="radio" name="method" value="4"> Onebip - Crédito de celular/SMS</TD>
    </TR>';
}
if ($config['site']['useZaypay']) {
  $main_content .= '
  <TR BGCOLOR="#505050">
    <TR BGCOLOR=#D4C0A1>
      <TD><input type="radio" name="method" value="5"> ZayPay - Credit Cards/International Transactions</TD>
  </TR>';
}
if ($config['site']['useContenidopago']) {
    $main_content .= '
    <TR BGCOLOR="#505050">
      <TR BGCOLOR=#D4C0A1>
        <TD><input type="radio" name="method" value="6"> Contenidopago - Credit Cards/International Transactions</TD>
    </TR>';
}

$main_content .= '
</TABLE>
															</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>
	
	
	
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</tbody></table>
<br><table width="100%"><tbody><tr align="center"><td><table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td style="border: 0px none;">
  <a href="javascript:void();" onclick=location.href="?subtopic=donate&action=pag_form">
    <div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
      <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif);"></div>
      <input class="ButtonText" name="Continue" alt="Continue" src="layouts/tibiarl/images/vips/_sbutton_next.gif" type="image">

  </table></td></tr></tbody></table>';
}$_SESSION["nome"] = stripslashes(urldecode($_POST['method']));
}
elseif($action == 'tipo')
{
    if(!$logged) {
        $main_content .= 'You are not logged in. <a href="?subtopic=accountmanagement">Log in</a> first to make a donate..';
    }
    else
    {
        $buy_tipo = stripslashes(urldecode($_POST['method']));
        $main_content .= '
            <table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo">
                <tbody>
                    <div id="ProgressBar">
                        <div id="Headline">Request information</div>
                        <div id="MainContainer">
                            <div id="BackgroundContainer">
                                <img id="BackgroundContainerLeftEnd" src="layouts/tibiarl/images/vips/stonebar-left-end.gif">
                                <div id="BackgroundContainerCenter">
                                    <div id="BackgroundContainerCenterImage" style="background-image: url(layouts/tibiarl/images/content/stonebar-center.gif);">
                                    </div>
                                </div>
                                <img id="BackgroundContainerRightEnd" src="layouts/tibiarl/images/vips/stonebar-right-end.gif">
                            </div>
                            <img id="TubeLeftEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-left-green.gif">
                            <img id="TubeRightEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-right-blue.gif">
                            <div id="FirstStep" class="Steps">
                                <div class="SingleStepContainer">
                                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-0-green.gif">
                                    <div class="StepText" style="font-weight: normal;">Donation Rules</div>
                                </div>
                            </div>
                            <div id="StepsContainer1">
                                <div id="StepsContainer2">
                                    <div class="Steps" style="width: 33%;">
                                       <div class="TubeContainer">
                                         <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                     </div>
                                     <div class="SingleStepContainer">
                                         <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-1-green.gif">
                                         <div class="StepText" style="font-weight: normal;">Payment method</div>
                                     </div>
                                 </div>
                                 <div class="Steps" style="width: 33%;">
                                     <div class="TubeContainer">
                                         <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                     </div>
                                     <div class="SingleStepContainer">
                                         <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-2-green.gif">
                                         <div class="StepText" style="font-weight: bold;">Request information</div>
                                     </div>
                                 </div>
                                 <div class="Steps" style="width: 33.5%;">
                                    <div class="TubeContainer">
                                        <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green-blue.gif">
                                    </div>
                                    <div class="SingleStepContainer">
                                        <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-4-blue.gif">
                                        <div class="StepText" style="font-weight: normal;">Request realized</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>';
        if($buy_tipo == 1) {// donate form pagseguro.php
            include_once 'donate_forms/pagseguro.php';
        }
        else if($buy_tipo == 2) {// donate form paypal.php
            include_once 'donate_forms/paypal.php';
        }
        else if($buy_tipo == 3) {// donate form deposito.php
            include_once 'donate_forms/deposito.php';
        }
        else if($buy_tipo == 4) {// donate form onebip.php
            include_once 'donate_forms/onebip.php';
        }
        else if($buy_tipo == 5) {// donate form 
            include_once '';
        }
        else if($buy_tipo == 6){// donate form contenidopago.php
            include_once 'donate_forms/contenidopago.php';
        }

        $main_content .= '
            </tbody></table><br><br>
            </tbody></table><br>
            <table width="100%"><tbody><tr align="center"><td><table border="0" cellpadding="0" cellspacing="0">
            <tbody><tr><td style="border: 0px none;">
            </div></div></a></td></tr><tr></tr></tbody></table></td><td><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="border: 0px none;">
            <a href="javascript:void();" onclick=location.href="?subtopic=donate&action=pag_form"><div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
                <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif); visibility: hidden;"></div>
                <input class="ButtonText" name="Back" alt="Back" src="layouts/tibiarl/images/vips/_sbutton_back.gif" type="image">
            </table></td></tr></tbody></table>';
    }
}
elseif($action == 'final') {
    $main_content .= '
            <table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo">
                <tbody>
                    <div id="ProgressBar">
                        <div id="Headline">Request information</div>
                        <div id="MainContainer">
                            <div id="BackgroundContainer">
                                <img id="BackgroundContainerLeftEnd" src="layouts/tibiarl/images/vips/stonebar-left-end.gif">
                                <div id="BackgroundContainerCenter">
                                    <div id="BackgroundContainerCenterImage" style="background-image: url(layouts/tibiarl/images/content/stonebar-center.gif);">
                                    </div>
                                </div>
                                <img id="BackgroundContainerRightEnd" src="layouts/tibiarl/images/vips/stonebar-right-end.gif">
                            </div>
                            <img id="TubeLeftEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-left-green.gif">
                            <img id="TubeRightEnd" src="layouts/tibiarl/images/vips/progress-bar-tube-right-green.gif">
                            <div id="FirstStep" class="Steps">
                                <div class="SingleStepContainer">
                                    <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-0-green.gif">
                                    <div class="StepText" style="font-weight: normal;">Donation Rules</div>
                                </div>
                            </div>
                            <div id="StepsContainer1">
                                <div id="StepsContainer2">
                                    <div class="Steps" style="width: 33%;">
                                       <div class="TubeContainer">
                                         <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                     </div>
                                     <div class="SingleStepContainer">
                                         <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-1-green.gif">
                                         <div class="StepText" style="font-weight: normal;">Payment method</div>
                                     </div>
                                 </div>
                                 <div class="Steps" style="width: 33%;">
                                     <div class="TubeContainer">
                                         <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                     </div>
                                     <div class="SingleStepContainer">
                                         <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-2-green.gif">
                                         <div class="StepText" style="font-weight: bold;">Request information</div>
                                     </div>
                                 </div>
                                 <div class="Steps" style="width: 33.5%;">
                                    <div class="TubeContainer">
                                        <img class="Tube" src="layouts/tibiarl/images/vips/progress-bar-tube-green.gif">
                                    </div>
                                    <div class="SingleStepContainer">
                                        <img class="StepIcon" src="layouts/tibiarl/images/vips/progress-bar-icon-4-green.gif">
                                        <div class="StepText" style="font-weight: normal;">Request realized</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/><br/><br/>
                <center>
                Thank you for your donation!<br/>
                When our systems confirm your donation will be automatically added points in your account as a thank you.<br/>
                Continue contributing to our server reporting bugs in the forum.<br/><br/>

                Have fun!<br/><br/><br/>
            </tbody></table><br><br>
            </tbody></table><br>
            <table width="100%"><tbody><tr align="center"><td><table border="0" cellpadding="0" cellspacing="0">
            <tbody><tr><td style="border: 0px none;">
            </div></div></a></td></tr><tr></tr></tbody></table></td><td><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="border: 0px none;">
            <a href="javascript:void();" onclick=location.href="/"><div class="BigButton" style="background-image: url(layouts/tibiarl/images/buttons/sbutton.gif);">
                <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(layouts/tibiarl/images/buttons/sbutton_over.gif); visibility: hidden;"></div>
                <input class="ButtonText" name="Back" alt="Back" src="layouts/tibiarl/images/vips/_sbutton_back.gif" type="image">
            </table></td></tr></tbody></table>';
}
?>

