<?php

class Sellchar extends Conexao{
	
	
	
	function GetListBuyCharLast(){

        $query = "SELECT * FROM sellchar  ORDER BY id_sellchar DESC LIMIT 5 ";
		$this->ExecuteSQL($query);        
        $this->GetLista();
        
    }
	
	function GetSkills($id, $skill){

        $query = "SELECT * FROM player_skills WHERE player_id = :id AND skillid = :skill ";
		$this->ExecuteSQL($query);        
        $this->GetLista();
        
    }
	
	function GetListBuyChar(){

        $query = "SELECT * FROM sellchar  ORDER BY id_sellchar DESC ";
		$this->ExecuteSQL($query);        
        $this->GetLista();
        
    }
	
	function GetSellCharacters($id){  
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM sellchar WHERE id_sellchar = :id ";        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();        
    }
	
	function GetListCharsFromRemove($id){
        
        
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM sellchar WHERE old_idacc = :id ";
        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	
	
	private function GetLista(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id_sellchar'             => $lista['id_sellchar'] ,    
         'name_sellchar'             => $lista['name_sellchar'] ,    
         'price'             => $lista['price'] ,    
         'id_char'             => $lista['id_char'] ,    
         'old_idacc'             => $lista['old_idacc'] ,    
         'date'             => $lista['date'] ,      
        );
            $i++;
        
        endwhile;
        
        
    }
	
	
	public function SelectOnBuy($account,$player_id,$old_idacc,$priceonchar){		
		$query = ('UPDATE `players` SET account_id = :account WHERE id = :player_id ; ' );		
		$query .= ('UPDATE `accounts` SET premium_points = premium_points -:priceonchar WHERE id = :account ; ' );		
		$query .= ('UPDATE `accounts` SET premium_points = premium_points +:priceonchar WHERE id = :old_idacc ; ' );		
		$params = array(
		':account' => $account, 
		':player_id' => $player_id,
		':old_idacc' => $old_idacc,
		':priceonchar' => $priceonchar,
		);
		
		
		if($this->ExecuteSQL($query, $params)){
			return true;
		}else{
			return false;
		}
	}
	
	
	function DeleteOnBuy($id){
            
            
          $query = "DELETE FROM sellchar WHERE id_sellchar = :id ;"; 
          
          $params = array(':id'=> (int)$id);
            
           if($this->ExecuteSQL($query, $params)):
               return TRUE;
           else:
               return FALSE;
           endif;  
          
          
        } 
		
		
		
	function GetPlayersAcc($id){
		global $config;
		$level = $config['sellcharlevel'];    
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM players WHERE account_id = :id AND online = 0 AND level >= :level";        
        $params =  array(	':id'=>$id ,
							':level'=>$level,
							
							);
		$this->ExecuteSQL($query,$params);        
        $this->GetLista2();
        
    }
	function GetOnlinePlayer($id){
        
        
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM players WHERE id = :id";
        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista2();
        
    }
	function GetPlayersId($name){
        
        $query = "SELECT * FROM players WHERE name = :name ";
        
        $params =  array(':name'=>$name );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista2();
        
    }
	function GetPlayers2($name){
        
        $query = "SELECT * FROM players WHERE name = :name ";  
        $params =  array(':name'=>$name );
		$this->ExecuteSQL($query,$params);
        
    }
	function GetVocation2($name){
        
        $query = "SELECT * FROM players WHERE name = :name ";
        
        $params =  array(':name'=>$name );
		$this->ExecuteSQL($query,$params);  
		while ($lista = $this->ListarDados()):
		if ($lista['vocation'] == 1 ){
		$vocationsx = '<strong>Sorcerer</strong>';
		}
		elseif($lista['vocation'] == 1 and $lista['promotion'] == 1){
		$vocationsx = '<strong>Master Sorcerer</strong>';	
		}
		elseif($lista['vocation'] == 2 ){
		$vocationsx = '<strong>Druid</strong>';
		}
		elseif($lista['vocation'] == 2 and $lista['promotion'] == 1){
		$vocationsx = '<strong>Elder Druid</strong>';
		}
		elseif($lista['vocation'] == 3 ){
		$vocationsx = '<strong>Paladin</strong>';
		}
		elseif($lista['vocation'] == 3 and $lista['promotion'] == 1){
		$vocationsx = '<strong>Royal Paladin</strong>';
		}
		elseif($lista['vocation'] == 4 ){
		$vocationsx = '<strong>Knight</strong>';
		}
		elseif($lista['vocation'] == 4 and $lista['promotion'] == 1){
		$vocationsx = '<strong>Elite Knight</strong>';
		}
		endwhile;
		return $vocationsx;        
    }
	
	
	private function GetLista2(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id'             => $lista['id'] ,    
         'name'             => $lista['name'] ,    
         'world_id'             => $lista['world_id'] ,    
         'group_id'             => $lista['group_id'] ,    
         'account_id'             => $lista['account_id'] ,    
         'level'             => $lista['level'] ,      
         'vocation'             => $lista['vocation'] ,      
         'health'             => $lista['health'] ,      
         'healthmax'             => $lista['healthmax'] ,      
         'experience'             => $lista['experience'] ,      
         'lookbody'             => $lista['lookbody'] ,      
         'lookfeet'             => $lista['lookfeet'] ,      
         'lookhead'             => $lista['lookhead'] ,      
         'looklegd'             => $lista['looklegd'] ,      
         'looktype'             => $lista['looktype'] ,      
         'lookaddons'             => $lista['lookaddons'] ,      
         'maglevel'             => $lista['maglevel'] ,      
         'mana'             => $lista['mana'] ,      
         'manamax'             => $lista['manamax'] ,      
         'manaspent'             => $lista['manaspent'] ,      
         'soul'             => $lista['soul'] ,      
         'town_id'             => $lista['town_id'] ,      
         'posx'             => $lista['posx'] ,      
         'posy'             => $lista['posy'] ,      
         'posz'             => $lista['posz'] ,      
         'cap'             => $lista['cap'] ,      
         'sex'             => $lista['sex'] ,      
         'lastlogin'             => $lista['lastlogin'] ,      
         'lastip'             => $lista['lastip'] ,      
         'save'             => $lista['save'] ,      
         'skull'             => $lista['skull'] ,      
         'skulltime'             => $lista['skulltime'] ,      
         'rank_id'             => $lista['rank_id'] ,      
         'guild_nick'             => $lista['guild_nick'] ,      
         'last_logout'             => $lista['last_logout'] ,      
         'balance'             => $lista['balance'] ,      
         'stamina'             => $lista['stamina'] ,      
         'online'             => $lista['online'] ,      
        );
            $i++;
        
