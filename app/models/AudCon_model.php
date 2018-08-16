<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AudCon_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getModulo1($limit)
    {
        $this->db->select('*');
        if($limit){
        $this->db->limit($limit);
        }
        //   ->join('risk_tabela_tuss', 'risk_tabela_tuss.codigo = risk_modulo_1.id_termo', 'left');
         //   ->join('categories', 'categories.id=products.category_id', 'left');
           // ->group_by('products.id');
        /*
        if ($this->Settings->overselling) {
            $this->db->where("({$this->db->dbprefix('products')}.name LIKE '%" . $term . "%' OR {$this->db->dbprefix('products')}.code LIKE '%" . $term . "%' OR  concat({$this->db->dbprefix('products')}.name, ' (', {$this->db->dbprefix('products')}.code, ')') LIKE '%" . $term . "%')");
        } else {
            $this->db->where("(products.track_quantity = 0 OR warehouses_products.quantity > 0) AND warehouses_products.warehouse_id = '" . $warehouse_id . "' AND "
                . "({$this->db->dbprefix('products')}.name LIKE '%" . $term . "%' OR {$this->db->dbprefix('products')}.code LIKE '%" . $term . "%' OR  concat({$this->db->dbprefix('products')}.name, ' (', {$this->db->dbprefix('products')}.code, ')') LIKE '%" . $term . "%')");
        }
         * $this->db->limit($limit);
         * 
         */
        
        $q = $this->db->get('risk_modulo_1');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

     public function getModulo2($limit)
    {
        $this->db->select('*');
        if($limit){
        $this->db->limit($limit);
        }
        
        $q = $this->db->get('risk_modulo_2');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    
    public function getModulo3($limit)
    {
        $this->db->select('*');
        if($limit){
        $this->db->limit($limit);
        }
        $q = $this->db->get('risk_modulo_3');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getModulo4($limit)
    {
        $this->db->select('*');
        if($limit){
        $this->db->limit($limit);
        }
        $q = $this->db->get('risk_modulo_4_6');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getRegrasModulo($modulo)
    {
        $this->db->select('risk_modulos_sessao.id as id_regra, risk_modulos.modulo as id_mod, risk_modulos.descricao_resumida as modulo, risk_modulos_sessao.sessao as sessao, risk_modulos_sessao.descricao as regra, risk_modulos_sessao.observacao as observacao ')
        ->join('risk_modulos', 'risk_modulos.id=risk_modulos_sessao.modulo', 'left');
        if($modulo){
            $q = $this->db->get_where('risk_modulos_sessao', array('modulo' => $modulo, 'status' => 1));
        }else{
            $q = $this->db->get_where('risk_modulos_sessao', array('status' => 1));
        }
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
       public function getRegrasById($id)
    {
        
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('risk_modulos_sessao', array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
         public function getRegrasBySessao($id)
    {
        
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('risk_modulos_sessao', array('sessao' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
       public function getDadosClienteById($tabela,$id)
    {
        
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where($tabela, array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
    public function addNovaRegra($data = array())
    {
       
        if ($this->db->insert('risk_modulos_sessao', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    public function updateRegra($id, $data  = array())
    {  
       
        if ($this->db->update('risk_modulos_sessao', $data, array('id' => $id))) {
             
         return true;
        }
        return false;
    }
    
      public function getOpcoesValores()
    {
        $this->db->select('*')
        ->order_by('posicao', 'asc');
        $q = $this->db->get('risk_opcoes_valor');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getCondicaoRegraByRegra($id)
    {
        $this->db->select('*');
        //->order_by('id', 'desc');
        $q = $this->db->get_where('risk_regras_condicoes', array('id_regra' => $id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getCondicaoRegra()
    {
        $this->db->select('*');
        //->order_by('id', 'desc');
        $q = $this->db->get('risk_regras_condicoes');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
       public function getOpcoesValorById($id)
    {
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('risk_opcoes_valor', array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
    public function addCondicaoRegra($data = array())
    {
       
        if ($this->db->insert('risk_regras_condicoes', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    public function addOpcaoValorRegra($data = array())
    {
       
        if ($this->db->insert('risk_opcoes_valor', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    public function getContOpcoesValoresRegra()
    {
       
         $this->db->select('count(id) as quantidade');
        $q = $this->db->get('risk_opcoes_valor', 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
     }
     
     public function deleteOpcaoValor($id)
    {  
       
        if($id){
           $this->db->delete('risk_opcoes_valor', array('id' => $id));

          return true;
        }
        return false;
    }
    
    public function deleteCondicaoRegra($id)
    {  
       
        if($id){
           $this->db->delete('risk_regras_condicoes', array('id' => $id));

          return true;
        }
        return false;
    }
    
     public function getClientes($limit)
    {
        $this->db->select('*');
        if($limit){
        $this->db->limit($limit);
        }
        $q = $this->db->get_where('companies', array('group_id' => 3, 'audcon' => 1));//
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
     public function getClientesAtivos()
    {
     
        $q = $this->db->get_where('companies', array('group_id' => 3, 'audcon' => 1, 'status' => 1));//
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    
     public function addUserSistema($data)
    {
        
        if ($this->db->insert('user_sistema', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
       public function getClienteById($id)
    {
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('companies', array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
     public function updateCliente($id, $data  = array(), $data_user  = array())
    {  
       
        if ($this->db->update('companies', $data, array('id' => $id))) {
            
          $this->db->update('users', $data_user, array('company_id' => $id));
            
         return true;
        }
        return false;
    }
    
    public function getAnalises()
    {
        $this->db->select('*')
        ->order_by('id', 'desc');
        $q = $this->db->get('risk_analises');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
       public function getAnaliseById($id)
    {
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('risk_analises', array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
    public function addAnalise($data = array())
    {
       
        if ($this->db->insert('risk_analises', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    public function addLogInconsistencia($data = array())
    {
       
        if ($this->db->insert('risk_log_inconsistencia', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    
      public function addProcessamentoAnalise($data = array())
    {
       
        if ($this->db->insert('risk_processo_analise', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
     public function updateProcessamentoAnalise($id, $data  = array())
    {  
       
        if ($this->db->update('risk_processo_analise', $data, array('id' => $id))) {
             
         return true;
        }
        return false;
    }
    
     public function updateAnalise($id, $data  = array(), $data_regras  = array())
    {  
       
        if ($this->db->update('risk_analises', $data, array('id' => $id))) {
          
            $this->db->delete('risk_analise_regras', array('id_analise' => $id));
            
              foreach ($data_regras as $item) {
                        $data_regra_analise = array('id_analise' => $id,
                            'id_regra' => $item);      
                        
                        $this->db->insert('risk_analise_regras', $data_regra_analise);
                 }
            
         return true;
        }
        return false;
    }
    
    
       public function getAnaliseRegraByAnalise($id)
    {
        // $this->db->select('count(id) as quantidade');
        $q = $this->db->get_where('risk_analise_regras', array('id_analise' => $id));
     
         if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
         
    }
    
     public function getProcessosAnalisesById($id)
    {
         $q = $this->db->get_where('risk_processo_analise', array('id' => $id));
         if ($q->num_rows() > 0) {
            return $q->row();
        }
    }
    
     public function getProcessosAnalises($analise)
    {
        $this->db->select('*')
        ->order_by('dt_processo', 'desc');
         $q = $this->db->get_where('risk_processo_analise', array('analise' => $analise));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
     public function getRegrasProcessosAnalises($analise)
    {
        $this->db->select('distinct(id_regra) as regras');
        //->order_by('dt_processo', 'desc');
         $q = $this->db->get_where('risk_log_inconsistencia', array('processo_analise' => $analise));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
     public function getInconsistenciasProcessosAnalises($analise)
    {
        //$this->db->select('distinct(id_regra) as regras');
        //->order_by('dt_processo', 'desc');
         $q = $this->db->get_where('risk_log_inconsistencia', array('processo_analise' => $analise));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
     public function getQuantidadeDistintasGuiasAnalises($tabela)
    {
        $this->db->select('count(distinct(guia)) as guia');
        //->order_by('dt_processo', 'desc');
        $q = $this->db->get($tabela);
        if ($q->num_rows() > 0) {
           return $q->row();
        }
    }
    
    
    public function getTabelaClienteByRegra($tabela)
    {
         $this->db->select('id, guia, carater_atendimento,cirurgico, codigo_servico, quantidade, valor_procedimento,competencia');
        $q = $this->db->get($tabela);
     
         if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
         
    }
    
    /*
     * RETORNA O NÚMERO DE REGISTRO DA TABELA DO CLIENTE
     */
    
     public function getMaxRegistrosCliente($tabela)
    {
       
         $this->db->select('count(id) as quantidade');
        $q = $this->db->get($tabela, 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
     }
     
     /*
     * RETORNA O NÚMERO DE INCONSISTENCIAS ENCONTRADA EM UM PROCESSAMENTO
     */
    
     public function getInconsistenciasProcessoAnalise($id)
    {
       
         $this->db->select('count(id) as quantidade');
       $q = $this->db->get_where('risk_log_inconsistencia', array('processo_analise' => $id));
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
     }
     
     
    
     
     
     /*
     * RETORNA O NÚMERO DE REGISTRO DA TABELA DO CLIENTE
     */
    
     public function getRegitroTabelaTuss($id)
    {
       
        // $this->db->select('count(id) as quantidade');
         $q = $this->db->get_where('risk_modulo_4_6', array('id_termo' => $id));
     
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
     }
    
    
       public function getProcessamentoRegraByAnalise($id)
    {
         $this->db->select('risk_analise_regras.id_analise as id_analise, risk_modulos_sessao.id as id, risk_modulos_sessao.sessao as regra, descricao')
         ->join('risk_modulos_sessao', 'risk_modulos_sessao.id=risk_analise_regras.id_regra', 'left');
        $q = $this->db->get_where('risk_analise_regras', array('id_analise' => $id));
     
         if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
         
    }
    
     public function getContEstrutura()
    {
       
         $this->db->select('count(id) as quantidade');
        $q = $this->db->get('risk_estrutura_regras_cliente', 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
     }
    
      public function getEstrutura()
    {
        $this->db->select('*')
        ->order_by('posicao', 'asc');
        $q = $this->db->get('risk_estrutura_regras_cliente');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function addEstrutura_cliente($data = array())
    {
       
        if ($this->db->insert('risk_estrutura_regras_cliente', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    public function deleteEstrutura($id)
    {  
       
        if($id){
           $this->db->delete('risk_estrutura_regras_cliente', array('id' => $id));

          return true;
        }
        return false;
    }

}
