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

if(isset($_POST['accountid'])){
    echo "vamos la testando";
}

echo '
<div class="RowsWithOverEffect">
   <div class="TableContainer">
      <div class="CaptionContainer">
         <div class="CaptionInnerContainer">
            <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span> 
            <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span> 
            <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span> 
            <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
            <div class="Text">Characters</div>
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
                                                foreach($account_players as $account_player)
                                                {
                                                $player_number_counter++;
                                                if($var==0) {
                                                $preview = ' previewstate="0"';
                                                } else {
                                                $preview = '';
                                                }
                                                if($var==0) {
                                                $display = 'block';
                                                } else {
                                                $display = 'none';
                                                }
                                                if($var==0) {
                                                $displayNum = 'none';
                                                } else {
                                                $displayNum = 'inline';
                                                }
                                                if($var==0) {
                                                $displayBold = 'bold';
                                                } else {
                                                $displayBold = 'normal';
                                                }
                                                if($var==0) {
                                                $displayFont = '13';
                                                } else {
                                                $displayFont = '10';
                                                }
                                                echo'
                                                <div id="loadCharList">
                                                   <tr id="CharacterRow_'.$player_number_counter.'" 
                                                      onmouseover="InRowWithOverEffect(&#39;CharacterRow_'.$player_number_counter.'&#39;,';
                                                      if(is_int($player_number_counter / 2))
                                                      echo '&#39;#e7d1af&#39;';
                                                      else
                                                      echo '&#39;#ffedd1&#39;'; 
                                                      echo'
                                                      );"
                                                      onmouseout="OutRowWithOverEffect(&#39;CharacterRow_'.$player_number_counter.'&#39;,'; 
                                                      if(is_int($player_number_counter / 2))
                                                      echo '&#39;#d5c0a1&#39;';
                                                      else
                                                      echo '&#39;#f1e0c6&#39;';																				
                                                      echo'
                                                      );" 
                                                      onclick="FocusCharacter('.$player_number_counter.', &#39;'.urlencode($account_player->getName()).'&#39;, '.$config['site']['max_players_per_account'].');" 
                                                      class="Odd" style="font-weight: '.$displayBold.';';
                                                      if(is_int($player_number_counter / 2))
                                                      echo 'background-color: #d5c0a1;">
                                                      ';
                                                      else
                                                      echo 'background-color: #f1e0c6;">';
                                                      echo'
                                                      <td style="width:40px;text-align:center;padding:2px;">
                                                         <span id="CharacterNumberOf_'.$player_number_counter.'" style="display: '.$displayNum.';">'.$player_number_counter.'.</span>
                                                         <span id="PlayButtonOf_'.$player_number_counter.'" style="display: '.$display.';">
                                                         <span name="FlashClientPlayButton" id="FlashClientPlayButton" playlink="#" ' . $preview . '>';
                                                         if($account_player->isDeleted())
                                                         {
                                                         echo '<img style="border:0px;" src="'.$layout_name.'/images/account/play-not-button.gif">';
                                                         } else {
                                                         echo '
                                                         <a href="#" >
                                                         <img style="border:0px;" onmouseover="InMiniButton(this, &#39;&#39;);" onmouseout="OutMiniButton(this, &#39;&#39;);" src="'.$layout_name.'/images/account/play-button.gif">
                                                         </a>';
                                                         }
                                                         echo'
                                                         </span>
                                                         </span>
                                                      </td>
                                                      <td id="CharacterCell2_'.$player_number_counter.'">
                                                         <span style="white-space:nowrap;vertical-align:middle;">
                                                         <span id="CharacterNameOf_'.$player_number_counter.'" style="font-size: '.$displayFont.'pt;">'.htmlspecialchars($account_player->getName()).'</span><br>
                                                         <span id="CharacterNameOf_'.$player_number_counter.'"><small>'.htmlspecialchars($vocation_name[$account_player->getPromotion()][$account_player->getVocation()]).' - Level '.$account_player->getLevel().'</small></span>
                                                         </span>
                                                      </td>
                                                      <td id="CharacterCell2_'.$player_number_counter.'">
                                                         <span style="white-space:nowrap;">'.htmlspecialchars($config['server']['serverName']).'</span>
                                                      </td>
                                                      <td id="CharacterCell3_'.$player_number_counter.'">';
                                                         if(!$account_player->isOnline())
                                                         echo '';
                                                         else
                                                         echo '<font color="#00CD00"><b>online</b></font>';
                                                         if($account_player->isDeleted())
                                                         {
                                                         echo 'deleted';
                                                         }
                                                         echo'
                                                      </td>
                                                      <td id="CharacterCell4_'.$player_number_counter.'" style="text-align:center;">
                                                         <span id="CharacterOptionsOf_'.$player_number_counter.'" style="display: '.$display.';">
                                                         <span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=changecomment&name='.urlencode($account_player->getName()).'">Edit</a>]</span>';
                                                         if($account_player->isDeleted())
                                                         {
                                                         echo '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=undelete&name='.urlencode($account_player->getName()).'">Undelete</a>]</span>';
                                                         } else {
                                                         echo '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=deletecharacter&name='.urlencode($account_player->getName()).'">Delete</a>]</span>';
                                                         }
                                                         echo '
                                                         </span>
                                                      </td>
                                                   </tr>
                                                </div>
                                                ';
                                                $var++;
                                                }																		
                                                echo'
                                             </div>
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
                           <tr>
                              <td>
                                 <table class="InnerTableButtonRow" cellpadding="0" cellspacing="0">
                                    <tbody>
                                       <tr>
                                          <td></td>
                                          <td align="right" style="padding-right:7px;width:100%;">
										  <button class="btn btn-link" data-toggle="modal" data-target="#ModalCreateChar">									<div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)">
										  <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);"></div>
										  <input class="ButtonText" type="image" name="Create Character" alt="Create Character" src="'.$layout_name.'/images/buttons/_sbutton_createcharacter.gif">
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
</div>';