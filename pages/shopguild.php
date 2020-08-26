<?php
$items = simplexml_load_file($config['site']['serverPath'].'/data/items/items.xml') or die('<b>Could not load items!</b>');

foreach($items->item as $v)
	$itemList[(int)$v['id']] = ucwords(strtolower($v['name']));

if($config['site']['shopguild_system'] == 1) {
	if($logged)
		$user_guild_points = $account_logged->getCustomField('guild_points');
	else
		$user_guild_points = 'Login first';

	function getItemByID($id) {
		$id = (int) $id;
		$SQL = $GLOBALS['SQL'];
		$data = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shopguild_offer').' WHERE '.$SQL->fieldName('id').' = '.$SQL->quote($id).';')->fetch();
		if ($data['offer_type'] == 'pacc') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['days'] = $data['count1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
			$offer['offer_type'] = $data['offer_type'];
		}elseif ($data['offer_type'] == 'item') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['item_id'] = $data['itemid1'];
			$offer['item_count'] = $data['count1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'outfit') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['points'] = $data['points'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'vipdays') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['days'] = $data['count1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
			$offer['offer_type'] = $data['offer_type'];
		}elseif ($data['offer_type'] == 'itemvip') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['item_id'] = $data['itemid1'];
			$offer['item_count'] = $data['count1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'container') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['container_id'] = $data['itemid2'];
			$offer['container_count'] = $data['count2'];
			$offer['item_id'] = $data['itemid1'];
			$offer['item_count'] = $data['count1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'unban') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'redskull')	{
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'itemlogout') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['pid'] = $data['pid'];
			$offer['count1'] = $data['count1'];
			$offer['item_id'] = $data['itemid1'];
			$offer['free_cap'] = $data['free_cap'];
		}elseif ($data['offer_type'] == 'storage') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['item_id'] = $data['itemid1'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}elseif ($data['offer_type'] == 'changename') {
			$offer['id'] = $data['id'];
			$offer['type'] = $data['offer_type'];
			$offer['points'] = $data['points'];
			$offer['description'] = $data['offer_description'];
			$offer['name'] = $data['offer_name'];
		}return $offer;
	}

	function getOfferArray() {
		$offer_list = $GLOBALS['SQL']->query('SELECT * FROM '.$GLOBALS['SQL']->tableName('z_shopguild_offer').';');
		$i_pacc = 0;
		$i_item = 0;
		$i_outfit = 0;
		$i_vipdays = 0;
		$i_itemvip = 0;
		$i_container = 0;
		$i_unban = 0;
		$i_redskull = 0;
		$i_itemlogout = 0;
		$i_changename = 0;
		$i_storage = 0;
		while($data = $offer_list->fetch()) {
			if ($data['offer_type'] == 'pacc') {
				$offer_array['pacc'][$i_pacc]['id'] = $data['id'];
				$offer_array['pacc'][$i_pacc]['days'] = $data['count1'];
				$offer_array['pacc'][$i_pacc]['points'] = $data['points'];
				$offer_array['pacc'][$i_pacc]['description'] = $data['offer_description'];
				$offer_array['pacc'][$i_pacc]['name'] = $data['offer_name'];
				$offer_array['pacc'][$i_pacc]['offer_type'] = $data['offer_type'];
				$i_pacc++;
			}elseif ($data['offer_type'] == 'item') {
				$offer_array['item'][$i_item]['id'] = $data['id'];
				$offer_array['item'][$i_item]['item_id'] = $data['itemid1'];
				$offer_array['item'][$i_item]['item_count'] = $data['count1'];
				$offer_array['item'][$i_item]['points'] = $data['points'];
				$offer_array['item'][$i_item]['description'] = $data['offer_description'];
				$offer_array['item'][$i_item]['name'] = $data['offer_name'];
				$i_item++;
			}elseif ($data['offer_type'] == 'outfit') {
				$offer_array['outfit'][$i_outfit]['id'] = $data['id'];
				$offer_array['outfit'][$i_outfit]['points'] = $data['points'];
				$offer_array['outfit'][$i_outfit]['name'] = $data['offer_name'];
				$i_outfit++;
			}elseif ($data['offer_type'] == 'vipdays') {
				$offer_array['vipdays'][$i_vipdays]['id'] = $data['id'];
				$offer_array['vipdays'][$i_vipdays]['days'] = $data['count1'];
				$offer_array['vipdays'][$i_vipdays]['points'] = $data['points'];
				$offer_array['vipdays'][$i_vipdays]['description'] = $data['offer_description'];
				$offer_array['vipdays'][$i_vipdays]['name'] = $data['offer_name'];
				$offer_array['vipdays'][$i_vipdays]['offer_type'] = $data['offer_type'];
				$i_vipdays++;
			}elseif ($data['offer_type'] == 'itemvip') {
				$offer_array['itemvip'][$i_itemvip]['id'] = $data['id'];
				$offer_array['itemvip'][$i_itemvip]['item_id'] = $data['itemid1'];
				$offer_array['itemvip'][$i_itemvip]['item_count'] = $data['count1'];
				$offer_array['itemvip'][$i_itemvip]['points'] = $data['points'];
				$offer_array['itemvip'][$i_itemvip]['description'] = $data['offer_description'];
				$offer_array['itemvip'][$i_itemvip]['name'] = $data['offer_name'];
				$i_itemvip++;
			}elseif ($data['offer_type'] == 'container'){
				$offer_array['container'][$i_container]['id'] = $data['id'];
				$offer_array['container'][$i_container]['container_id'] = $data['itemid2'];
				$offer_array['container'][$i_container]['container_count'] = $data['count2'];
				$offer_array['container'][$i_container]['item_id'] = $data['itemid1'];
				$offer_array['container'][$i_container]['item_count'] = $data['count1'];
				$offer_array['container'][$i_container]['points'] = $data['points'];
				$offer_array['container'][$i_container]['description'] = $data['offer_description'];
				$offer_array['container'][$i_container]['name'] = $data['offer_name'];
				$i_container++;
			}elseif ($data['offer_type'] == 'unban') {
				$offer_array['unban'][$i_unban]['id'] = $data['id'];
				$offer_array['unban'][$i_unban]['points'] = $data['points'];
				$offer_array['unban'][$i_unban]['description'] = $data['offer_description'];
				$offer_array['unban'][$i_unban]['name'] = $data['offer_name'];
				$i_unban++;
			}elseif ($data['offer_type'] == 'redskull') {
				$offer_array['redskull'][$i_redskull]['id'] = $data['id'];
				$offer_array['redskull'][$i_redskull]['points'] = $data['points'];
				$offer_array['redskull'][$i_redskull]['description'] = $data['offer_description'];
				$offer_array['redskull'][$i_redskull]['name'] = $data['offer_name'];
				$i_redskull++;
			}elseif ($data['offer_type'] == 'itemlogout') {
				$offer_array['itemlogout'][$i_itemlogout]['id'] = $data['id'];
				$offer_array['itemlogout'][$i_itemlogout]['points'] = $data['points'];
				$offer_array['itemlogout'][$i_itemlogout]['description'] = $data['offer_description'];
				$offer_array['itemlogout'][$i_itemlogout]['name'] = $data['offer_name'];
				$offer_array['itemlogout'][$i_itemlogout]['count1'] = $data['count1'];
				$offer_array['itemlogout'][$i_itemlogout]['pid'] = $data['pid'];
				$offer_array['itemlogout'][$i_itemlogout]['item_id'] = $data['itemid1'];
				$offer_array['itemlogout'][$i_itemlogout]['free_cap'] = $data['free_cap'];
				$i_itemlogout++;
			}elseif ($data['offer_type'] == 'storage') {
				$offer_array['storage'][$i_storage]['id'] = $data['id'];
				$offer_array['storage'][$i_storage]['points'] = $data['points'];
				$offer_array['storage'][$i_storage]['item_id'] = $data['itemid1'];
				$offer_array['storage'][$i_storage]['description'] = $data['offer_description'];
				$offer_array['storage'][$i_storage]['name'] = $data['offer_name'];
				$i_storage++;
			}elseif ($data['offer_type'] == 'changename') {
				$offer_array['changename'][$i_changename]['id'] = $data['id'];
				$offer_array['changename'][$i_changename]['points'] = $data['points'];
				$offer_array['changename'][$i_changename]['description'] = $data['offer_description'];
				$offer_array['changename'][$i_changename]['name'] = $data['offer_name'];
				$i_changename++;
			}
		}
		return $offer_array;
	}

	if($action == '') {
		unset($_SESSION['viewed_confirmation_page']);
		$main_content .= '<div style="text-align: justify;"><center><h2>Welcome to '.$config['server']['serverName'].' Shop.</h2></center></div>';
$main_content .= '
<center>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Guild Points System</div>
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
																<table width="100%" border="0" cellpadding="4" cellspacing="1">
																	<tbody>
																		<tr>
  																			<td class="white" colspan="3" bgcolor="#505050"><span class="style4">Informa&ccedil;&otilde;es sobre ades&atilde;o dos pontos.</span></td>
																		</tr>
																		<tr bgcolor="#f1e0c6">
																			<td width="35%">Comando Utilizado:</td><td width="35%">!guildpoints (leader)</td>
																		</tr>
																		<tr bgcolor="#d4c0a1">
																			<td>Level M&iacute;nimo:</td><td>Level 100</td>
																		</tr>
																		<tr bgcolor="#f1e0c6">
																			<td>Players On-line:</td><td>10 On-line</td>
																		</tr>
																		<tr bgcolor="#d4c0a1">
																			<td>IPs Diferentes:</td><td>5 IPs</td>
																		</tr>
																		<tr bgcolor="#f1e0c6">
																			<td>Quantidade de Pontos:</td><td>50 Pontos (cada player)</td>
																		</tr>
																																				<tr bgcolor="#f1e0c6">
																			<td>Tempo de exaulst do comando:</td><td> 1 Hours</td>
																		</tr>
																		<tr>
  																			<td class="white" colspan="3" bgcolor="#505050"><span class="style4">O comando s&oacute; pode ser executado uma vez a cada 1 dia!</span></td>
																		</tr>
																	</tbody>
																</table>
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
</center>
</br>';

		$offer_list = getOfferArray();
		// show storage

		if(count($offer_list['storage']) > 0){
			$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer">
							<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
							<div class="Text">Storages for Sale</div>
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
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
															<div class="TableContentContainer">
																<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
																	<tbody>';
																	if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																	$main_content.='
																		<tr bgcolor="'.$bgcolor.'">
																			<td valign="middle" width="10%" align="center"><b>Product</b></td>
																			<td valign="middle" width="60%"><b>Description</b></td>
																			<td valign="middle">&nbsp;</td>
																		</tr>';
																	if(count($offer_list['storage']) > 0)
																		foreach($offer_list['storage'] as $storage) {
																			if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																			$main_content .= '<tr bgcolor="'.$bgcolor.'">
																				<td valign="middle" align="center"><img src="images/items/storage/'.$storage['item_id'].'.gif" width="32" height="32" /></td>
																				<td><font style="font-size:16px; font-weight:bold;">'.$storage['name'].'</font>&nbsp;';
																			$main_content .='<small>('.$storage['points'].' points)</small>';
																			$main_content .='<br />
																			'.$storage['description'].'</td>
																			<td align="center">';
																			if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
																				$main_content .= '
																					<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
																						<input type="hidden" name="buy_id" value="'.$storage['id'].'">
																						<table border="0" cellpadding="0" cellspacing="0">
																							<tbody>
																								<tr>
																									<td style="border: 0px none;">
																										<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
																											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
																											<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
																										</div>
																									</div>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																					</form>';}
																				$main_content .= '
																				</tbody>
																			</table>
																		</div>
																	</div>
																	<div class="TableShadowContainer">
																		<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
																			<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
																			<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
																		</div>
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
							</div><br />';}

if($logged){			$main_content .= '
				<a name="History" ></a>
				<div class="TableContainer" >
					<table class="Table5" cellpadding="0" cellspacing="0">
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" > 
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
								<div class="Text" >History</div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
								<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
								<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
							</div>
						</div>
						<tr>
							<td>
								<div class="InnerTableContainer" >
									<table style="width:100%;" >';
									$main_content .= '
										<tr>
											<td>
												<div class="TableShadowContainerRightTop" >
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
													<div class="TableContentContainer" >
														<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
															<tr>
																<td>
																	<div style="float:right;" >
																		<form action="?subtopic=shopguild&action=show_history" method="post" style="padding:0px;margin:0px;" >
																			<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton_green.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_green_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="View History" alt="View History" src="'.$layout_name.'/images/buttons/_sbutton_viewhistory.gif" >
																				</div>
																			</div>
																		</form>
																	</div>
																	<b>Shopping History</b><br/>
																	Contains all historical data of your payments.
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
											</td>
										</tr>';
														
								$main_content .= '
									</table>
								</div>
							</table>
						</div>
					</td>
				</tr>
				<br/>';}

				//show list of vipdays offers
				if(count($offer_list['pacc']) > 0){
					$main_content .= '
						<div class="TableContainer">
							<div class="CaptionContainer">
								<div class="CaptionInnerContainer">
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
									<div class="Text">Premium Account</div>
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
																<div class="TableShadowContainerRightTop">
																	<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
																</div>
																<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
																	<div class="TableContentContainer">
																		<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
																			<tbody>';
																		if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																		$main_content.='
																			<tr bgcolor="'.$bgcolor.'">
																				<td valign="middle" width="10%" align="center"><b>Product</b></td>
																				<td valign="middle" width="60%"><b>Description</b></td>
																				<td valign="middle">&nbsp;</td>
																			</tr>';
																		if(count($offer_list['pacc']) > 0)
																			foreach($offer_list['pacc'] as $pacc) {
																				if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																				$main_content .= '
																					<tr bgcolor="'.$bgcolor.'">
																						<td valign="middle" align="center"><img src="images/shop/premium.gif" /></td>
																						<td><font style="font-size:16px; font-weight:bold;">'.$pacc['days'].' Premium Days</font>&nbsp;<small>('.$pacc['points'].' points)</small><br />'.$pacc['description'].'</td>
																						<td align="center">';
																				if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
																				$main_content .= '
																					<form action="index.php?subtopic=shopguild&action=select_player" method=POST>
																						<input type="hidden" name="buy_id" value="'.$pacc['id'].'">
																						<table border="0" cellpadding="0" cellspacing="0">
																							<tbody>
																								<tr>
																									<td style="border: 0px none;">
																										<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
																											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
																											<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
																										</div>
																									</div>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																					</form>';}
																		$main_content .= '
																			</td>
																		</tr>';																		
																	$main_content .= '
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
																</div>
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
					</div><br />';}
				if(count($offer_list['vipdays']) > 0){
					$main_content .= '
						<div class="TableContainer">
							<div class="CaptionContainer">
								<div class="CaptionInnerContainer">
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
									<div class="Text">VIP Account</div>
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
																<div class="TableShadowContainerRightTop">
																	<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
																</div>
																<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
																	<div class="TableContentContainer">
																		<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
																			<tbody>';
																		if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																		$main_content.='
																			<tr bgcolor="'.$bgcolor.'">
																				<td valign="middle" width="10%" align="center"><b>Product</b></td>
																				<td valign="middle" width="60%"><b>Description</b></td>
																				<td valign="middle">&nbsp;</td>
																			</tr>';
																		if(count($offer_list['vipdays']) > 0)
																			foreach($offer_list['vipdays'] as $vipdays) {
																					if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
																					$main_content .= '<tr bgcolor="'.$bgcolor.'"><td valign="middle" align="center"><img src="images/shop/vip.gif" /></td>
																					<td><font style="font-size:16px; font-weight:bold;">'.$vipdays['days'].' VIP Days</font>&nbsp;<small>('.$vipdays['points'].' points)</small><br />'.$vipdays['description'].'</td>
																					<td align="center">';
																					if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
																					$main_content .= '
																						<form action="index.php?subtopic=shopguild&action=select_player" method=POST>
																							<input type="hidden" name="buy_id" value="'.$vipdays['id'].'">
																							<table border="0" cellpadding="0" cellspacing="0">
																								<tbody>
																									<tr>
																										<td style="border: 0px none;">
																											<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
																												<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
																												<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
																											</div>
																										</div>
																									</td>
																								</tr>
																							</tbody>
																						</table>
																					</form>';
																		$main_content .= '
																			</td>
																		</tr>';
																		}
																	$main_content .= '
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
																</div>
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
					</div><br />';}
//show list of itemsvip offers
if(count($offer_list['itemvip']) > 0) {
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Items VIP</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>
</tr>';
foreach($offer_list['itemvip'] as $itemvip) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'"><td valign="middle" align="center">
';
if(file_exists('images/items/'.$itemvip['item_id'].'.gif')) { $main_content .= '<br /><img src="images/items/'.$itemvip['item_id'].'.gif" height="32" width="32"><br /> '; } else { $main_content .= '<br /> <img src="images/monsters/nophoto.png" height="32" width="32">'; } 
$main_content .='</td>
<td><font style="font-size:16px; font-weight:bold;">'.$itemList[(int)$itemvip['item_id']].'</font>&nbsp;<small>('.$itemvip['points'].' points)</small><br />'.$itemvip['description'].'</td>
<td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method=POST>
<input type="hidden" name="buy_id" value="'.$itemvip['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>';
}
$main_content .= '</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
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
</div><br />';}
//show list of items offers
if(count($offer_list['item']) > 0 or count($offer_list['itemlogout']) > 0){
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Items</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>';
if(count($offer_list['item']) > 0) {
foreach($offer_list['item'] as $item) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '
</tr>
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" align="center">'; if(file_exists('images/items/'.$item['item_id'].'.gif')) { $main_content .= '<br /><img src="images/items/'.$item['item_id'].'.gif" height="32" width="32"><br /> '; } else { $main_content .= '<br /> <img src="images/monsters/nophoto.png" height="32" width="32">'; } 
$main_content .='
</td>
<td><font style="font-size:16px; font-weight:bold;">'.$itemList[(int)$item['item_id']].'</font>&nbsp;';
$main_content .='<small>('.$item['points'].' points)</small>';
$main_content .='<br />
'.$item['description'].'
</td>
<td valign="middle" align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$item['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>'; 
}
$main_content .= '</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
</div></td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div><br />';
}
}

//show list of outfits offers
if(count($offer_list['outfit']) > 0) {
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Outfits</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>';
if(count($offer_list['outfit']) > 0) {
foreach($offer_list['outfit'] as $outfit) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '
</tr>
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" align="center">';

	if(file_exists($layout_name.'/images/outfits/'.$outfit['name'].'_male.gif')) {
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$outfit['name'].'_male.gif"">';
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$outfit['name'].'_female.gif"">';
	} else {
		$main_content .= '<img src="'.$layout_name.'/images/items/notfound.gif">';
	}	
	
$main_content .= '
</td>
<td><font style="font-size:16px; font-weight:bold;">'.$outfit['name'].' Outfits</font>&nbsp;';
$main_content .='<small>('.$outfit['points'].' points)</small></td>
<td valign="middle" align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$outfit['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>'; 
}
$main_content .= '</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
</div></td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div><br />';
}
}

//show list of containers offers

if(count($offer_list['itemlogout']) > 0) {
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Items Logout</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>
</tr>';
foreach($offer_list['itemlogout'] as $itemlogout) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$config['site']['lightborder'].'"><td valign="middle" align="center"><img src="images/items/'.$itemlogout['id'].'.gif"></td><td><b>'.$itemlogout['name'].'</b> ('.$itemlogout['points'].' points)<br />'.$itemlogout['description'].'</td><td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method=POST>
<input type="hidden" name="buy_id" value="'.$itemlogout['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>';
}
$main_content .= '</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
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
</div><br />';}
if(count($offer_list['container']) > 0) {
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Containers Of Items</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>

</tr>';
foreach($offer_list['container'] as $container) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'"><td valign="middle" align="center">'; if(file_exists('images/items/'.$container['item_id'].'.gif')) { $main_content .= '<img src="images/items/'.$container['item_id'].'.gif" height="32" width="32">'; } else { $main_content .= '<img src="images/monsters/nophoto.png" height="32" width="32">'; } $main_content .='</td>
<td><b style="font-height: bold; font-size: 16px;">'.$container['name'].'</b> ('.$container['points'].' points)<br />'.$container['description'].'</td><td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$container['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>';
}
$main_content .= '</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
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
</div><br />';}
if(count($offer_list['changename']) > 0 or count($offer_list['redskull']) > 0 or count($offer_list['unban']) > 0){
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Account Additional</div>
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
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div><div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border:1px solid #faf0d7;" width="100%">
<tbody>';
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content.='
<tr bgcolor="'.$bgcolor.'">
<td valign="middle" width="10%" align="center"><b>Product</b></td>
<td valign="middle" width="60%"><b>Description</b></td>
<td valign="middle">&nbsp;</td>
</tr>';
//Change Name
if(count($offer_list['changename']) > 0)
foreach($offer_list['changename'] as $changename) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'">
<td valign="middle" align="center"><img src="images/shop/name.gif" /></td>
<td><font style="font-size:16px; font-weight:bold;">'.$changename['name'].'</font>&nbsp;';
$main_content .='<small>('.$changename['points'].' points)</small>';
$main_content .='<br />
'.$changename['description'].'</td>
<td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$changename['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';}

//Remove Red Skull
if(count($offer_list['redskull']) > 0)
foreach($offer_list['redskull'] as $redskull) {
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'">
<td valign="middle" align="center"><img src="images/shop/skull.gif" /></td>
<td><font style="font-size:16px; font-weight:bold;">'.$redskull['name'].'</font>&nbsp;';
$main_content .='<small>('.$redskull['points'].' points)</small>';
$main_content .='<br />'.$redskull['description'].'</td>
<td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$redskull['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>';}
//Unban
if(count($offer_list['unban']) > 0)
foreach($offer_list['unban'] as $unban){
if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['lightborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'">
<td valign="middle" align="center"><br /><img src="images/shop/ban.gif"  height="32" width="32"/></td>
<td><font style="font-size:16px; font-weight:bold;">'.$unban['name'].'</font>&nbsp;';
$main_content .='<small>('.$unban['points'].' points)</small>';
$main_content .='<br />'.$unban['description'].'</td>
<td align="center">';
if(!$logged) $main_content .= '<a href="/?subtopic=accountmanagement"><input type="submit" value="Login First" class="btn disabled btn-danger" /></a>'; else 
$main_content .= '
<form action="index.php?subtopic=shopguild&action=select_player" method="POST">
<input type="hidden" name="buy_id" value="'.$unban['id'].'">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<input class="ButtonText" name="Continue" alt="Continue" src="'.$layout_name.'/images/buttons/_sbutton_purchase.gif" type="image">
</div>
</div>
</td>
</tr>
</tbody>
</table>
</form>';
$main_content .= '</td></tr>';}
$main_content .= '
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
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
</div>';}}
elseif($action == 'select_player') {
unset($_SESSION['viewed_confirmation_page']);
if(!$logged) {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS=white><B>Shoping Error</B></TD>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<td>
<TABLE BORDER="0" CELLSPACING="1" cellpadding="4">
<TR>
<TD>Please login first.</TD>
</TR>
</TABLE>
</td>
</tr>
</TABLE>';} 
else {
$buy_id = (int) $_REQUEST['buy_id'];
if(empty($buy_id)) {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS=white><B>Shoping Error</B></TD>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<td>
<TABLE BORDER="0" CELLSPACING="1" cellpadding="4">
<TR>
<TD>Please <a href="index.php?subtopic=shopguild">select item</a> first.</TD>
</TR>
</TABLE>
</td>
</tr>
</TABLE>';} 
else {
$buy_offer = getItemByID($buy_id);
if(isset($buy_offer['id'])) { //item exist in database
if($buy_offer['type'] != 'changename') {
if($user_guild_points >= $buy_offer['points']) {
if(empty($_REQUEST['page'])) { $color1 = 'blue'; $color2 = 'green-blue'; $color3 = 'blue'; $color4 = 'blue'; $color5 = 'blue'; }
if($_REQUEST['page'] == 'confirm') { $color1 = 'blue'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green-blue'; $color5 = 'blue'; }
if($_REQUEST['page'] == 'transfer') { $color1 = 'green'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green'; $color5 = 'green'; }
$main_content .= '
<div id="ProgressBar" >
<center><h2>Shop Buy Item</h2></center>
<div id="MainContainer" >
<div id="BackgroundContainer" >
<img id="BackgroundContainerLeftEnd" src="'.$layout_name.'/images/vips/stonebar-left-end.gif" />
<div id="BackgroundContainerCenter">
<div id="BackgroundContainerCenterImage" style="background-image:url('.$layout_name.'/images/vips/stonebar-center.gif);" />
</div>
</div>
<img id="BackgroundContainerRightEnd" src="'.$layout_name.'/images/vips/stonebar-right-end.gif" />
</div>
<img id="TubeLeftEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-left-green.gif" />
<img id="TubeRightEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-right-'.$color1.'.gif" />
<div id="FirstStep" class="Steps" >
<div class="SingleStepContainer" >
<img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-0-green.gif" />
<div class="StepText" style="font-weight:normal;" >Item Selected</div>
</div>
</div>
<div id="StepsContainer1" ><div id="StepsContainer2" ><div class="Steps" style="width:50%" >
<div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color2.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-3-'.$color3.'.gif" /><div class="StepText" style="font-weight:normal;" >Confirm Data</div>
</div></div><div class="Steps" style="width:50%" ><div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color4.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-4-'.$color5.'.gif" />
<div class="StepText" style="font-weight:normal;" >Transfer Result</div></div></div></div></div></div></div>';
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer"> 
<span class="CaptionEdgeLeftTop" style="background-image: url('.$layout_name.'/images/content/box-frame-edge.gif);"></span> 
<span class="CaptionEdgeRightTop" style="background-image: url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image: url('.$layout_name.'/images/content/table-headline-border.gif);"></span> 
<span class="CaptionVerticalLeft" style="background-image: url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span> 
<div class="Text">Delivery Informations</div> 
<span class="CaptionVerticalRight" style="background-image: url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<span class="CaptionBorderBottom" style="background-image: url('.$layout_name.'/images/content/table-headline-border.gif);"></span> 
<span class="CaptionEdgeLeftBottom" style="background-image: url('.$layout_name.'/images/content/box-frame-edge.gif);"></span> 
<span class="CaptionEdgeRightBottom" style="background-image: url('.$layout_name.'/images/content/box-frame-edge.gif);"></span> 
</div>
</div>
<table class="Table3" cellpadding="0" cellspacing="0"> 
<tbody><tr>
<td>
<div class="InnerTableContainer"> 
<table style="width: 100%;"><tbody><tr><td>
<div class="InnerTableContainer">
<table>
<tbody>
<tr>
<td>
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image: url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div>
<div class="TableContentAndRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border: 1px solid #faf0d7;">
<tbody>
<tr style="background-color: #505050;">
</tr>
<tr class="Table" style="background-color: #d4c0a1;">
<td style="width: 800; border: 1px; border-style: solid; border-color: #FAF0D7; padding: 4px;">
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="'.$config['site']['vdarkborder'].'">
<td colspan="2"><font style="font-size:16px; font-weight:bold; color: #FFFFFF;"><b>Item Informations</b></font></td>
</tr>
<tr bgcolor="#D4C0A1">
<td width="100"><b>Image:</b></td><td width="550">';
if ($buy_offer['type'] == 'pacc')
	$main_content .= '<img src="images/shop/premium.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'vipdays')
	$main_content .= '<img src="images/shop/vip.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'redskull') 
	$main_content .= '<img src="images/shop/skull.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'unban') 
	$main_content .= '<img src="images/shop/ban.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'item')
	if(file_exists('images/items/'.$buy_offer['item_id'].'.gif')) {
		$main_content .= '<img src="images/items/'.$buy_offer['item_id'].'.gif" height="32" width="32">';
	} else {
		$main_content .= '<img src="images/items/notfound.gif" height="32" width="32">';
	}
elseif ($buy_offer['type'] == 'outfit')
	if(file_exists($layout_name.'/images/outfits/'.$buy_offer['name'].'_male.gif')) {
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$buy_offer['name'].'_male.gif"">';
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$buy_offer['name'].'_female.gif"">';
	} else {
		$main_content .= '<img src="'.$layout_name.'/images/items/notfound.gif">';
	}	
elseif ($buy_offer['type'] == 'itemvip')
	if(file_exists('images/items/'.$buy_offer['item_id'].'.gif')) {
		$main_content .= '<img src="images/items/'.$buy_offer['item_id'].'.gif" height="32" width="32">';
	} else {
		$main_content .= '<img src="images/items/notfound.gif" height="32" width="32">';
	}

$main_content .='
</td>
</tr>
<tr bgcolor="#F1E0C6"><td width="100"><b>Product:</b></td><td width="550">';

if ($buy_offer['type'] == 'pacc')
	$main_content .= 'Premium Days';
elseif ($buy_offer['type'] == 'vipdays')
	$main_content .= 'VIP Days';
elseif ($buy_offer['type'] == 'redskull') 
	$main_content .= 'Remove Skull';
elseif ($buy_offer['type'] == 'unban') 
	$main_content .= 'Unban or Remove Ban';
elseif ($buy_offer['type'] == 'item')
	$main_content .= $itemList[(int)$buy_offer['item_id']];
elseif ($buy_offer['type'] == 'itemvip')
	$main_content .= $itemList[(int)$buy_offer['item_id']];
elseif ($buy_offer['type'] == 'outfit') 
	$main_content .= $buy_offer['name'].' outfits';
	
$main_content .= '. '.$buy_offer['description'].'</td></tr>';
$main_content .='<tr bgcolor="#F1E0C6"><td width="100"><b>Cost:</b></td><td width="550"><small><b>'.$buy_offer['points'].'</b> guild points</small></td></tr>';
$main_content .='
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="InnerTableContainer">
<table>
<tbody>
<tr>
<td>
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image: url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div>
<div class="TableContentAndRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border: 1px solid #faf0d7;">
<tbody>
<tr style="background-color: #505050;">
</tr>
<tr class="Table" style="background-color: #d4c0a1;">
<td style="width: 800; border: 1px; border-style: solid; border-color: #FAF0D7; padding: 4px;">
<form action="index.php?subtopic=shopguild&action=confirm_transaction" method=POST>
<input type="hidden" name="buy_id" value="'.$buy_id.'">
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="'.$config['site']['vdarkborder'].'">
<td colspan="2"><font style="font-size:16px; font-weight:bold; color: #FFFFFF;"><b>Select one Player</b></font></td>
</tr>
<tr bgcolor="#D4C0A1"><td width="110"><b>Name:</b>&nbsp;&nbsp;<select name="buy_name" style="padding: 5px;">';
$players_from_logged_acc = $account_logged->getPlayersList();
if(count($players_from_logged_acc) > 0) {
foreach($players_from_logged_acc as $player)
$main_content .= '<option>'.$player->getName().'</option>';
} else {
$main_content .= 'You don\'t have any character on your account.';
}
$main_content .= '</select>&nbsp;<input type="submit" class="btn btn-success" style="margin-top: -2.5px;" value="Purchase"><br /><small>Character <b> your account </b> you will receive.</small></td></tr></table>
</form>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="InnerTableContainer">
<table>
<tbody>
<tr>
<td>
<div class="TableShadowContainerRightTop">
<div class="TableShadowRightTop" style="background-image: url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
</div>
<div class="TableContentAndRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-rm.gif);">
<div class="TableContentContainer">
<table class="TableContent" style="border: 1px solid #faf0d7;">
<tbody>
<tr style="background-color: #505050;">
</tr>
<tr class="Table" style="background-color: #d4c0a1;">
<td style="width: 800; border: 1px; border-style: solid; border-color: #FAF0D7; padding: 4px;">
<form action="index.php?subtopic=shopguild&action=confirm_transaction" method="POST"><input type="hidden" name="buy_id" value="'.$buy_id.'">
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="'.$config['site']['vdarkborder'].'">
<td colspan="2"><font style="font-size:16px; font-weight:bold; color: #FFFFFF;"><b>Send Gift</b></font></td>
</tr>
<tr bgcolor="#D4C0A1"><td width="110"><b>To player:</b>&nbsp;&nbsp;<input type="text" name="buy_name" autocomplete="off" placeholder="Character&nbsp;to&nbsp;recive&nbsp;'.$buy_offer['name'].'" size="25">&nbsp;<input type="submit" value="Purchase to friend" class="btn btn-success" style="margin-top: -2.5px;"><br /><small>Put in the field above the name of the character that will receive the item.</small></td></tr>
</table>
</form>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="TableShadowContainer">
<div class="TableBottomShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bm.gif);">
<div class="TableBottomLeftShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
<div class="TableBottomRightShadow" style="background-image: url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
</div>
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
</td>
</tr>
</tbody>
</table>
</div>';
} else {
$main_content .= '
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS="white"><b>Erro</b></td>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'><TD>To buy <b>'.$buy_offer['name'].'</b> you need <b>'.$buy_offer['points'].' guild points</b>.<br />Your balance is currently <b>'.$user_guild_points.'</b> guild points.</TD>
</TR>
</TABLE>
<br />
<table width="100%">
<tbody>
<tr align="center">
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td style="border: 0px none;">
<a href="javascript:void();" onclick=location.href="index.php?subtopic=buypoints">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<div class="ButtonText" style="background-image:url('.$layout_name.'/images/buttons/_sbutton_buypoints.png);"></div>
</div>
</div>
</a>
</td>
</tr>
<tr>
</tr>
</tbody>
</table>
</td>
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<a href="javascript:void();" onclick=location.href="index.php?subtopic=shopguild"><div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif); visibility: hidden;"></div>
<input class="ButtonText" name="Back" alt="Back" src="'.$layout_name.'/images/vips/_sbutton_back.gif" type="image">
</table>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>';}
} else {
$main_content .= '<script type="text/javascript">

var accountHttp;

//sprawdza czy dane konto istnieje czy nie
function checkAccount()
{
	if(document.getElementById("account_name").value=="")
	{
		document.getElementById("acc_name_check").innerHTML = \'<img src="images/nok.gif" />\';
		return;
	}
	accountHttp=GetXmlHttpObject();
	if (accountHttp==null)
	{
		return;
	}
	var account = document.getElementById("account_name").value;
	var url="ajax/check_account.php?account=" + account + "&uid="+Math.random();
	accountHttp.onreadystatechange=AccountStateChanged;
	accountHttp.open("GET",url,true);
	accountHttp.send(null);
} 

function AccountStateChanged() 
{ 
	if (accountHttp.readyState==4)
	{ 
		document.getElementById("acc_name_check").innerHTML=accountHttp.responseText;
	}
}

var emailHttp;

//sprawdza czy dane konto istnieje czy nie
function checkEmail()
{
	if(document.getElementById("email").value=="")
	{
		document.getElementById("email_check").innerHTML = \'<img src="images/nok.gif" />\';
		return;
	}
	emailHttp=GetXmlHttpObject();
	if (emailHttp==null)
	{
		return;
	}
	var email = document.getElementById("email").value;
	var url="ajax/check_email.php?email=" + email + "&uid="+Math.random();
	emailHttp.onreadystatechange=EmailStateChanged;
	emailHttp.open("GET",url,true);
	emailHttp.send(null);
} 

function checkName()
{
		if(document.getElementById("newcharname").value=="")
		{
			document.getElementById("name_check").innerHTML = \'<b><font color="red">Please enter new character name.</font></b>\';
			return;
		}
		nameHttp=GetXmlHttpObject();
		if (nameHttp==null)
		{
			return;
		}
		var newcharname = document.getElementById("newcharname").value;
		var url="?subtopic=ajax_check_name&name=" + newcharname + "&uid="+Math.random();
		nameHttp.onreadystatechange=NameStateChanged;
		nameHttp.open("GET",url,true);
		nameHttp.send(null);
} 

function EmailStateChanged() 
{ 
	if (emailHttp.readyState==4)
	{ 
		document.getElementById("email_check").innerHTML=emailHttp.responseText;
	}
}

	function validate_required(field,alerttxt)
	{
	with (field)
	{
	if (value==null||value==""||value==" ")
	  {alert(alerttxt);return false;}
	else {return true}
	}
	}

	function validate_email(field,alerttxt)
	{
	with (field)
	{
	apos=value.indexOf("@");
	dotpos=value.lastIndexOf(".");
	if (apos<1||dotpos-apos<2) 
	  {alert(alerttxt);return false;}
	else {return true;}
	}
	}

	function validate_form(thisform)
	{
	with (thisform)
	{
	if (validate_required(buy_from,"Please enter a new name of your character!")==false)
	  {buy_from.focus();return false;}
	if (validate_required(email,"Please enter your e-mail!")==false)
	  {email.focus();return false;}
	if (validate_email(email,"Invalid e-mail format!")==false)
	  {email.focus();return false;}
	if (verifpass==1) {
	if (validate_required(passor,"Please enter password!")==false)
	  {passor.focus();return false;}
	if (validate_required(passor2,"Please repeat password!")==false)
	  {passor2.focus();return false;}
	if (passor2.value!=passor.value)
	  {alert(\'Repeated password is not equal to password!\');return false;}
	}
	if(rules.checked==false)
	  {alert(\'To create account you must accept server rules!\');return false;}
	}
	}
	</script>';
$main_content .= '
<form action="index.php?subtopic=shopguild&action=confirm_transaction" method="post" onsubmit="return validate_form(this)">
<input type="hidden" name="buy_id" value="'.$buy_id.'">
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Change Name</div>
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
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="#505050">
<td colspan="2"><b class="white">You must be offline to change the name.</b></td>
</tr>
<tr bgcolor="#D4C0A1">
<td width="110"><b>Name:</b></td>
<td width="550">
<select style="padding: 5px;" name="buy_name">';
$players_from_logged_acc = $account_logged->getPlayersList();
if(count($players_from_logged_acc) > 0) {
foreach($players_from_logged_acc as $player) {
$main_content .= '<option>'.$player->getName().'</option>';}
} else {
$main_content .= 'You don\'t have any character on your account.';}
$main_content .= '</select>
</td>
</tr>
<tr bgcolor="#F1E0C6">
<td width="110"><b>New name:</b></td>
<td width="550"><input type="text" name="buy_from" id="buy_from" style="padding: 5px;" />&nbsp;';
if ($account_logged->getCustomField("guild_points") <= $buy_offer['points']){$main_content .='<input type="submit" value="New Name" class="btn disabled btn-danger" disabled />';} else {$main_content .='<input type="submit" value="New Name" class="btn btn-success"/>';}
$main_content .=' &nbsp;&nbsp;&nbsp;&nbsp;<form action="index.php?subtopic=shopguild" method="post"><input type="submit" value="Back to Shop" class="btn btn-primary" /></form></td>
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
</form>';}
} else {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="5" WIDTH="100%">
<tr BGCOLOR="'.$config['site']['vdarkborder'].'">
<td CLASS="white"><b>Error</b></td>
</tr>
<tr BGCOLOR='.$config['site']['darkborder'].'>
<td>Offer with ID <b>'.$buy_id.'</b> doesn\'t exist. Please <a href="index.php?subtopic=shopguild">select item</a> again.</td>
</tr>
</TABLE>';}
}}}
elseif($action == 'confirm_transaction') {
if(!$logged) {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS=white><B>Shoping Error</B></TD>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<td>
<TABLE BORDER="0" CELLSPACING="1" cellpadding="4">
<TR>
<TD>Please login first.</TD>
</TR>
</TABLE>
</td>
</tr>
</TABLE>';} 
else {
$buy_id = (int) $_POST['buy_id'];
$buy_name = stripslashes(urldecode($_POST['buy_name']));
$buy_from = stripslashes(urldecode($_POST['buy_from']));
if(empty($buy_id)) {
$main_content .= 'Please <a href="index.php?subtopic=shopguild">select item</a> first.';
} else {
if($buy_offer['type'] == 'changename'){
if(!check_name_new_char($buy_from)) {
$main_content .= 'Invalid name format of new name.';
}}
else {
$buy_offer = getItemByID($buy_id);
$check_name_in_database = new Player();
$check_name_in_database->find($buy_from);
if($buy_offer['type'] == 'changename'){
if(!$check_name_in_database->isLoaded()) {
}}
if(isset($buy_offer['id'])) { //item exist in database
if($user_guild_points >= $buy_offer['points']) {
if(check_name($buy_name)) {
$buy_player = new Player();
$buy_player->find($buy_name);
if($buy_player->isLoaded()) {
$buy_player_account = $buy_player->getAccount();
if($_SESSION['viewed_confirmation_page'] == 'yes' && $_POST['buy_confirmed'] == 'yes') {
if($buy_offer['type'] == 'pacc') {
$player_premdays = $buy_player_account->getCustomField('premdays');
$player_lastlogin = $buy_player_account->getCustomField('lastday');
$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_pacc').' (id, to_name, to_account, from_nick, from_account, price, pacc_days, trans_state, trans_start, trans_real) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).', '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', '.$SQL->quote($buy_offer['days']).', \'realized\', '.$SQL->quote(time()).', '.$SQL->quote(time()).');';
$SQL->query($save_transaction);
$nomedoComprador = $buy_player_account->getName();
if($player_premdays > 0){
	$newVipDays = $player_premdays + ($buy_offer['days']);
	$merda = $SQL->query("UPDATE `accounts` SET `premdays` = '$newVipDays' WHERE `name` = '$nomedoComprador'");
}else{
	$newVipDays2 = ($buy_offer['days']);
	$merda = $SQL->query("UPDATE `accounts` SET `premdays` = '$newVipDays2' WHERE `name` = '$nomedoComprador'");
}
$nomedoCara = $account_logged->getName();
$anyThing = $user_guild_points-$buy_offer['points'];
$SQL->query("UPDATE `accounts` SET `guild_points` = '$anyThing' WHERE `name` = '$nomedoCara'");
$user_guild_points = $user_guild_points - $buy_offer['points'];
if ($player_vip_days >= 1) {
}
$main_content .= '<center><b>Premium Account adicionado com sucesso!</b><br>Atenção um total de </h2><b>'.$buy_offer['days'].' dias<b> de premium account foram adicionado ao jogador <b><br>'.$buy_player->getName().'</b><br> por <b>'.$buy_offer['points'].' guild points</b> de sua account!<br><br>Você precisa relogar o personagem para que sua premium account seja ativada!<br />Now you have <b>'.$user_guild_points.' guild points</b>.<br /><br /><a href="index.php?subtopic=shopguild">Go to Shop Site</a><br /></center>';}
elseif($buy_offer['type'] == 'unban'){
$my_acc_id = $account_logged->getCustomField('id');
$datadata = $SQL->query('SELECT * FROM '.$SQL->tableName('bans').' WHERE value = '.$my_acc_id.';')->fetch();
if($datadata['value'] == $my_acc_id) {
if($SQL->query('DELETE FROM bans WHERE value= '.$my_acc_id.' LIMIT 1;')) {
} else {
$SQL->query('DELETE FROM bans WHERE account= '.$my_acc_id.' LIMIT 1;');
}
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', \'0003\', \'\', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);
$main_content .= '<center><h2>Ban Deleted!</h2><b>Your account has been unbanned for '.$buy_offer['points'].' guild points</b> from your account.
<br>Now you have <b>'.$user_guild_points.' guild points</b>.<br><br><a href="index.php?subtopic=shopguild">Go to Shop Site</a><br>';
} else {
$main_content .= '<center><b>You don\'t have any bans in your account!</b><br><br><a href="index.php?subtopic=shopguild">Go back</a><br>';
}
}

elseif($buy_offer['type'] == 'storage') {
$datadata = $SQL->query("SELECT * FROM  `player_storage` WHERE  `player_id` = ".$buy_player->getCustomField('id')." AND  `key` = '".$buy_offer['item_id']."'")->fetch();
$player = $SQL->query("SELECT *  FROM `players` WHERE `id` = ".$buy_player->getCustomField('id')."")->fetch();
if($datadata['key'] == $buy_offer['item_id']) {
$main_content .='
<table cellspacing="1" cellpadding="4" width="100%">
<tr bgcolor="#505050">
<td colspan="4" class="white"><b>Shop Message</b></td>
</tr>
<TR BGCOLOR='.$config['site']['darkborder'].'><TD align="center"><i>Your character already has this storage, please select another storage or another character to continue with the purchase.</i></TD></TR>
</TABLE>
<br />
<br />
';
}
else
{
if ($player['online'] == 0){
$SQL->query("INSERT INTO `player_storage` (`player_id` ,`key` ,`value`)
VALUES ('".$buy_player->getCustomField('id')."',  '".$buy_offer['item_id']."',  '1');");
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
$main_content .= '<center><h2>Storage enviada!</h2><b>Voc&ecirc recebeu sua storage por '.$buy_offer['points'].' pontos</b> da sua account.
<br>Agora voc&ecirc possui <b>'.$user_guild_points.' pontos</b>.<br /><br />';
}
}
if ($player['online'] == 1){
$main_content .='
<table cellspacing="1" cellpadding="4" width="100%">
<tr bgcolor="#505050">
<td colspan="4" class="white"><b>Shop Message</b></td>
</tr>
<TR BGCOLOR='.$config['site']['darkborder'].'><TD align="center">
<i>
Your character is online at this time, so that the system can properly credit the storage, we require that you log out your character before buying any other type of storage.
</i>
</TD></TR>
</TABLE>
<br />
<br />
';
}
$main_content .='
<center>
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border: 0px none;">
<div class="BigButton" style="background-image: url('.$layout_name.'/images/buttons/sbutton.gif);">
<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
<form action="index.php?subtopic=shopguild" method="post">
<input class="ButtonText" name="Back" alt="Back" src="'.$layout_name.'/images/buttons/_sbutton_back.gif" type="image">
</form>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</center>
';
}
////////////////////////////////
elseif($buy_offer['type'] == 'itemlogout') {
$my_acc_id = $buy_player->getCustomField('id');
$playerinfo = $SQL->query('SELECT * FROM '.$SQL->tableName('players').' WHERE id = '.$my_acc_id.';')->fetch();
$playerslot = $SQL->query('SELECT * FROM '.$SQL->tableName('player_items').' WHERE player_id = '.$my_acc_id.';')->fetch();
if ($playerinfo['online'] == '0') {
if ($playerslot['pid'] != '10') {
if ($datadata['cap'] >= $SQL->quote($buy_offer['free_cap'])) {
$SQL->query('INSERT INTO player_items (player_id, pid, itemtype, count) VALUES ('.$my_acc_id.', '.$SQL->quote($buy_offer['pid']).', '.$SQL->quote($buy_offer['item_id']).', '.$SQL->quote($buy_offer['count1']).');');
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
$main_content .= '<h2>Item received to player: '.$buy_player->getName().'!</h2><br />Now you have <b>'.$user_guild_points.' guild points</b>.
<br /><a href="index.php?subtopic=shopguild">Go to Shop Site</a>';
} else {
$main_content .= '<b>You need '.$SQL->quote($buy_offer['free_cap']).' or more of cap!</b><br /><a href="index.php?subtopic=shopguild">Go back</a>';
}} else {
$main_content .= '<b>Please leave the arrow slot in blank to receive item!</b><br /><a href="index.php?subtopic=shopguild">Go back</a>';
}} else {
$main_content .= '<b>You need to be offline!</b><br /><a href="index.php?subtopic=shopguild">Go back</a>';
}
}
////////////////////////////////

elseif($buy_offer['type'] == 'changename') {
	
	$charID = $buy_player->getCustomField('id');
	$newchar_errors = array();
	$newchar_name = ucwords(strtolower(trim($buy_from)));
	if(empty($newchar_name))
		$newchar_errors[] = 'Please enter a new name for your character!';
	if(!check_name_new_char($newchar_name))
		$newchar_errors[] = 'This name contains invalid letters, words or format. Please use only a-Z, - , \' and space.';
		$check_name_in_database = new Player();
		$check_name_in_database->find($newchar_name);
	if($check_name_in_database->isLoaded())
		$newchar_errors[] = 'This name is already used. Please choose another name!';
 
		$charToEdit = new Player($charID);
	if(!$charToEdit->isLoaded())
		$newchar_errors[] = 'This player does not exist.';
	if($charToEdit->isOnline())
		$newchar_errors[] = 'This player is ONLINE. Logout first.';
	elseif($account_logged->getID() != $charToEdit->getAccountID())
		$newchar_errors[] = 'This player is not on your account.';
 
	if(empty($newchar_errors))
	{
		$main_content .= '<center>Name of character <b>' . htmlspecialchars($charToEdit->getName()) . '</b> changed to <b>' . htmlspecialchars($newchar_name) . '</b></center><br><br>';
		$charToEdit->setName($newchar_name);
		$charToEdit->save();
		$account_logged->setCustomField('guild_points', $account_logged->getCustomField('guild_points') - $buy_offer['points']);
		$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', \'0001\', \'\', \'wait\', '.$SQL->quote(time()).', \'0\');';
		$SQL->query($save_transaction);
	}
	else
	{
		$main_content .= 'Some errors occured:<br />';
		foreach($newchar_errors as $e)
		{
			$main_content .= '<li>' . $e . '</li>';
		}
		$main_content .= '<br /><a href="index.php?subtopic=shopguild">Go back</a>';
	}
}

////////////////////////////////
elseif($buy_offer['type'] == 'redskull') {
	
$my_acc_id = $buy_player->getCustomField('id');

$playerinfo = $SQL->query('SELECT * FROM '.$SQL->tableName('players').' WHERE '.$SQL->fieldName('id').' = '.$my_acc_id.';')->fetch();

if($playerinfo['skull'] == '4' AND $playerinfo['online'] >= '0' AND $playerinfo['skulltime'] > '0') {
$SQL->query('UPDATE killers SET unjustified=0 WHERE id IN (SELECT kill_id FROM player_killers WHERE player_id='. $my_acc_id .');');

$SQL->query('UPDATE players SET skulltime=0, skull=0 WHERE id='. $my_acc_id .';');
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];

$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', \'0002\', \'\', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);

$main_content .= '<center><h2>RedSkull Removed!</h2><br /><b>Your redskull has been removed from the player '.$buy_player->getName().'.</b>
<br />Now you have<b> '.$user_guild_points.' guild points</b>.<br /><br /><a href="index.php?subtopic=shopguild">Go to Shop Site</a><br />';
} else {
$main_content .= '<center><b>'.$buy_player->getName().' has to be offline or have redskull to complete transaction!.</b><br /><br /><a href="index.php?subtopic=shopguild">Go back</a><br />';
}}

//////////////////////////
elseif($buy_offer['type'] == 'item') {
$sql = 'INSERT INTO '.$SQL->tableName('z_ots_guildcomunication').' (id, name, type, action, param1, param2, param3, param4, param5, param6, param7, delete_it) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', \'login\', \'give_item\', '.$SQL->quote($buy_offer['item_id']).', '.$SQL->quote($buy_offer['item_count']).', \'\', \'\', \'item\', '.$SQL->quote($buy_offer['name']).', \'\', \'1\');';
$SQL->query($sql);

$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', '.$SQL->quote($buy_offer['item_id']).', \'\', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);

$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
 $color1 = 'green'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green'; $color5 = 'green'; 
$main_content .= '
<div id="ProgressBar" >
<center><h2>Character World Transfer</h2></center>
<div id="MainContainer" >
<div id="BackgroundContainer" >
<img id="BackgroundContainerLeftEnd" src="'.$layout_name.'/images/vips/stonebar-left-end.gif" />
<div id="BackgroundContainerCenter">
<div id="BackgroundContainerCenterImage" style="background-image:url('.$layout_name.'/images/vips/stonebar-center.gif);" />
</div>
</div>
<img id="BackgroundContainerRightEnd" src="'.$layout_name.'/images/vips/stonebar-right-end.gif" />
</div>
<img id="TubeLeftEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-left-green.gif" />
<img id="TubeRightEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-right-'.$color1.'.gif" />
<div id="FirstStep" class="Steps" >
<div class="SingleStepContainer" >
<img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-0-green.gif" />
<div class="StepText" style="font-weight:normal;" >Item Selected</div>
</div>
</div>
<div id="StepsContainer1" ><div id="StepsContainer2" ><div class="Steps" style="width:50%" >
<div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color2.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-3-'.$color3.'.gif" /><div class="StepText" style="font-weight:normal;" >Confirm Data</div>
</div></div><div class="Steps" style="width:50%" ><div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color4.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-4-'.$color5.'.gif" />
<div class="StepText" style="font-weight:normal;" >Transfer Result</div></div></div></div></div></div></div>';
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS="white"><b>Item added successfully !</b></td>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<TD>
Item was sent to the player <b>'.$buy_player->getName().'</b> for <b>'.$buy_offer['points'].' guild points</b> from your account.<br />
Now you have <b>'.$user_guild_points.' guild points</b>.
</TD>
</TR>
</TABLE>
<br /><form action="index.php?subtopic=shopguild" method="post"><input type="submit" value="Back to Shop" class="btn btn-primary" /></form><br /><br />';}

//////////////////////////

elseif($buy_offer['type'] == 'outfit') {
	
$my_acc_id = $buy_player->getCustomField('id');
$playerinfo = $SQL->query('SELECT * FROM '.$SQL->tableName('players').' WHERE '.$SQL->fieldName('id').' = '.$my_acc_id.';')->fetch();
	
if ($playerinfo['online'] >= '0') { 
	
$sql = 'INSERT INTO '.$SQL->tableName('z_ots_guildcomunication').' (id, name, type, action, param1, param2, param3, param4, param5, param6, param7, delete_it) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', \'login\', \'give_outfit\', \'\', \'\', '.$SQL->quote($buy_offer['name']).', \'\', \'outfit\', '.$SQL->quote($buy_offer['name']).', '.$SQL->quote($buy_offer['points']).', \'1\');';
$SQL->query($sql);

$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', \'0004\', '.$SQL->quote($buy_offer['name']).', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);

$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];

$color1 = 'green'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green'; $color5 = 'green'; 

$main_content .= '
<div id="ProgressBar" >
<center><h2>Character World Transfer</h2></center>
<div id="MainContainer" >
<div id="BackgroundContainer" >
<img id="BackgroundContainerLeftEnd" src="'.$layout_name.'/images/vips/stonebar-left-end.gif" />
<div id="BackgroundContainerCenter">
<div id="BackgroundContainerCenterImage" style="background-image:url('.$layout_name.'/images/vips/stonebar-center.gif);" />
</div>
</div>
<img id="BackgroundContainerRightEnd" src="'.$layout_name.'/images/vips/stonebar-right-end.gif" />
</div>
<img id="TubeLeftEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-left-green.gif" />
<img id="TubeRightEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-right-'.$color1.'.gif" />
<div id="FirstStep" class="Steps" >
<div class="SingleStepContainer" >
<img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-0-green.gif" />
<div class="StepText" style="font-weight:normal;" >Item Selected</div>
</div>
</div>
<div id="StepsContainer1" ><div id="StepsContainer2" ><div class="Steps" style="width:50%" >
<div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color2.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-3-'.$color3.'.gif" /><div class="StepText" style="font-weight:normal;" >Confirm Data</div>
</div></div><div class="Steps" style="width:50%" ><div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color4.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-4-'.$color5.'.gif" />
<div class="StepText" style="font-weight:normal;" >Transfer Result</div></div></div></div></div></div></div>';
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS="white"><b>Outfit added successfully!</b></td>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<TD>
The <b>'.$buy_offer['name'].'</b> outfits was sent to the player <b>'.$buy_player->getName().'</b> for <b>'.$buy_offer['points'].' guild points</b> from your account.<br />
Now you have <b>'.$user_guild_points.' guild points</b>.
</TD>
</TR>
</TABLE>
<br /><form action="index.php?subtopic=shopguild" method="post"><input type="submit" value="Back to Shop" class="btn btn-primary" /></form><br /><br />';}
} else {
$main_content .= '<center><b>'.$buy_player->getName().' has to be offline to complete transaction!.</b><br /><br /><a href="index.php?subtopic=shopguild">Go back</a><br />';
}
//////////////////////////////
if($buy_offer['type'] == 'vipdays') {
$player_vip_time = $buy_player_account->getCustomField('vip_time');
$player_lastlogin = $buy_player_account->getCustomField('lastday');
$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_pacc').' (id, to_name, to_account, from_nick, from_account, price, pacc_days, trans_state, trans_start, trans_real) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).', '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', '.$SQL->quote($buy_offer['days']).', \'realized\', '.$SQL->quote(time()).', '.$SQL->quote(time()).');';
$SQL->query($save_transaction);
$nomedoComprador = $buy_player_account->getName();
if($player_vip_time > 0){
	$newVipDays = $player_vip_time + ($buy_offer['days'] * 86400);
	$merda = $SQL->query("UPDATE `accounts` SET `vip_time` = '$newVipDays' WHERE `name` = '$nomedoComprador'");
}else{
	$newVipDays2 = time() + ($buy_offer['days'] * 86400);
	$merda = $SQL->query("UPDATE `accounts` SET `vip_time` = '$newVipDays2' WHERE `name` = '$nomedoComprador'");
}
$nomedoCara = $account_logged->getName();
$anyThing = $user_guild_points-$buy_offer['points'];
$SQL->query("UPDATE `accounts` SET `guild_points` = '$anyThing' WHERE `name` = '$nomedoCara'");
$user_guild_points = $user_guild_points - $buy_offer['points'];
if ($player_vip_days >= 1) {
}
$main_content .= '<center><h2>VIP Days added!</h2><b>'.$buy_offer['days'].' days</b> of VIP days added to the account of player <b>'.$buy_player->getName().'</b> for <b>'.$buy_offer['points'].' guild points</b> from your account.<br />Now you have <b>'.$user_guild_points.' guild points</b>.<br /><br /><a href="index.php?subtopic=shopguild">Go to Shop Site</a><br />';} 
elseif($buy_offer['type'] == 'itemvip') {
$sql = 'INSERT INTO '.$SQL->tableName('z_ots_guildcomunication').' (id, name, type, action, param1, param2, param3, param4, param5, param6, param7, delete_it) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', \'login\', \'give_item\', '.$SQL->quote($buy_offer['item_id']).', '.$SQL->quote($buy_offer['megaitems_count']).', \'\', \'\', \'megaitems\', '.$SQL->quote($buy_offer['name']).', \'\', \'1\');';
$SQL->query($sql);
$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).',  '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', '.$SQL->quote($buy_offer['item_id']).', \'\', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
$main_content .= '<center><h2>Mega Item added!</h2><b>'.$buy_offer['name'].'</b> added to player <b>'.$buy_player->getName().'</b> for <b>'.$buy_offer['points'].' guild points</b> from your account.<br>Now you have <b>'.$user_guild_points.' guild points</b>.<br><br><a href="index.php?subtopic=shopguild">GO TO MAIN SHOP SITE</a><br>';
}
elseif($buy_offer['type'] == 'container') {
$sql = 'INSERT INTO '.$SQL->tableName('z_ots_guildcomunication').' (id, name, type, action, param1, param2, param3, param4, param5, param6, param7, delete_it) VALUES (NULL, '.$SQL->quote($buy_player->getName()).', \'login\', \'give_item\', '.$SQL->quote($buy_offer['item_id']).', '.$SQL->quote($buy_offer['item_count']).', '.$SQL->quote($buy_offer['container_id']).', '.$SQL->quote($buy_offer['container_count']).', \'container\', '.$SQL->quote($buy_offer['name']).', \'\', \'1\');';
$SQL->query($sql);
$save_transaction = 'INSERT INTO '.$SQL->tableName('z_shopguild_history_item').' (id, to_name, to_account, from_nick, from_account, price, offer_id, offer_desc, trans_state, trans_start, trans_real) VALUES ('.$SQL->lastInsertId().', '.$SQL->quote($buy_player->getName()).', '.$SQL->quote($buy_player_account->getId()).', '.$SQL->quote($buy_from).', '.$SQL->quote($account_logged->getId()).', '.$SQL->quote($buy_offer['points']).', '.$SQL->quote($buy_offer['name']).', \'wait\', '.$SQL->quote(time()).', \'0\');';
$SQL->query($save_transaction);
$account_logged->setCustomField('guild_points', $user_guild_points-$buy_offer['points']);
$user_guild_points = $user_guild_points - $buy_offer['points'];
$main_content .= '<center><h2>Container of items added!</h2><b>'.$buy_offer['name'].'</b> added to player <b>'.$buy_player->getName().'</b> for <b>'.$buy_offer['points'].' guild points</b> from your account.<br />Now you have <b>'.$user_guild_points.' guild points</b>.<br /><br /><a href="index.php?subtopic=shopguild">GO TO MAIN SHOP SITE</a><br />';
}} 
else {
if($buy_offer['type'] != 'changename') {
$set_session = TRUE;
$_SESSION['viewed_confirmation_page'] = 'yes';
if(empty($_REQUEST['page'])) { $color1 = 'blue'; $color2 = 'green-blue'; $color3 = 'blue'; $color4 = 'blue'; $color5 = 'blue'; }
if($_REQUEST['action'] == 'confirm_transaction') { $color1 = 'blue'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green-blue'; $color5 = 'blue'; }
if($_REQUEST['page'] == 'transfer') { $color1 = 'green'; $color2 = 'green'; $color3 = 'green'; $color4 = 'green'; $color5 = 'green'; }
$main_content .= '
<div id="ProgressBar" >
<center><h2>Shop Buy Item</h2></center>
<div id="MainContainer" >
<div id="BackgroundContainer" >
<img id="BackgroundContainerLeftEnd" src="'.$layout_name.'/images/vips/stonebar-left-end.gif" />
<div id="BackgroundContainerCenter">
<div id="BackgroundContainerCenterImage" style="background-image:url('.$layout_name.'/images/vips/stonebar-center.gif);" />
</div>
</div>
<img id="BackgroundContainerRightEnd" src="'.$layout_name.'/images/vips/stonebar-right-end.gif" />
</div>
<img id="TubeLeftEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-left-green.gif" />
<img id="TubeRightEnd" src="'.$layout_name.'/images/vips/progress-bar-tube-right-'.$color1.'.gif" />
<div id="FirstStep" class="Steps" >
<div class="SingleStepContainer" >
<img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-0-green.gif" />
<div class="StepText" style="font-weight:normal;" >Item Selected</div>
</div>
</div>
<div id="StepsContainer1" ><div id="StepsContainer2" ><div class="Steps" style="width:50%" >
<div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color2.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-3-'.$color3.'.gif" /><div class="StepText" style="font-weight:normal;" >Confirm Data</div>
</div></div><div class="Steps" style="width:50%" ><div class="TubeContainer" ><img class="Tube" src="'.$layout_name.'/images/vips/progress-bar-tube-'.$color4.'.gif" /></div><div class="SingleStepContainer" ><img class="StepIcon" src="'.$layout_name.'/images/vips/progress-bar-icon-4-'.$color5.'.gif" />
<div class="StepText" style="font-weight:normal;" >Transfer Result</div></div></div></div></div></div></div>';
$main_content .= '
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Shop Box</div>
<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
</div>
</div>
<table class="Table5" cellpadding="0" cellspacing="0">
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
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="#505050"><td colspan="3"><font color="white"><b>Confirm transaction</b></font></td></tr>
<tr bgcolor="'.$config['site']['darkborder'].'"><td><b>Image:</b></td><td width="550" colspan="2">';
if ($buy_offer['type'] == 'pacc')
	$main_content .= '<img src="images/shop/premium.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'vipdays')
	$main_content .= '<img src="images/shop/vip.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'redskull') 
	$main_content .= '<img src="images/shop/skull.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'unban') 
	$main_content .= '<img src="images/shop/ban.gif" height="32" width="32" />';
elseif ($buy_offer['type'] == 'item')
	if(file_exists('images/items/'.$buy_offer['item_id'].'.gif')) {
		$main_content .= '<img src="images/items/'.$buy_offer['item_id'].'.gif" height="32" width="32">';
	} else {
		$main_content .= '<img src="images/items/notfound.gif" height="32" width="32">';
	}
elseif ($buy_offer['type'] == 'outfit')
	if(file_exists($layout_name.'/images/outfits/'.$buy_offer['name'].'_male.gif')) {
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$buy_offer['name'].'_male.gif"">';
		$main_content .= '<img src="'.$layout_name.'/images/outfits/'.$buy_offer['name'].'_female.gif"">';
	} else {
		$main_content .= '<img src="'.$layout_name.'/images/outfits/notfound.gif">';
	}	
	
elseif ($buy_offer['type'] == 'itemvip')
	if(file_exists('images/items/'.$buy_offer['item_id'].'.gif')) {
		$main_content .= '<img src="images/items/'.$buy_offer['item_id'].'.gif" height="32" width="32">';
	} else {
		$main_content .= '<img src="images/items/notfound.gif" height="32" width="32">';
	}
$main_content .='<br /><small><b>'.$buy_offer['name'].'</b></small></td></tr>
<tr bgcolor="'.$config['site']['lightborder'].'"><td><b>Description:</b></td><td width="550" colspan="2">'.$buy_offer['description'].'</td></tr>';
$main_content .='
<tr bgcolor="'.$config['site']['darkborder'].'">
<td><b>Cost:</b></td>
<td width="550" colspan="2"><b>'.$buy_offer['points'].' guild points</b> from your account</td>
</tr>';
$main_content .='
<tr bgcolor="'.$config['site']['lightborder'].'"><td><b>For Player:</b></td><td width="550" colspan="2">'.$buy_player->getName().' <small>[<a href="index.php?subtopic=characters&name='.$buy_player->getName().'" target="_blank">View Character</a>]</small></td></tr>
<tr bgcolor="'.$config['site']['darkborder'].'"><td><b>Confirm Transaction?</b></td>
<td><form action="index.php?subtopic=shopguild&action=confirm_transaction" method="POST">
<input type="hidden" name="buy_confirmed" value="yes">
<input type="hidden" name="buy_id" value="'.$buy_id.'">
<input type="hidden" name="buy_from" value="'.urlencode($new_name).'">
<input type="hidden" name="buy_name" value="'.urlencode($buy_name).'">
<input type="submit" value="Accept" class="btn btn-success" />
</form>
</td>
<td>
<form action="index.php?subtopic=shopguild" method="POST">
<input type="submit" value="Cancel" class="btn btn-danger" />
</form>
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
</div><br />';
} else {
$set_session = TRUE;
$_SESSION['viewed_confirmation_page'] = 'yes';
$main_content .= '<center>
<div class="TableContainer">
<div class="CaptionContainer">
<div class="CaptionInnerContainer">
<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
<div class="Text">Shop Box</div>
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
<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr bgcolor="#505050"><td colspan="3"><font color="white" size="4"><b>Confirm transaction</b></font></td></tr>
<tr bgcolor="#D4C0A1"><td width="130"><b>Name:</b></td><td width="550" colspan="2">'.$buy_offer['name'].'</td></tr>
<tr bgcolor="#F1E0C6"><td width="130"><b>Description:</b></td><td width="550" colspan="2">'.$buy_offer['description'].'</td></tr>
<tr bgcolor="#D4C0A1"><td width="130"><b>Cost:</b></td><td width="550" colspan="2"><b>'.$buy_offer['points'].' guild points</b></td></tr>
<tr bgcolor="#F1E0C6"><td width="130"><b>Current Name:</b></td><td width="550" colspan="2"><font color="red">'.$buy_player->getName().'</font></td></tr>
<tr bgcolor="#D4C0A1"><td width="130"><b>New Name:</b></td><td width="550" colspan="2"><font color="red">'.$buy_from.'</font></td></tr>
<tr bgcolor="#F1E0C6"><td width="130"><b>Change Name?</b></td><td width="275" align="left">
<form action="index.php?subtopic=shopguild&action=confirm_transaction" method="POST">
<input type="hidden" name="buy_confirmed" value="yes">
<input type="hidden" name="buy_id" value="'.$buy_id.'">
<input type="hidden" name="buy_from" value="'.urlencode($buy_from).'">
<input type="hidden" name="buy_name" value="'.urlencode($buy_name).'">
<input type="submit" value="Accept">
</form>
</td>
<td align="right"><form action="index.php?subtopic=shopguild" method="POST">
<input type="submit" value="Cancel">
</form>
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
';
}}} 
else {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="5" WIDTH="100%">
<tr BGCOLOR="'.$config['site']['vdarkborder'].'">
<td CLASS="white"><b>Error</b></td>
</tr>
<tr BGCOLOR='.$config['site']['darkborder'].'>
<td>Player with name <b>'.$buy_name.'</b> doesn\'t exist. Please <a href="index.php?subtopic=shopguild&action=select_player&buy_id='.$buy_id.'">select other name</a>.</td>
</tr>
</TABLE>';
}
} else {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
<TD CLASS=white><B>Shoping Error</B></TD>
</TR>
<TR BGCOLOR='.$config['site']['darkborder'].'>
<td>
<TABLE BORDER="0" CELLSPACING="1" cellpadding="4">
<TR>
<TD>Invalid name format. Please <a href="index.php?subtopic=shopguild&action=select_player&buy_id='.$buy_id.'">select other name</a>.</TD>
</TR>
</TABLE>
</td>
</tr>
</TABLE><br />';}
} else {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="5" WIDTH="100%">
<tr BGCOLOR="'.$config['site']['vdarkborder'].'">
<td CLASS="white"><b>Error</b></td>
</tr>
<tr BGCOLOR='.$config['site']['darkborder'].'>
<td>For this item you need <b>'.$buy_offer['points'].'</b> points. You have only <b>'.$user_guild_points.'</b> guild points. Please <a href="index.php?subtopic=shopguild">select other item</a> or buy guild points.</td>
</tr>
</TABLE>';
}}
else {
$main_content .= '<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="5" WIDTH="100%">
<tr BGCOLOR="'.$config['site']['vdarkborder'].'">
<td CLASS="white"><b>Error</b></td>
</tr>
<tr BGCOLOR='.$config['site']['darkborder'].'>
<td>Offer with ID <b>'.$buy_id.'</b> doesn\'t exist. Please <a href="index.php?subtopic=shopguild">select item</a> again.</td>
</tr>
</TABLE>';
}}}}
if(!$set_session) {
unset($_SESSION['viewed_confirmation_page']);
}}
	elseif($action == 'show_history') {
		if(!$logged) {
			$main_content .= 'Please login first.';
		} else{
			
			$items_history_received = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shopguild_history_item').' WHERE '.$SQL->fieldName('to_account').' = '.$SQL->quote($account_logged->getId()).' OR '.$SQL->fieldName('from_account').' = '.$SQL->quote($account_logged->getId()).';');
			if(is_object($items_history_received)) {
				foreach($items_history_received as $item_received) {
					
					if($item_received['offer_id'] != 0001 && $item_received['offer_id'] != 0002 && $item_received['offer_id'] != 0003 && $item_received['offer_id'] != 0004)
					{	
						if($account_logged->getId() == $item_received['to_account'])
							$char_color = 'green';
						else
							$char_color = 'red';						
						
						$items_received_text .= '<tr bgcolor="#F1E0C6"><td><font color="'.$char_color.'">'.$item_received['to_name'].'</font></td><td>';
							
						if($account_logged->getId() == $item_received['from_account'])
							$items_received_text .= '<i>Your account</i>';
						else
							$items_received_text .= $item_received['from_nick'];					
						
						$items_received_text .= '</td><td>'.$item_received['offer_id'].'</td><td>'.$item_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $item_received['trans_start']).'</td>';
						
						if($item_received['trans_real'] > 0)
							$items_received_text .= '<td>'.date("j F Y, H:i:s", $item_received['trans_real']).'</td>';
						else
							$items_received_text .= '<td><b><font color="red">Not realized yet.</font></b></td>';
							
						$items_received_text .= '</tr>';
					}		
							
					else {
								
						$services_received_text .= '<tr bgcolor="#F1E0C6"><td>';
						
						if($item_received['offer_id'] == 0001)	
							$services_received_text .= 'Character name <b>'.$item_received['to_name'].'</b> changed to name <b>'.$item_received['from_nick'].'</b>.';
						elseif ($item_received['offer_id'] == 0002)
							$services_received_text .= 'Skull removed from character name <b>'.$item_received['to_name'].'</b>.';
						elseif ($item_received['offer_id'] == 0003)
							$services_received_text .= 'The character <b>'.$item_received['to_name'].'</b> has been unbanned.';
						elseif ($item_received['offer_id'] == 0004)
							$services_received_text .= 'The <b>'.$item_received['offer_desc'].'</b> outfits to character <b>'.$item_received['to_name'].'</b> .';
						
						$services_received_text .= '</td>';			
						
						$services_received_text .= '<td>'.$item_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $item_received['trans_start']).'</td>';
						
						$services_received_text .= '</tr>';
						
					}
				}
			}

			$itemsguild_history_received = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shopguild_history_item').' WHERE '.$SQL->fieldName('to_account').' = '.$SQL->quote($account_logged->getId()).' OR '.$SQL->fieldName('from_account').' = '.$SQL->quote($account_logged->getId()).';');
			if(is_object($itemsguild_history_received)) {
				foreach($itemsguild_history_received as $itemguild_received) {
					
					if($itemguild_received['offer_id'] != 0001 && $itemguild_received['offer_id'] != 0002 && $itemguild_received['offer_id'] != 0003)
					{	
						if($account_logged->getId() == $itemguild_received['to_account'])
							$char_color = 'green';
						else
							$char_color = 'red';						
						
						$itemsguild_received_text .= '<tr bgcolor="#F1E0C6"><td><font color="'.$char_color.'">'.$itemguild_received['to_name'].'</font></td><td>';
							
						if($account_logged->getId() == $itemguild_received['from_account'])
							$itemsguild_received_text .= '<i>Your account</i>';
						else
							$itemsguild_received_text .= $itemguild_received['from_nick'];					
						
						$itemsguild_received_text .= '</td><td>'.$itemguild_received['offer_id'].'</td><td>'.$itemguild_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $itemguild_received['trans_start']).'</td>';
						
						if($itemguild_received['trans_real'] > 0)
							$itemsguild_received_text .= '<td>'.date("j F Y, H:i:s", $itemguild_received['trans_real']).'</td>';
						else
							$itemsguild_received_text .= '<td><b><font color="red">Not realized yet.</font></b></td>';
							
						$itemsguild_received_text .= '</tr>';
					}		
							
					else {
								
						$servicesguild_received_text .= '<tr bgcolor="#F1E0C6"><td>';
						
						if($itemguild_received['offer_id'] == 0001)	
							$servicesguild_received_text .= 'Character name <b>'.$itemguild_received['to_name'].'</b> changed to name <b>'.$itemguild_received['from_nick'].'</b>.';
						elseif ($itemguild_received['offer_id'] == 0002)
							$servicesguild_received_text .= 'Skull removed from character name <b>'.$itemguild_received['to_name'].'</b>.';
						elseif ($itemguild_received['offer_id'] == 0003)
							$servicesguild_received_text .= 'The character <b>'.$itemguild_received['to_name'].'</b> has been unbanned.';
						
						$servicesguild_received_text .= '</td>';			
						
						$servicesguild_received_text .= '<td>'.$itemguild_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $itemguild_received['trans_start']).'</td>';
						
						$servicesguild_received_text .= '</tr>';
						
					}
				}
			}
			
			$paccs_history_received = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shopguild_history_pacc').' WHERE '.$SQL->fieldName('to_account').' = '.$SQL->quote($account_logged->getId()).' OR '.$SQL->fieldName('from_account').' = '.$SQL->quote($account_logged->getId()).';');
			if(is_object($paccs_history_received)) {
				foreach($paccs_history_received as $pacc_received) {
					if($account_logged->getId() == $pacc_received['to_account'])
						$char_color = 'green';
					else
						$char_color = 'red';
						$paccs_received_text .= '<tr bgcolor="#F1E0C6"><td><font color="'.$char_color.'">'.$pacc_received['to_name'].'</font></td><td>';
					if($account_logged->getId() == $pacc_received['from_account'])
						$paccs_received_text .= '<i>Your account</i>';
					else
						$paccs_received_text .= $pacc_received['from_nick'];
						$paccs_received_text .= '</td><td>'.$pacc_received['pacc_days'].' days</td><td>'.$pacc_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $pacc_received['trans_real']).'</td></tr>';
				}
			}
			$paccsguild_history_received = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shopguild_history_pacc').' WHERE '.$SQL->fieldName('to_account').' = '.$SQL->quote($account_logged->getId()).' OR '.$SQL->fieldName('from_account').' = '.$SQL->quote($account_logged->getId()).';');
			if(is_object($paccsguild_history_received)) {
				foreach($paccsguild_history_received as $paccguild_received) {
					if($account_logged->getId() == $paccguild_received['to_account'])
						$char_color = 'green';
					else
						$char_color = 'red';
						$paccsguild_received_text .= '<tr bgcolor="#F1E0C6"><td><font color="'.$char_color.'">'.$paccguild_received['to_name'].'</font></td><td>';
					if($account_logged->getId() == $paccguild_received['from_account'])
						$paccsguild_received_text .= '<i>Your account</i>';
					else
						$paccsguild_received_text .= $paccguild_received['from_nick'];
						$paccsguild_received_text .= '</td><td>'.$paccguild_received['pacc_days'].' days</td><td>'.$paccguild_received['price'].' Points</td><td>'.date("j F Y, H:i:s", $paccguild_received['trans_real']).'</td></tr>';
				}
			}
			$main_content .= '<center><h1>Transactions History</h1></center>';
			if(!empty($items_received_text)) 
				$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Items | Items VIP\'s Guild\'s Transactions</div>
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
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
<center><table BORDER=0 CELLPADDING=1 CELLSPACING=1 WIDTH=100%><tr bgcolor="#D4C0A1"><td><b>To:</b></td><td><b>From:</b></td><td><b>Item ID</b></td><td><b>Cost</b></td><td><b>Buy on site</b></td><td><b>Received on game</b></td></tr>'.$items_received_text.'</table>
								</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
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
</div><br />';

if(!empty($services_received_text)) 
				$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Account Additional Guild\'s Transactions</div>
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
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
<center><table BORDER=0 CELLPADDING=1 CELLSPACING=1 WIDTH=100%><tr bgcolor="#D4C0A1"><td><b>Service description:</b></td><td><b>Cost</b></td><td><b>Buy on site</b></td></tr>'.$services_received_text.'</table>
								</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
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
</div><br />';

			if(!empty($paccs_received_text))
				$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Premium/VIP Days Guild\'s Transactions</div>
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
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
<center><table BORDER=0 CELLPADDING=1 CELLSPACING=1 WIDTH=100%><tr bgcolor="#D4C0A1"><td><b>To:</b></td><td><b>From:</b></td><td><b>Duration</b></td><td><b>Cost</b></td><td><b>Added:</b></td></tr>'.$paccs_received_text.'</table>
								</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
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
</div><br />';
			if(empty($paccs_received_text) && empty($items_received_text) && empty($itemsguild_received_text) && empty($services_received_text))
				$main_content .= '<center>You did not buy/receive any items or PACC.</center><br>';
		}
	}
}
if(!$logged)
$main_content .= '<br /><center><div class="notice"><b>Please login to see how much points you have</b></div></center>';
else
if($account_logged->getCustomField("guild_points") <= 0)
$main_content .='<br /><center><div class="error"><b>You do not have guild points available.</b><br /><br /><form action="index.php?subtopic=buypoints" method="post"><input type="submit" value="Buy now guild points here!" class="btn btn-success" /></form></div></center>'; 
else
if($account_logged->getCustomField("guild_points") >= 1)
$main_content .='<br /><center><div class="success" style="width: 300px;">You have&nbsp;<b>'.$account_logged->getCustomField("guild_points").'</b>&nbsp;guild points available</div></center>';

else
$main_content .= '
<div class="error">
Shop for disabled the internal maintenance, back in a moment with our standard systems.<br /><br /><b><small>Graciously, Staff</small></b>
</div>
';
?>