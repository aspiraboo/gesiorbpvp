<?php
class Conexao {    
    private   $host,
              $user,
              $senha,
              $banco;    
    protected $obj,
              $itens=array(),
              $prefix;    
    public    $paginacaolinks;    
    public $totalpags;

             
    
    function __construct() {        
        global $config;
        $this->host     = $config['paymentConnection']['BD_HOST'];
        $this->user     = $config['paymentConnection']['BD_USER'];
        $this->senha    = $config['paymentConnection']['BD_SENHA'];
        $this->banco    = $config['paymentConnection']['BD_BANCO'];        
        $this->prefix   = $config['paymentConnection']['BD_PREFIX'];        
        try {           
              if($this->Conectar() == null):                  
                    $this->Conectar();              
              endif;            
          } catch (Exception $e) {
             exit($e->getMessage() . ' <h2>OPS... Erro no banco de dados, tente novamente mais tarde</h2>');
          }
    }
   /**
    * 
    * @return \PDO link  com dados da conexao
    */
   private function Conectar(){        
        $options = array(
                          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                         );        
        $link =  new PDO("mysql:host={$this->host};dbname={$this->banco}",
                $this->user, $this->senha, $options);       
        return $link;
    }
    function ExecuteSQL($query,array $params =NULL){        
        $this->obj = $this->Conectar()->prepare($query);
           if(!empty($params)):
               foreach ($params as $key => $value):
                $this->obj->bindValue($key, $value);
               endforeach;
           endif;
             return $this->obj->execute();
         
                                  
    }
    function ListarDados(){        
        return $this->obj->fetch(PDO::FETCH_ASSOC);
    }
  
    function TotalDados(){
        return $this->obj->rowCount();
    }
	
    function GetItens(){
        return $this->itens;
        
    }
   
    function PaginacaoLinks($campo,$tabela){
        
        // instancia o objeto de paginação
        $pag = new Paginacao();
        
        //executo a base da paginação
        $pag->GetPaginacao($campo, $tabela);
        
        // recebo os links das paginas pelo numero de paginas
        $this->paginacaolinks = $pag->link;
        
        //recebo o total de paginas
        $this->totalpags = $pag->totalpags;
        
        // definino o inicio e o fim para limitar a sqç
        $inicio = $pag->inicio;  
        $limite = $pag->limite; //  1 2 4 -  6 8 9  - 15 20 23 -  25
        //
        // retorno a SQL de complemento
           
        if($this->totalpags > 0 ):
            
                   return " limit {$inicio},{$limite}" ; 
             else:
                  return " " ;  
        endif;
             

               
       
    }
    
    /*
     * retorna uma lista  com as paginas para escolher
     */
    protected function Paginacao($paginas=array()){
       
        // monto a UL (LISTA)  com os itens da pagianção
         $pag = '<ul class="pagination "  >';
                   
           $pag .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li class="page-link"><a href="index.php?subtopic=accountmanagement?p=1"><< Inicio</a></li>';
           error_reporting(0);
                foreach ($paginas as $p):
           $pag .= '<li class="page-link"><a href="index.php?subtopic=accountmanagement?p='.$p.'">'. $p.'</a></li>';

                endforeach;
                   
                $pag .= '<li class="page-link"><a href="index.php?subtopic=accountmanagement?p='.$this->totalpags.'">  Ultima >> </a></li>';         
               
         $pag .='</ul>'; 
         // retorna a paginação somente se tiver + de uma página de itens
         if($this->totalpags > 1):
            return $pag;  
         endif;
        
        
    }
    /**
     * 
     * @return array com a paginaçao em links
     */
    function ShowPaginacao(){
        //  retorno a paginação para o controller
        return $this->Paginacao($this->paginacaolinks);
        
    }
    
   
    
    
    
}
