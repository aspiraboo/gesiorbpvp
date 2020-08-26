<?php
require_once $vendorDir ."./mercadopago/sdk/lib/mercadopago.php";
/**
 * Description of PagamentoMP
 *
 * @Maycon
 */
class PagamentoMP extends Conexao{
    private $doublepoints;
    /**
     * @var type string: link para o pagamento
     */
    public $btn_mp;
    /**
     *
     * @var bool se vai usar lightbox ou não
     */
    private $lightbox = true;

       /***array com davdos da transação ****/
    public $info = array();
    /**
     *
     * @var bool se é sandbox ou não  
     */
    private $sandbox = false; //sandbox ou nao 
   
    /**
     * método de requisição de pagamento 
     */
    public function PagarMP($ref, $valor, $cliente = [], $account_name) {
        global $config;
        // iniciando as credenciais no MP
        $mp = new MP($config['payment']['mercadoPago']['client_id'], $config['payment']['mercadoPago']['client_secret']);

        $preference_data = array(   
            // dados do produto para pagamento 
            "items" => array(
                array(
                    "id" => $ref,
                    "title" => $account_name,
                    "currency_id" => "BRL",
                    "picture_url" => "https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                    "description" => $account_name,
                    "quantity" => 1,
                    "unit_price" => $valor,
                )
            ),
            // dados pessoais do comprador 
           "payer" => array(
              "name" => $cliente['cli_nome'],
               "surname" => $cliente['cli_sobrenome'],
               "email" => $cliente['cli_email'],
               "phone" => array(
                    "area_code" => $cliente['cli_ddd'],
                    "number" => $cliente['cli_celular']
                ),
               "identification" => array(
                   "type" => "CPF",
                    "number" => $cliente['cli_cpf']
                ),
                "address" => array(
                    "street_name" => $cliente['cli_endereco'],
                    "street_number" => $cliente['cli_numero'],
                   "zip_code" => $cliente['cli_cep']
                )
           ),
          
            // páginas de retorno 
            "back_urls" => array(
                "success" => $config['payment']['site_name'].'?subtopic=pedido_retorno_mp',
                "failure" => $config['payment']['site_name'].'?subtopic=pedido_retorno_mp',
                "pending" => $config['payment']['site_name'].'?subtopic=pedido_retorno_mp',
              
            ),
            // página para receber notificações de pagamento
            "notification_url" => $config['payment']['site_name'].'?subtopic=pedido_retorno_mp',
            // referencia do pedido dentro do site
            "external_reference" => $ref,
        );

		try {
        // empacotando toda requisição de pagamento
        $preference = $mp->create_preference($preference_data);
		} catch(\Exception $e){
			echo "Houve alguma falha durante a comunicação, por favor contate o Administrador.";
		}
		
        //cria link para o botão de pagamento normal ou sandbox
        if($this->sandbox):
            // sandbox
            $mp->sandbox_mode(TRUE);
            $this->btn_mp = '<a href="' . $preference["response"]["sandbox_init_point"] . '" name="MP-Checkout" class="btn btn-success btn-lg">Pagar com Mercado Pago</a>';
        else:
            // normal
            $mp->sandbox_mode(FALSE);
            $this->btn_mp = '<a href="' . $preference["response"]["init_point"] . '" name="MP-Checkout" class="btn btn-success btn-lg">Pagar com Mercado Pago</a>';
            
        endif;
       
        // caso queira em lightBox
        if ($this->lightbox):
            $this->btn_mp .= '<script type="text/javascript" src="https://secure.mlstatic.com/mptools/render.js"></script>';
        endif;
		
    }

