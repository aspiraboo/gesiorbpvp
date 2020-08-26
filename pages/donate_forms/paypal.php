<?php

$main_content .= '
<h2>PayPal Payment</h2>
<h3><font color="darkred">English</font></h3>
<li> In the message box that appears on the paypal website, enter the name of your account.
<li> To avoid fraud, our management must validate your purchase.
<li> After you make the payment, Confirm by sending us a <a href="?subtopic=ticket">Ticket</a> with a <b>TAG: Donate</b>.
<li> <font color="red">In case of a chargeback, your account will be deleted and your items tracked.</font><br>

<h3><font color="darkred">Portuguese</font></h3>
<li> Na caixa de mensagem que aparece no site do paypal, insira o nome da sua conta.
<li> Para evitar fraudes, nossa administração deve validar sua compra.
<li> Depois de efetuar o pagamento, confirme enviando-nos um <a href="?subtopic=ticket">Ticket</a> com a <b>TAG: Donate</b>.
<li> <font color="red">Em caso de estorno, sua conta será excluída e seus itens rastreados.</font>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="AB6BZ93Q9YZ78">
<table>
<tr><td><input type="hidden" name="on0" value="Select Value:">Select Value:</td></tr><tr><td><select name="os0">
	<option value="20 Points -">20 Points - €5,00 EUR</option>
	<option value="45 Points -">45 Points - €10,00 EUR</option>
	<option value="69 Points -">69 Points - €15,00 EUR</option>
	<option value="92 Points">92 Points €20,00 EUR</option>
	<option value="137 Points">137 Points €30,00 EUR</option>
</select> </td></tr>
</table><br>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>
';
?>