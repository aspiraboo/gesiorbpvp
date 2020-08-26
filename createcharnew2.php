<?php
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
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

//var_dump($_POST);

if (isset($_POST['submitCreateChar'])) {
   $newchar_name = ucwords(strtolower(trim($_POST['newcharname'])));
   $newchar_sex = $_POST['newcharsex'];
   $newchar_vocation = $_POST['newcharvocation'];
   $newchar_town = $_POST['newchartown'];
   $world_id = 0;
   //echo $newchar_name.'<br>'.$newchar_sex.'<br>'.$newchar_vocation.'<br>'.$newchar_town;

   if (empty($newchar_name)) {
      ////echo json_encode(array('success' => "notDigit"));
      $sucess = "notDigit";
      $newchar_errors = 1;
   }
   if (empty($newchar_sex) && $newchar_sex != "0") {
      //echo json_encode(array('success' => 'noCharSex'));
      $sucess = "noCharSex";

      $newchar_errors = 1;
   }
   if (empty($newchar_vocation)) {
      //echo json_encode(array('success' => "noVocation"));
      $newchar_errors = 1;
      $sucess = "noVocation";
   }
   if (empty($newchar_town)) {
      //echo json_encode(array('success' => 'noTown'));
      $newchar_errors = 1;
      $sucess = "noTown";
   }
   if (!check_name_new_char($newchar_name)) {
      //echo json_encode(array('success' => "charInvalid"));
      $newchar_errors = 1;
      $sucess = "charInvalid";
   }
   if ($newchar_sex != 1 && $newchar_sex != "0") {
      //echo json_encode(array('success' => "invalidCharSex"));
      $newchar_errors = 1;
      $sucess = "invalidCharSex";
   }



   if (empty($newchar_errors)) {
      $check_name_in_database = new Player();
      $check_name_in_database->find($newchar_name);
      if ($check_name_in_database->isLoaded()) {
         //echo json_encode(array('success' => 'existchar'));
         $sucess = "existchar";

         $newchar_errors = 1;
      }
   }




   if (empty($newchar_errors)) {
      $char_to_copy_name = $config['site']['newchar_vocations'][$world_id][$newchar_vocation];
      $char_to_copy = new Player();
      $char_to_copy->find($char_to_copy_name);
      if (!$char_to_copy->isLoaded())
         $newchar_errors = 1;
   }


   if (empty($newchar_errors)) {

      $char_to_copy->getItems()->load();
      $char_to_copy->loadSkills();
      //echo $newchar_sex;

      if ($newchar_sex == "0" || $newchar_sex == "1") {
         $char_to_copy->setLookType(136);
         $char_to_copy->setID(null); // save as new character
         $char_to_copy->setLastIP(0);
         $char_to_copy->setLastLogin(0);
         $char_to_copy->setLastLogout(0);
         $char_to_copy->setName($newchar_name);
         $char_to_copy->setAccount($account_logged);
         $char_to_copy->setSex($newchar_sex);
         $char_to_copy->setTown($newchar_town);
         $char_to_copy->setPosX(0);
         $char_to_copy->setPosY(0);
         $char_to_copy->setPosZ(0);
         $char_to_copy->setBalance(0);
         $char_to_copy->setWorldID((int) $world_id);
         $char_to_copy->setCreateIP(Visitor::getIP());
         $char_to_copy->setCreateDate(time());
         $char_to_copy->setSave(); // make character saveable
         $char_to_copy->save(); // now it will load 'id' of new player
      }
      if ($char_to_copy->isLoaded()) {
         $char_to_copy->saveItems();
         $char_to_copy->saveSkills();
         //echo json_encode(array('success' => 1));
         $sucess = 1;
      } else {
         //echo "Error. Can\'t create character. Probably problem with database. Try again or contact with admin.";
         echo json_encode(array('success' => 0));
         exit;
      }
   }
   echo json_encode(array('success' => $sucess));
   //CHARACTERS
   $main_content .= '
<div class="RowsWithOverEffect" id="loadCharList">
   <div class="TableContainer">
      <div class="CaptionContainer">
         <div class="CaptionInnerContainer">
            <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/content/box-frame-edge.gif);"></span> 
            <span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/content/box-frame-edge.gif);"></span> 
            <span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/content/table-headline-border.gif);"></span> 
            <span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/content/box-frame-vertical.gif);"></span>
            <div class="Text">Characters</div>
            <span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/content/box-frame-vertical.gif);"></span> 
            <span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/content/table-headline-border.gif);"></span> 
            <span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/content/box-frame-edge.gif);"></span> 
            <span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/content/box-frame-edge.gif);"></span> 
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
                                    <div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/content/table-shadow-rt.gif);"></div>
                                 </div>
                                 <div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/content/table-shadow-rm.gif);">
                                    <div class="TableContentContainer">
                                       <table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
                                          <tbody>
                                             <tr class="LabelH">
                                                <td></td>
                                                <td style="width:40%;">Name</td>
                                                <td style="width:120px!important;">World</td>
                                                <td style="width:90px!important;">Status</td>
                                                <td style="width:90px!important;">&nbsp;</td>
                                             </tr>
                                             <div id="">
                                                ';
   $account_players = $account_logged->getPlayersList();
   //show list of players on account
   $var = 0;
   foreach ($account_players as $account_player) {
      $player_number_counter++;
      if ($var == 0) {
         $preview = ' previewstate="0"';
      } else {
         $preview = '';
      }
      if ($var == 0) {
         $display = 'block';
      } else {
         $display = 'none';
      }
      if ($var == 0) {
         $displayNum = 'none';
      } else {
         $displayNum = 'inline';
      }
      if ($var == 0) {
         $displayBold = 'bold';
      } else {
         $displayBold = 'normal';
      }
      if ($var == 0) {
         $displayFont = '13';
      } else {
         $displayFont = '10';
      }
      $main_content .= '																			
                                                <tr id="CharacterRow_' . $player_number_counter . '" 
                                                   onmouseover="InRowWithOverEffect(&#39;CharacterRow_' . $player_number_counter . '&#39;,';
      if (is_int($player_number_counter / 2))
         $main_content .= '&#39;#e7d1af&#39;';
      else
         $main_content .= '&#39;#ffedd1&#39;';
      $main_content .= '
                                                   );"
                                                   onmouseout="OutRowWithOverEffect(&#39;CharacterRow_' . $player_number_counter . '&#39;,';
      if (is_int($player_number_counter / 2))
         $main_content .= '&#39;#d5c0a1&#39;';
      else
         $main_content .= '&#39;#f1e0c6&#39;';
      $main_content .= '
                                                   );" 
                                                   onclick="FocusCharacter(' . $player_number_counter . ', &#39;' . urlencode($account_player->getName()) . '&#39;, ' . $config['site']['max_players_per_account'] . ');" 
                                                   class="Odd" style="font-weight: ' . $displayBold . ';';
      if (is_int($player_number_counter / 2))
         $main_content .= 'background-color: #d5c0a1;">
                                                   ';
      else
         $main_content .= 'background-color: #f1e0c6;">';
      $main_content .= '
                                                   <td style="width:40px;text-align:center;padding:2px;">
                                                      <span id="CharacterNumberOf_' . $player_number_counter . '" style="display: ' . $displayNum . ';">' . $player_number_counter . '.</span>
                                                      <span id="PlayButtonOf_' . $player_number_counter . '" style="display: ' . $display . ';">
                                                      <span name="FlashClientPlayButton" id="FlashClientPlayButton" playlink="#" ' . $preview . '>';
      if ($account_player->isDeleted()) {
         $main_content .= '<img style="border:0px;" src="' . $layout_name . '/images/account/play-not-button.gif">';
      } else {
         $main_content .= '
                                                      <a href="#" >
                                                      <img style="border:0px;" onmouseover="InMiniButton(this, &#39;&#39;);" onmouseout="OutMiniButton(this, &#39;&#39;);" src="' . $layout_name . '/images/account/play-button.gif">
                                                      </a>';
      }
      $main_content .= '
                                                      </span>
                                                      </span>
                                                   </td>
                                                   <td id="CharacterCell2_' . $player_number_counter . '">
                                                      <span style="white-space:nowrap;vertical-align:middle;">
                                                      <span id="CharacterNameOf_' . $player_number_counter . '" style="font-size: ' . $displayFont . 'pt;">' . htmlspecialchars($account_player->getName()) . '</span><br>
                                                      <span id="CharacterNameOf_' . $player_number_counter . '"><small>' . htmlspecialchars($vocation_name[$account_player->getPromotion()][$account_player->getVocation()]) . ' - Level ' . $account_player->getLevel() . '</small></span>
                                                      </span>
                                                   </td>
                                                   <td id="CharacterCell2_' . $player_number_counter . '">
                                                      <span style="white-space:nowrap;">' . htmlspecialchars($config['server']['serverName']) . '</span>
                                                   </td>
                                                   <td id="CharacterCell3_' . $player_number_counter . '">';
      if (!$account_player->isOnline())
         $main_content .= '';
      else
         $main_content .= '<font color="#00CD00"><b>online</b></font>';
      if ($account_player->isDeleted()) {
         $main_content .= 'deleted';
      }
      $main_content .= '
                                                   </td>
                                                   <td id="CharacterCell4_' . $player_number_counter . '" style="text-align:center;">
                                                      <span id="CharacterOptionsOf_' . $player_number_counter . '" style="display: ' . $display . ';">
                                                      <span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=changecomment&name=' . urlencode($account_player->getName()) . '">Edit</a>]</span>';
      if ($account_player->isDeleted()) {
         $main_content .= '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=undelete&name=' . urlencode($account_player->getName()) . '">Undelete</a>]</span>';
      } else {
         $main_content .= '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=deletecharacter&name=' . urlencode($account_player->getName()) . '">Delete</a>]</span>';
      }
      $main_content .= '
                                                      </span>
                                                   </td>
                                                </tr>
                                                ';
      $var++;
   }
   $main_content .= '
                                             </div>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="TableShadowContainer">
                                    <div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/content/table-shadow-bm.gif);">
                                       <div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/content/table-shadow-bl.gif);"></div>
                                       <div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/content/table-shadow-br.gif);"></div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <table class="InnerTableButtonRow" cellpadding="0" cellspacing="0">
                                    <tbody>
                                       <tr>
                                          <td></td>
                                          <td align="right" style="padding-right:7px;width:100%;">
                                             <button class="btn btn-link" data-toggle="modal" data-target="#ModalCreateChar">
                                                <div class="BigButton" style="background-image:url(' . $layout_name . '/images/buttons/sbutton.gif)">
                                                   <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
                                                      <div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/buttons/sbutton_over.gif);"></div>
                                                      <input class="ButtonText" type="image" name="Create Character" alt="Create Character" src="' . $layout_name . '/images/buttons/_sbutton_createcharacter.gif">
                                                   </div>
                                                </div>
                                             </button>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
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
</div>
<div class="modal fade" id="ModalCreateChar" tabindex="-5" role="dialog" aria-labelledby="ModalCreateChar" aria-hidden="true" style="background-color: rgba(0,0,0,0.5);">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
      <div class="modal-content" style="background-color: rgba(0,0,0,0);">
         <div class="TableContainer">
            <table class="Table3" cellpadding="0" cellspacing="0">
               <div class="CaptionContainer">
                  <div class="CaptionInnerContainer">
                     <span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);" />
                     </span><span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);" /></span>
                     <span class="CaptionBorderTop" style="background-image:url(./layouts/tibiacom/images/content/table-headline-border.gif);"></span>
                     <span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiacom/images/content/box-frame-vertical.gif);" /></span>
                     <div class="Text">Create Character</div>
                     <span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiacom/images/content/box-frame-vertical.gif);" /></span>
                     <span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/content/table-headline-border.gif);"></span>
                     <span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);" /></span>
                     <span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);" /></span>
                  </div>
               </div>
               <tr>
                  <td>
                     <div class="InnerTableContainer">
                        <table style="width:100%;">
                           <tr>
                              <td>
                                 <div class="TableShadowContainerRightTop">
                                    <div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/content/table-shadow-rt.gif);"></div>
                                 </div>
                                 <div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/content/table-shadow-rm.gif);">
                                    <form id="formCreateChar" method="post">
                                       <div class="TableContentContainer">
                                          <table class="TableContent" width="100%">
                                             <tr class="LabelH">
                                                <td style="width:50%;"><span>Name</td>
                                                <td><span >Sex</td>
                                             </tr>
                                             <tr class="Odd" >
                                                <td>
                                                   <br>
                                                   <input id="newcharname" class="form-control form-control-sm" name="newcharname" value="" size="30" maxlength="29" ><BR>
                                                   <div id="carregando"></div>
                                                   <font size="1" face="verdana,arial,helvetica">
                                                      <div id="name_check">Please enter your character name.</div>
                                                   </font>
                                                </td>
                                                <td >
                                                   <div class="was-validated" style="margin-top:-10px">
                                                      <select name="newcharsex" id="newcharsex" class="custom-select custom-select-sm" required>
                                                         <option value="">Select Your Sex</option>
                                                         <option value="1">Male</option>
                                                         <option value="0">Female</option>
                                                      </select>
                                                   </div>
                                                </td>
                                                <input type="hidden" id="newchartown" name="newchartown" value="' . $config['site']['newchar_towns2'] . '">
                                             </tr>
                                          </table>
                                       </div>
                                 </div>
                        </table>
                     </div>
                     <div class="InnerTableContainer" >
                     <table style="width:100%;" >
                     <tr>
                     <td colspan="2">
                     <table class="TableContent" width="100%" >
                     <tr class="Odd" valign="top">
                     <td width="160"><br /><b>Select your vocation:</b></td>
                     <td>
                     <table class="TableContent" width="100%" cellspacing="1">
                     <tr style="">
                     <td style="">
                     <nobr>
                     <div class="col-sm">
                     <label for="newcharvocation"><img id="imgCreateCharSorc" src="../images/create/sorcerer.png" class="img-ms-form2" style="width:120px; height: 285px;"/></label>
                     <div class="radio">
                     <input type="radio" name="newcharvocation" id="newcharvocation" value="1" checked="checked" required>
                     <label class="radio"></label>									
                     </div>
                     </div>
                     </nobr>
                     </td>
                     <td>
                     <div class="col-sm">
                     <label for="newcharvocation-1"><img id="imgCreateCharDruid" src="../images/create/druid.png" class="img-ms-form" style="width:120px; height: 285px;"/></label>
                     <div class="radio">
                     <label class="radio"><input type="radio" name="newcharvocation" id="newcharvocation-1" value="2" required></label>
                     </div>
                     </div>
                     </td>
                     <td>
                     <div class="col-sm">
                     <label for="newcharvocation-2"><img id="imgCreateCharPaladin" src="../images/create/paladin.png" class="img-ms-form" style="width:120px; height: 285px; "/></label>
                     <div class="radio">
                     <label class="radio"><input type="radio" name="newcharvocation" id="newcharvocation-2" value="3" required></label>
                     </div>
                     </div>
                     </td>
                     <td>
                     <div class="col-sm">
                     <label for="newcharvocation-3"><img id="imgCreateCharKnight" src="../images/create/knight.png" class="img-ms-form" style="width:120px; height: 285px;"/></label>
                     <div class="radio">
                     <label class="radio"><input type="radio" name="newcharvocation" id="newcharvocation-3" value="4" required></label>
                     </div>
                     </div>
                     </td>
                     </tr>
                     <tr>
                     <td align="center" colspan="2">
                     <div id="loadMsgCreateChar" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex; color: black;">
                     <div class="swal2-success-circular-line-left" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <span class="swal2-success-line-tip" style="color: black;"></span>
                     <span class="swal2-success-line-long" style="color: black;"></span>
                     <div class="swal2-success-ring" style="color: black;"></div> 
                     <div class="swal2-success-fix" style="background-color: rgba(255, 255, 255, 0);"></div>
                     <div class="swal2-success-circular-line-right" style="background-color: rgba(255, 255, 255, 0);"></div>
                     </div>
                     <div class="text-center text-success"> Char Criado com sucesso.</div>
                     </div>
                     <div id="loadCreateChar"></div>
                     </td>
                     </tr>
                     <tr>
                     <td align="center" colspan="2">
                     <div id="loadMsgCreateCharError" style="display: none; margin-left: 170px;">
                     <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                     <div class="text-center text-danger" id="msgErrorCreateChar"></div>
                     </div>
                     </td>
                     </tr>									
                     </tr>
                     <tr><td><div id="carregando"></div><div id="loadImgCreateChar" style="display:none" ></div><div id="imgCreateChar" style="z-index: 1200"></div></td><td></td></tr>
                     </table>
                     </table>
                     </td>
                     </tr>
                     <tr align="center">
                     <td style="border:0px;" style="background-color:#f1e0c6">
                     <button class="btn btn-link" id="btnCreateChar" >												
                     <div class="BigButton" id="" style="background-image:url(./layouts/tibiacom/images/buttons/sbutton.gif)" >
                     <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
                     <div class="BigButtonOver" style="background-image:url(./layouts/tibiacom/images/buttons/sbutton_over.gif);" ></div>
                     <input id="submitCreateChar" name="submitCreateChar" type="hidden" value="1">
                     <input class="ButtonText" type="image" id="" name="" alt="Submit" src="./layouts/tibiacom/images/buttons/_sbutton_submit.gif" >
                     </div>
                     </div>
                     </button>	
                     </td></form>
                     <td style="border:0px;" >
                     <button class="btn btn-link" data-dismiss="modal" aria-label="Fechar">
                     <div class="BigButton" style="background-image:url(./layouts/tibiacom/images/buttons/sbutton.gif)" >
                     <div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
                     <div class="BigButtonOver" style="background-image:url(./layouts/tibiacom/images/buttons/sbutton_over.gif);" ></div>
                     <input class="ButtonText" type="image" name="Back" alt="Back" src="./layouts/tibiacom/images/buttons/_sbutton_back.gif" >
                     </div>
                     </div>
                     </button>
                     </td>
                     </tr>
                     </table>
                     </div>
            </table>
         </div>
         </td></tr>
      </div>
   </div>
</div>
<br><br>';
} else {
   header("Location: index.php?subtopic=latestnews");
}
//echo $newchar_errors;
//echo '<br>'.$opa;