    /**
     * 
     * @param string $ref  com código referencia do pedido
     */
    public function Retorno($id) {
        global $config;
        // iniciando as credenciais no MP
        //$mp = new MP ("3903846779", "EWOeWqxxOq7yAA");
        $mp = new MP($config['payment']['mercadoPago']['client_id'], $config['payment']['mercadoPago']['client_secret']);
        $params = ["access_token" => $mp->get_access_token()];

        $topic = 'payment';
// Get the payment reported by the IPN. Glossary of attributes response in https://developers.mercadopago.com
        if ($topic == 'payment'):

            $payment_info = $mp->get("/collections/notifications/" . $id, $params, false);
            $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"], $params, false);
// Get the merchant_order reported by the IPN. Glossary of attributes response in https://developers.mercadopago.com    
        endif;

//If the payment's transaction amount is equal (or bigger) than the merchant order's amount you can release your items 
        if ($merchant_order_info["status"] == 200):
            $transaction_amount_payments = 0;
            $transaction_amount_order = $merchant_order_info["response"]["total_amount"];
            $payments = $merchant_order_info["response"]["payments"];
            foreach ($payments as $payment) {
                if ($payment['status'] == 'approved'):
                    $transaction_amount_payments += $payment['transaction_amount'];
                endif;
                $acc =  $payment["reason"];
            }
            if ($transaction_amount_payments >= $transaction_amount_order):
               // echo "release your items";              

            else:
              //  echo "dont release your items";
            endif;
           //echo '<pre>';

          
         //var_dump($payment_info);
          
          //echo '</pre>';
            
        endif;

        //tratando o status do pagamento ===================================
        switch ($payment_info["response"]["collection"]["status"]):

            case "approved" : $status = "Pagamento Efetuado"; //O pagamento foi aprovado e creditado.
                break;
            case "pending" : $status = "Aguardando Pagamento";    //O usu�rio n�o concluiu o processo de pagamento.
                break;
            case "in_process" : $status = "Aguardando Pagamento"; //O pagamento est� sendo analisado.
                break;
            case "rejected" : $status = "Rejeitado"; //O pagamento foi recusado. O usu�rio pode tentar novamente.
                break;
            case "refunded" : $status = "Devolvido"; //(estado terminal)    O pagamento foi devolvido ao usu�rio.
                break;
            case "cancelled" : $status = "Cancelado"; //(estado terminal)   O pagamento foi cancelado por superar o tempo necess�rio para ser efetuado ou por alguma das partes.
                break;
            case "in_mediation": $status = "Disputa"; //    Foi iniciada uma disputa para o pagamento.
                break;
        endswitch;
        
        // tratando os tipos de pagamento 
        switch ($payment_info["response"]["collection"]["payment_type"]):

            case "ticket" : $forma = "Boleto";
                break;
            case "account_money" : $forma = "Saldo MP";
                break;
            case "credit_card" : $forma = "Cartão Credito";
                break;
            default : $forma = $payment_info["response"]["collection"]["payment_type"];
        endswitch;

        
        // algumas variaveis ----------------------------
        $cod   = $payment_info["response"]["collection"]["id"];
        $ref   = $payment_info["response"]["collection"]["external_reference"];
        $valor = $payment_info["response"]["collection"]["transaction_amount"];
        $status= $status;
        $acc = $payment_info["response"]["collection"]["reason"];
        

        $multiplier = $config['payment']['mercadoPago']['multiplier'];
         $this->SelectMercado($cod);
            while($lista = $this->ListarDados()):

               $ativado =  $lista['ativado'];
            endwhile;


        //echo $cod;
    if (@$this->InserirPedido($cod,$status,$forma,$ref,$valor,$acc,$multiplier)){

    }else{
       
    }


    if ($status == "Pagamento Efetuado" AND $ativado == 0):
    $this->UpdateAccount($acc,$valor,$cod,$multiplier);
    echo '<center><h3>Pagamento Confirmado, pontos creditados em sua conta. Você receberá os pontos em '.$multiplier.'x do valor. Obrigado pela sua doação.</h3></center>';

        else:
            

            endif; 

        //echo $valor;
       


//chama o método que faz update no pedido
         $this->PedidoUpdate($cod, $status, $forma, $ref);
        // passo valores  para meu array INFO
        $this->info = array(
            'pago' => $status,
            'codigo' => $cod,
            'referencia' => $ref,
            'forma_pag' => $forma
        );

      
//        // print_r($this->info);
         }