        endwhile;
        
        
    }
	
	
	
	
	
	
	
	function InserirChar($name_sellchar, $price, $id_char, $old_idacc){
        $id = NULL;
        // monto a SQL
        $query = " INSERT INTO sellchar (id_sellchar, name_sellchar, price, id_char, old_idacc )";
        $query.= " VALUES (:id, :name_sellchar, :price, :id_char, :old_idacc ) ;";
        $query.= " UPDATE players SET account_id = 2 WHERE id = :id_char ;";
        // passo so parametros
        $params = array(':id' => $id,
                        ':name_sellchar' => $name_sellchar,
                        ':price' => $price,
                        ':id_char' => $id_char,
                        ':old_idacc' => $old_idacc,
                      
            );
        // executo a minha SQL
            if($this->ExecuteSQL($query, $params)):
                return TRUE;
                
            else:
                return FALSE;
                
            endif;
        
        
    }
	
	
	
	function DeleteOnList($name, $id_account){
            
            
          $query = "DELETE FROM sellchar WHERE name_sellchar = :name ;"; 
          $query .= "UPDATE players SET account_id = :id_account WHERE name = :name ;"; 
          
          $params = array(	':name'=> $name,		  
							':id_account'=> (int)$id_account,
		  
		  );
            
           if($this->ExecuteSQL($query, $params)):
               return TRUE;
           else:
               return FALSE;
           endif;  
          
          
        }


	function UpdateFromSell($name, $id_account){
            
            
          $query = "DELETE FROM sellchar WHERE name_sellchar = :name ;"; 
          $query .= "UPDATE players SET account_id = :id_account WHERE name = :name ;"; 
          
          $params = array(	':name'=> $name,		  
							':id_account'=> (int)$id_account,
		  
		  );
            
           if($this->ExecuteSQL($query, $params)):
               return TRUE;
           else:
               return FALSE;
           endif;  
          
          
        }
		
		
		
		
		
		####################Auction System####################
		
		
		function GetAuctionSystem(){
        
        $query = "SELECT * FROM auction_system ";
        
        //$params =  array(':name'=>$name );
		$this->ExecuteSQL($query);        
        $this->GetLista3();
        
    }
	
	
	private function GetLista3(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id'             => $lista['id'] ,    
         'player'             => $lista['player'] ,    
         'item_id'             => $lista['item_id'] ,    
         'item_name'             => $lista['item_name'] ,    
         'count'             => $lista['count'] ,    
         'cost'             => $lista['cost'] ,      
         'date'             => $lista['date'] ,            
        );
            $i++;
        
        endwhile;
        
        
    }
		
		
	
	
	
	
	
	
	
	
}