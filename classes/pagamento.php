<?php 

class Pagamento extends Conexao {

private $metodo, $mensagem;




    public function insertPagSeguro($account, $valor, $pagcode){
        $this->metodo = 'Pagseguro';
        $this->mensagem = 'Aguardando Pagamento';
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        $query = 'INSERT into comprovante (nome, metodo, mensagem, valor, pagcode) VALUES (:account, :metodo, :mensagem, :valor, :pagcode)';

        $params = array(
            ":account" => $account,
            ":metodo" => $this->metodo,
            ":mensagem" => $this->mensagem,
            ":valor" => $valor,
            ":pagcode" => $pagcode
        );

        if($this->ExecuteSQL($query, $params)):
            return TRUE;
            
        else:
            return FALSE;
            
        endif;
    }

    public function insertMercadoPago($account, $valor, $mpcode){
        $this->metodo = 'Mercado Pago';
        $this->mensagem = 'Aguardando Pagamento';
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        $query = 'INSERT into comprovante (nome, metodo, mensagem, valor, mpcode) VALUES (:account, :metodo, :mensagem, :valor, :mpcode)';

        $params = array(
            ":account" => $account,
            ":metodo" => $this->metodo,
            ":mensagem" => $this->mensagem,
            ":valor" => $valor,
            ":mpcode" => $mpcode
        );

        if($this->ExecuteSQL($query, $params)):
            return TRUE;
            
        else:
            return FALSE;
            
        endif;
    }


    public function updatePagSeguro($pagcode, $status){
        
        if($status == 'PAID'){
            $status = 'Aprovado';
        }
        elseif($status == 'CANCELLED'){
            $status = 'Reprovado';
        }

        $query = "UPDATE comprovante SET mensagem = :mensagem WHERE pagcode = :pagcode";

        $params = array(
            ":pagcode" => $pagcode,
            ":mensagem" => $status
        );
    }

    



    public function getDonateList($inicio, $qnt_result_pg, $account){
        $query = "SELECT * FROM comprovante WHERE nome = '$account' ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
        $this->ExecuteSQL($query);        
        $this->GetLista();
    }


    function Inserir($anexo){
            $mensagem = 'Pendente';
            // monto a SQL
            $query = " INSERT INTO comprovante (mensagem, anexo )";
            $query.= " VALUES (:mensagem, :anexo)";
            // passo so parametros
            $params = array(
                            ':mensagem' => $mensagem,
                            ':anexo' => $anexo,
                        
            );
            // executo a minha SQL
                if($this->ExecuteSQL($query, $params)):
                    return TRUE;
                    
                else:
                    return FALSE;
                    
                endif;

    }

public function updatePayment($id, $anexo){
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $mensagem = "Pendente";
        $query = " UPDATE comprovante SET `mensagem` = :mensagem, `anexo` = :anexo WHERE id = :id ;";

        $params = array(
            ':mensagem' => $mensagem,
            ':anexo' => $anexo,
            ':id' => $id,
        );
        if($this->ExecuteSQL($query, $params)):
            return TRUE;
            
        else:
            return FALSE;
            
        endif;

}

public function InsertPaymentNew($account, $metodo, $valor){
        $id = NULL;
        $email = ' ';
        $account = filter_var($account, FILTER_SANITIZE_STRING);
        $valor = filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        $metodo = filter_var($metodo, FILTER_SANITIZE_STRING);
		$mensagem = 'Aguardando Pagamento';
        // monto a SQL
        $query = " INSERT INTO comprovante (id, nome, metodo, email, mensagem, valor )";
        $query.= " VALUES (:id, :account, :metodo, :email, :mensagem, :valor)";
        // passo so parametros
        $params = array(':id' => $id,
                        ':email' => $email,
                        ':account' => $account,
                        ':metodo' => $metodo,
                        ':valor' => $valor,
                        ':mensagem' => $mensagem,
                      
        );
        // executo a minha SQL
            if($this->ExecuteSQL($query, $params)):
                return TRUE;
                
            else:
                return FALSE;
                
            endif;
        
        
}
    public function getPagamentosId($id){
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM comprovante WHERE id = :id ;";

        $params = array(
            ":id" => $id,
        );

        $this->ExecuteSQL($query, $params);
        $this->GetLista();
    }	
	
	function GetPagamentos($account){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM comprovante WHERE nome = :account ORDER BY id DESC ";
		
		//$query .= $this->PaginacaoLinks("id", "comprovante");
        
        $params =  array(':account'=>$account );
		
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
    function GetPagamentos2($account){
        
        
        //$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT); 
        $query = "SELECT * FROM comprovante WHERE nome = :account ";
		
		//$query .= $this->PaginacaoLinks("id", "comprovante");
        
        $params =  array(':account'=>$account );
		
		$this->ExecuteSQL($query,$params);        
        $this->GetLista();
        
    }
	
	private function GetLista(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id'             => $lista['id'] ,    
         'nome'             => $lista['nome'],    
         'metodo'             => $lista['metodo'] ,    
         'email'             => $lista['email'] ,    
         'mensagem'             => $lista['mensagem'] ,    
         'valor'             => $lista['valor'] ,    
         'anexo'             => $lista['anexo'] ,    
         'motivo'             => $lista['motivo'] ,    
        );
            $i++;
        
        endwhile;
		
	}
	
	public function GetUpdatePointsStatus($id,$pontos,$nome){
		
		$mensagem = 'Aprovado';
		
		$query = ('UPDATE `accounts` SET premium_points = premium_points + :pontos, backup_points = backup_points +:pontos WHERE name = :nome  ; ');
		$query .= ('UPDATE `comprovante` SET mensagem = :mensagem WHERE id = :id  ; ');
		
		$params = array(
		':id' => (int)$id, 
		':pontos' => (int)$pontos, 
		':nome' => $nome, 
		':mensagem' => $mensagem,
		);
		
		
		if($this->ExecuteSQL($query, $params)){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	
}