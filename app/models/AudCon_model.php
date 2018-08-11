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
        $this->db->select('risk_modulos.modulo as id_mod, risk_modulos.descricao_resumida as modulo, risk_modulos_sessao.sessao as sessao, risk_modulos_sessao.descricao as regra, risk_modulos_sessao.observacao as observacao ')
        ->join('risk_modulos', 'risk_modulos.id=risk_modulos_sessao.modulo', 'left');
        if($modulo){
            $q = $this->db->get_where('risk_modulos_sessao', array('modulo' => $modulo));
        }else{
            $q = $this->db->get('risk_modulos_sessao');
        }
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
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
    
    public function addAnalise($data = array())
    {
       
        if ($this->db->insert('risk_analises', $data)) {
            $cid = $this->db->insert_id();
            return $cid;
        }

        return false;
    }
    
    /*
     *  public function getCustomerSales($id)
    {
        $this->db->where('customer_id', $id)->from('sales');
        return $this->db->count_all_results();
    }
     */

}