    /**
 * grava atualização de status na tabela pedidos
 * @param string $codigo
 * @param string $pago
 * @param string $forma_pag
 * @param string $referencia
 */
    private function InserirPedido($codigo,$pago,$forma_pag,$referencia,$valor,$acc,$multiplier){ 

        $query = "INSERT INTO mercadopagox (name, forma, valor, ped_ref, id_mercado, status,pontos) VALUES ";
        $query .= '(:name, :forma, :valor, :ref, :cod, :pago, :valor * :multiplier) ; ';
        //$query .= 'INSERT into comprovante (nome, metodo, mensagem, valor, mpcode) VALUES (:name, "Mercado Pago", "Aguardando Pagamento", :valor, :cod) ; ';

        $params = array(
                            ':cod'  =>$codigo,
                            ':pago' =>$pago,
                            ':forma'=>$forma_pag,
                            ':ref'  =>$referencia,
                            ':valor' =>$valor,
                            ':name' =>$acc,               
                            ':multiplier' =>$multiplier,               


                           );

        $this->ExecuteSQL($query, $params);

    }
    private function PedidoUpdate($codigo,$pago,$forma_pag,$referencia){        
                  
           // montando a SQL
            $query = "UPDATE mercadopagox SET id_mercado = :cod, ";
            $query .="status = :pago, forma = :forma  WHERE ped_ref = :ref";
           
            // passando parâmetros                             
            $params = array(
                            ':cod'  =>$codigo,
                            ':pago' =>$pago,
                            ':forma'=>$forma_pag,
                            ':ref'  =>$referencia,            

                           );
            
           //var_dump($params); 
            
                // chamo o método da classe conexão que executa a SQL
                $this->ExecuteSQL($query, $params);

        
    }
     private function UpdateAccount($accout,$valor,$cod,$multiplier){        
                  
           // montando a SQL
            $this->doublepoints = 2;
            if($valor >= 100):
              $multiplier = 3;
              $query = "UPDATE accounts SET premium_points = premium_points + :valor * :multiplier, backup_points = backup_points + :valor * :multiplier WHERE name = :accout ; ";
              $query .= " UPDATE mercadopagox SET ativado = 1 WHERE id_mercado = :cod ; " ;
              $query .= " UPDATE comprovante SET mensagem = 'Aprovado' WHERE mpcode = :cod ;" ;
              elseif($valor >= 20):
                $query = "UPDATE accounts SET premium_points = premium_points + :valor * :doublepoints, backup_points = backup_points + :valor * :doublepoints WHERE name = :accout ; ";
                $query .= " UPDATE mercadopagox SET ativado = 1 WHERE id_mercado = :cod ; " ;
                $query .= " UPDATE comprovante SET mensagem = 'Aprovado' WHERE mpcode = :cod ;" ;
            else:
              $query = "UPDATE accounts SET premium_points = premium_points + :valor , backup_points = backup_points + :valor WHERE name = :accout ; ";
              $query .= " UPDATE mercadopagox SET ativado = 1 WHERE id_mercado = :cod ; " ;
              $query .= " UPDATE comprovante SET mensagem = 'Aprovado' WHERE mpcode = :cod ;" ;

            endif;
            
       
           
            // passando parâmetros                             
            $params = array(
                            ':accout'  =>$accout,
                            ':valor' =>$valor,  
                            ':cod' => $cod,
                            ':multiplier' => $multiplier,
                            ':doublepoints' => $this->doublepoints,          

                           );
            
           //var_dump($params); 
            
                // chamo o método da classe conexão que executa a SQL
                $this->ExecuteSQL($query, $params);

        
    }

    private function SelectMercado($id_mercado){

        $query = "SELECT * FROM mercadopagox WHERE id_mercado = :id_mercado";

        $params = array(
            ":id_mercado" => $id_mercado,
        );

             $this->ExecuteSQL($query, $params);

    }

    public function VerificaID($ref){

        // $ref = filter_var($ref,FILTER_SANITIZE_NUMBER_INT);

        $query = " SELECT * FROM mercadopagox WHERE ped_ref = :ref ; ";

        $params = array(
            ":ref" => $ref,
        );

             $this->ExecuteSQL($query, $params);

            $this->GetLista();
    }


     private function GetLista(){
        
        $i = 1;
        while ($lista = $this->ListarDados()):
            
        $this->itens[$i] = array(
         'id'                  => $lista['id'] ,  
         'name'                => $lista['name'] ,  
         'forma'               => $lista['forma'] ,  
         'ped_ref'             => $lista['ped_ref'] ,  
         'id_mercado'          => $lista['id_mercado'] ,   
         'status'              => $lista['status'] ,   
         'ativado'             => $lista['ativado'] ,   
         'pontos'              => $lista['pontos'] ,   

       
            
        );
        
        
            $i++;
        
        endwhile;
        
        
    }

    
}
