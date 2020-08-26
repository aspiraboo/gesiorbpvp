<?php 


class Fatura extends Conexao {
    private $doublepoints;
	private $tripple;
	
	function getfatura($id){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM picpay WHERE account_name = :id ORDER BY id DESC LIMIT 1";
        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	function getfatura3($id){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM picpay WHERE id = :id ORDER BY id DESC LIMIT 1";
        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	
	function GetRef($ref){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM picpay WHERE ref = :ref ";
        
        $params =  array(':ref'=>$ref );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	
	function GetAtualizar($id){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM picpay WHERE id = :id ";
        
        $params =  array(':id'=>$id );
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	
	
	function getfatura2(){
        
        
        $query = "SELECT * FROM `picpay` ORDER BY `picpay`.`id` DESC LIMIT 1";
        
		$this->ExecuteSQL($query);        
        $this->GetLista();
        
    }
	
	
	
	
	
	private function GetLista(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id'             => $lista['id'] ,    
         'ref'             => $lista['ref'] ,    
         'valor'             => $lista['valor'] ,    
         'status'             => $lista['status'] ,    
         'account_name'             => $lista['account_name'] ,    
         'link'             => $lista['link'] ,    
         'pontos'             => $lista['pontos'] ,    
        );
            $i++;
        
        endwhile;
        
        
    }
	
	public function ref($id){
		
		$ref = rand(100, 9999999);
		$query = ('UPDATE `picpay` SET `ref` = :ref WHERE id = :id');
		
		$params = array(
		':ref' => $ref, 
		':id' => $id,
		);
		if($this->ExecuteSQL($query, $params)){
			return true;
		}else{
			return false;
		}
		
	}
	public function update($ref,$status){
		$this->GetRef($ref);
		foreach ($this->GetItens() as $take):
            $pontos = $take['pontos'];
            $account_name = $take['account_name'];
		endforeach;
        $this->doublepoints = 2;
        $this->tripple = 3;
        
		//echo $this->tripple;
            if ($pontos >= 100):
                $query = ('UPDATE `picpay` SET status = :status WHERE ref = :ref ; ' );
                $query .= (' UPDATE `accounts` SET premium_points = premium_points + :pontos * 3, backup_points = backup_points + :pontos * '.$this->tripple.' WHERE name = :account_name ; ' );
            elseif($pontos >= 20):
                $query = ('UPDATE `picpay` SET status = :status WHERE ref = :ref ; ' );
                $query .= (' UPDATE `accounts` SET premium_points = premium_points + :pontos * :doublepoints, backup_points = backup_points + :pontos * :doublepoints WHERE name = :account_name ; ' );
            else:
                $query = ('UPDATE `picpay` SET status = :status WHERE ref = :ref ; ' );
                $query .= (' UPDATE `accounts` SET premium_points = premium_points + :pontos , backup_points = backup_points + :pontos WHERE name = :account_name ; ' );

            endif;
		
		
		$query .= " UPDATE comprovante SET mensagem = 'Aprovado' WHERE picpaycode = :ref ;";
		
		
		 $params = array(
                ':ref' => $ref, 
                ':status' => $status,
                ':pontos' => $pontos,
                ':doublepoints' => $this->doublepoints,
                ':account_name' => $account_name,

            );
		
		
		if($this->ExecuteSQL($query, $params)){
			return true;
		}else{
			return false;
		}
	}
	
	function Inserir($ref, $valor, $account_name, $link){
        $id = NULL;
		$status = 'Pendente';
        // monto a SQL
        $query = " INSERT INTO picpay (id, ref, valor, pontos, status, account_name, link )";
        $query.= " VALUES (:id, :ref, :valor, :valor, :status , :account_name, :link)";
        // passo so parametros
        $params = array(':id' => $id,
                        ':ref' => (int)$ref,
                        ':valor' => $valor,
                        ':status' => $status,
                        ':account_name' => $account_name,
                        ':link' => $link,
                      
            );
        // executo a minha SQL
            if($this->ExecuteSQL($query, $params)):
                return TRUE;
                
            else:
                return FALSE;
                
            endif;
        
        
    }

    public function InserirComp($ref, $valor, $account_name){
        $id = NULL;
        $metodo = 'PicPay';
		$status = 'Aguardando Pagamento';
        // monto a SQL
        $query = " INSERT INTO comprovante (id, nome, metodo, mensagem, valor, picpaycode )";
        $query.= " VALUES (:id, :account_name, :metodo, :status, :valor, :ref)";
        // passo so parametros
        $params = array(':id' => $id,
                        ':ref' => (int)$ref,
                        ':valor' => $valor,
                        ':status' => $status,
                        ':account_name' => $account_name,
                        ':metodo' => $metodo
                      
            );
        // executo a minha SQL
            if($this->ExecuteSQL($query, $params)):
                return TRUE;
                
            else:
                return FALSE;
                
            endif;
        
        
    }
	
	
}