<div id="top_information" class="Box">
    <div class="Corner-tl" style="background-image:url(./layouts/tibiarl/images/content/corner-tl.gif);"></div>
    <div class="Corner-tr" style="background-image:url(./layouts/tibiarl/images/content/corner-tr.gif);"></div>
    <div class="Border_1" style="background-image:url(./layouts/tibiarl/images/content/border-1.gif);"></div>
    <div class="BorderTitleText" style="background-image:url(./layouts/tibiarl/images/content/title-background-green.gif);"></div>
    <div class="Border_2">
        <div class="Border_3">
            <div class="BoxContent" style="background-image:url(./layouts/tibiarl/images/content/scroll.gif); min-height: 90px;">
				<?php if($logged){?>
				<?php $accid = $account_logged->getId();?>
				<?php $q = $SQL->query("SELECT * FROM players WHERE account_id = {$accid}")->fetchAll();?>
				<?php $pid = ($q[0][0]); $pname = $q[0]['name']?>
				<?php $player = new Player();?>
				<?php $player->loadById($pid);?>
				<?php $currentMount = $player->getStorage(10002001 + 10);?>
				<?php }?>
				<style>
					.back_ti{						
						position: absolute;						
						left: 15px;
						top: 38px;
						background-image: url(/layouts/tibiarl/images/themeboxes/fundoacc.png);
						/* transform: scaleX(-1); */
						background-size: cover;
						background-repeat: no-repeat;
						width: 46%;
						height: 128px;
					}
					<?php if($logged){?>
					.wellcometext{
						position: relative;
						top: -60px;
						font-size: 1.9em;
						color: #fff;
						left: 121px;
					}

					.tioutfit{
						position: relative;
						background-image: <?php echo 'url("outfit.php?id=' . $player->getLookType() . '&addons=' . (($player->getLookType() >= 950 && $player->getLookType() <= 952) ? 0 : $player->getLookAddons()) . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&direction=3")' ?>;
						background-size: cover;
						width: 80px;
						height: 80px;
						top: -10px;
						left: 0px;						
					}
					<?php } ?>
					.tilogintext{
						position: relative;
						color: #ead8a6 !important;
						text-decoration: none !important;
						left: 40;
						top: 40px;
						text-transform: uppercase;
					}
					.ticreateacctext{
						position: relative;
						color: #ead8a6 !important;
						text-decoration: none !important;
						font-size: 1.8em;
						left: 69px;
						top: 40px;
						text-transform: uppercase;
					}
					.tilostacctext{
						position: relative;
						color: #da7f32 !important;
						text-decoration: none !important;
						left: 119px;
						top: 44px;
						float: left;
						/* width: 28px; */
						text-transform: uppercase;
					}
					.Hti1{position: absolute; text-transform:uppercase; left: 403px;background-image: url(/images/fundo_ti/title.png);background-size: 100%;background-repeat: no-repeat;min-width: 15%;min-height: 26px; text-align: center; padding: 4px 0; color: #fff !important;}
					.Hti2{position: absolute; text-transform:uppercase; left: <?= 403+116.9+15?>px;background-image: url(/images/fundo_ti/title.png);background-size: 100%;background-repeat: no-repeat;min-width: 15%;min-height: 26px; text-align: center; padding: 4px 0; color: #fff !important;}
					.Hti3{position: absolute; text-transform:uppercase; left: <?= 403+(116.9*2)+30?>px;background-image: url(/images/fundo_ti/title.png);background-size: 100%;background-repeat: no-repeat;min-width: 15%;min-height: 26px; text-align: center; padding: 4px 0; color: #fff !important;}
				</style>
				<?php if($logged){?>
				<div class="back_ti" style="width: 384px">
					<div class="tioutfit"></div>
					  <?php

	 $vipTime = $account_logged->getVipTime();

	 
	 $newTime = date("d/m/y ", $vipTime);
	 //$newTime = date($newTime, strtotime("+30 days"));

   ?>
					<div class="wellcometext"><small style="font-size: .7em;">Bem vindo à sua conta</small><br/> <?=$account_logged->getName();?></div>
					<div class="wellcometext" style="top: -50px;"><div style="float:left; font-size:.5em;"><img src="images/fundo_ti/coins.png"/><?=$account_logged->getPremiumPoints();?> Coins</div>
					<?php if ($account_logged->getVipTime() >= time()) : ?>
					<div style="position:relative;left:10px;font-size:.5em;"><img src="images/fundo_ti/premiumtime-icon.png"/><small>Sua <strong>VIP</strong> vence dia: <?=($account_logged->getVipTime() < 0 ? 0 : $newTime );?></small>
					</div>
					<?php else: ?>
					
					<div style="position:relative;left:10px;font-size:.5em;"><img src="images/fundo_ti/premiumtime-icon.png"/><small><a href="?subtopic=accountmanagement">Adquira sua vip</a></small>
					</div>
					
					<?php endif; ?>
					</div>
					<br>
					<div style="position: absolute;top: 80px;left: 35px;background-color:  b81d02;padding: 5px 15px;border-radius: 3px;"><a style="color:  #fff;text-decoration: none;" href="?subtopic=accountmanagement&action=logout">Sair</a></div>
				</div>
				<?php }else{?>
				<div class="back_ti">
					<a class="tilogintext" href="?subtopic=accountmanagement">Login</a>
					<a class="ticreateacctext" href="?subtopic=createaccount"><b>Crie sua Conta</b></a>
					<a class="tilostacctext" href="?subtopic=lostaccount"><b><small style="font-size: .8em;">Esqueceu sua conta ou senha?</small></b></a>
				</div>
				<?php }?>
				<div class="Hti1">Estatísticas</div>
				<div class="Hti2">INFORMAÇÕES</div>
				<div class="Hti3">RATES</div>
				<table style="border:none !important;" bgcolor="#D4C0A1" cellpadding="4" cellspacing="0" width="100%">					
					<tbody>
						<tr bgcolor="#fdeed5">
							<td style="width:45%; border:none !important;" align="center"><b>I</b></td>
							<td style="width:15%; border:none !important;" align="center"><b>I</b></td>
							<td style="width:15%; border:none !important;" align="center"><b>I</b></td>
							<td style="width:15%; border:none !important;" align="center">I</td>
						</tr>
						<tr bgcolor="#fdeed5">	
							<td align="center" style="border:none !important;">																
							</td>
							<td align="center">
								<p style="margin: 0 auto;"><b><?= $config['status']['serverStatus_players']?></b> jogadores online</p>
								<p style="margin: 0 auto;">Server Save em </p>
								<!-- Display the countdown timer in an element -->
								<p style="margin: 0 auto;" id="demo"></p>

								<script>
								// Set the date we're counting down to
								var countDownDate = new Date("Sep 5, 2099 06:00:00").getTime();

								// Update the count down every 1 second
								var x = setInterval(function() {

								  // Get todays date and time
								  var now = new Date().getTime();

								  // Find the distance between now an the count down date
								  var distance = countDownDate - now;

								  // Time calculations for days, hours, minutes and seconds
								  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
								  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
								  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
								  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

								  // Display the result in the element with id="demo"
								  document.getElementById("demo").innerHTML ="<b>" + hours + "h "
								  + minutes + "m " + seconds + "s </b>";

								  // If the count down is finished, write some text 
								  if (distance < 0) {
									clearInterval(x);
									document.getElementById("demo").innerHTML = "EXPIRED";
								  }
								}, 1000);
								</script>
								<!--<p style="margin: 0 auto;">blablabla</p>-->
							</td>
							<td align="center">
								<p style="margin: 0 auto;"><span>Connection IP:</span><b> <?= $config["server"]["ip"]?></b></p>
								<p style="margin: 0 auto;"><span>Porta:</span> 7171 </p>
								<p style="margin: 0 auto;"><span>Versão:</span> 8.60 </p>
								<p style="margin: 0 auto;"><span>Tipo:</span> <?= $config['server']['worldType']?></p>									
							</td>
							<td align="center">
								<p style="margin: 0 auto;"><span>Exp:</span> <b>Stage</b></p>									
								<p style="margin: 0 auto;"><span>magic:</span> <?= $config['server']['rateMagic']?></p>									
								<p style="margin: 0 auto;"><span>Skill:</span> <?= $config['server']['rateSkill']?></p>									
								<p style="margin: 0 auto;"><span>Loot:</span> <?= $config['server']['rateLoot']?></p>
							</td>																
						</tr>
					</tbody>
				</table>
				
			
			
			</div>
		</div>
    </div>
    <div class="Border_1" style="background-image:url(./layouts/tibiarl/images/content/border-1.gif);"></div>
    <div class="CornerWrapper-b">
        <div class="Corner-bl" style="background-image:url(./layouts/tibiarl/images/content/corner-bl.gif);"></div>
    </div>
    <div class="CornerWrapper-b">
        <div class="Corner-br" style="background-image:url(./layouts/tibiarl/images/content/corner-br.gif);"></div>
    </div>
</div>