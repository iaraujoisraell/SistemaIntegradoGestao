<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    /**************************************************/
    
     public function getAllEventosStatusReport($projeto,$data_fim) {
        
        $q = $this->db->get_where('eventos', array('projeto' => $projeto, 'data_inicio <' => $data_fim));  
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    
      /*******************EVENTOS SALVA NO STATUS REPORT*******************************/
    
     public function getAllEventoStatusReportByStatusReport($status_report) {
        //  echo $status_report; exit;
          $this->db->select("status_report_eventos.id as id_sr,  eventos.nome_evento as nome_evento, eventos.data_inicio as data_inicio, eventos.data_fim as data_fim, status_report_eventos.status as status")
            
          //  ->join('planos', 'status_report_acoes.acao = planos.idplanos', 'left')   
            ->join('eventos', 'status_report_eventos.evento = eventos.id', 'left');
        $q = $this->db->get_where('status_report_eventos', array('status_report' => $status_report));  
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    
    /*******************AÇÕES CONCLUÍDAS SALVA NO STATUS REPORT*******************************/
    
     public function getAllAcoesByEventoStatusReport($evento) {
         
          $this->db->select("planos.descricao as descricao, planos.data_termino as data_termino, planos.data_retorno_usuario as data_retorno_usuario, status_report_acoes.status as status, users.first_name as first_name, users.last_name as last_name") // 
            
           ->join('planos', 'status_report_acoes.acao = planos.idplanos', 'left')
            ->join('users', 'planos.responsavel = users.id', 'left');
        $q = $this->db->get_where('status_report_acoes', array('evento' => $evento,  'status_report_acoes.status' => '1'));  
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
     /*******************AÇÕES PENDENTES SALVA NO STATUS REPORT*******************************/
    
     public function getAllAcoesPendentesByEventoStatusReport($evento) {
         
          $this->db->select("planos.descricao as descricao, planos.data_termino as data_termino, planos.data_retorno_usuario as data_retorno_usuario, status_report_acoes.status as status, users.first_name as first_name, users.last_name as last_name") // 
            
           ->join('planos', 'status_report_acoes.acao = planos.idplanos', 'left')
            ->join('users', 'planos.responsavel = users.id', 'left');
        $q = $this->db->get_where('status_report_acoes', array('evento' => $evento,  'status_report_acoes.status' => '0'));  
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
     /**************************************************/
    
       public function getAllProjetos() {
        $q = $this->db->get('projetos');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    /********************************************************/
      public function getAllProjetosComGestores() {
          $this->db->select("projetos.id as id")
           ->join('users_gestor', 'projetos.id = users_gestor.projeto', 'inner')
         ->group_by('id');        
        $q = $this->db->get('projetos');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    /***************************************************/
    
         public function addStatusReport($data)
    {
           // echo 'aqui'; exit;
            
            if ($this->db->insert('status_report', $data)) {
                $id_status = $this->db->insert_id();
               return $id_status;
        }
          
        return false;
    }

   
    /**************************************************/
    
    /*
     * PEGA UM STATUS REPORT PELO ID
     */
     public function getStatusReportByID($id)
    {
         
        $q = $this->db->get_where('status_report', array('id' => $id), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
    /**************************************************/
    
    /*
     * VERIFICA SE TEM AÇÃO PENDENTE PARA UM DETERMINADO EVENTO
     */
     public function getAcaoPendenteByEventoID($id)
    {
          $this->db->select("count(idplanos) as quantidade");
        $q = $this->db->get_where('planos', array('eventos' => $id, 'status' => 'PENDENTE'), 1);
     
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
         
    }
    
    /***************************************************/
    //SALVA OS EVENTOS RELACIONADO COM O STATUS REPORT
         public function addEventoStatusReport($data)
    {
           // echo 'aqui'; exit;
            
            if ($this->db->insert('status_report_eventos', $data)) {
                $id_evento = $this->db->insert_id();
               return $id_evento;
               //return true;
        }
          
        return false;
    }
    
    /***************************************************/
    //SALVA AS AÇÕES DO STATUS REPORT
         public function addAcoesStatusReport($data)
    {
           // echo 'aqui'; exit;
            
            if ($this->db->insert('status_report_acoes', $data)) {
                
               return true;
        }
          
        return false;
    }
    
    
     /**************************************************/
    
     public function getAllAcoesByEvento($evento,$data_fim) {
          
          $this->db->select("*")
            ->join('users', 'planos.responsavel = users.id', 'left');
        
        $q = $this->db->get_where('planos', array('eventos' => $evento, 'data_termino  <' => $data_fim, 'status' => 'CONCLUÍDO'));  
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    /**************************************************/
    
     public function getAllAcoesPendenteByEvento($evento,$data_fim) {
         
          $this->db->select("*")
            ->join('users', 'planos.responsavel = users.id', 'left');
        
        $q = $this->db->get_where('planos', array('eventos' => $evento, 'data_termino  <' => $data_fim, 'status !=' => 'CONCLUÍDO'));  
      
       
       
       
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
     /**************************************************/
    
    public function getAllStatusReportByProjeto($projeto) {
         
        
          $this->db->select("status_report.id as id, status_report.periodo_de as periodo_de, status_report.periodo_ate as periodo_ate, status_report.prazo,status_report.custo as custo, status_report.escopo as escopo, status_report.comunicacao as comunicacao, projetos.projeto as projeto")
            ->join('projetos', 'status_report.projeto = projetos.id', 'left')
          ->order_by('status_report.id', 'desc');
        $q = $this->db->get_where('status_report', array('status_report.projeto' => $projeto));  
   
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    
         /**************************************************/
    
    public function getAllStatusReportByDataRegistro($data_registro) {
         
        
          $this->db->select("status_report.id as id, status_report.periodo_de as periodo_de, status_report.periodo_ate as periodo_ate, status_report.prazo,status_report.custo as custo, status_report.escopo as escopo, status_report.comunicacao as comunicacao, projetos.projeto as projeto")
            ->join('projetos', 'status_report.projeto = projetos.id', 'left')
          ->order_by('status_report.id', 'desc');
        $q = $this->db->get_where('status_report', array('status_report.data_registro' => $data_registro));  
   
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
         /**************************************************/
    
    public function getAllStatusReportByDataProjeto($projeto,$data_registro) {
         
        
          $this->db->select("count(id) as quantidade");
         //   ->join('projetos', 'status_report.projeto = projetos.id', 'left');
         
        $q = $this->db->get_where('status_report', array('status_report.projeto' => $projeto, 'status_report.data_registro' => $data_registro));  
   
       if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    // public function getmonthlyPurchases()
    // {
    //     $myQuery = "SELECT (CASE WHEN date_format( date, '%b' ) Is Null THEN 0 ELSE date_format( date, '%b' ) END) as month, SUM( COALESCE( total, 0 ) ) AS purchases FROM purchases WHERE date >= date_sub( now( ) , INTERVAL 12 MONTH ) GROUP BY date_format( date, '%b' ) ORDER BY date_format( date, '%m' ) ASC";
    //     $q = $this->db->query($myQuery);
    //     if ($q->num_rows() > 0) {
    //         foreach (($q->result()) as $row) {
    //             $data[] = $row;
    //         }
    //         return $data;
    //     }
    //     return FALSE;
    // }

    

    

   

    public function getExpenses($date, $warehouse_id = NULL, $year = NULL, $month = NULL)
    {
        $sdate = $date.' 00:00:00';
        $edate = $date.' 23:59:59';
        $this->db->select('SUM( COALESCE( amount, 0 ) ) AS total', FALSE);
        if ($date) {
            $this->db->where('date >=', $sdate)->where('date <=', $edate);
        } elseif ($month) {
            $this->load->helper('date');
            $last_day = days_in_month($month, $year);
            $this->db->where('date >=', $year.'-'.$month.'-01 00:00:00');
            $this->db->where('date <=', $year.'-'.$month.'-'.$last_day.' 23:59:59');
        }
        

        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }

        $q = $this->db->get('expenses');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

  /*
   * MODELO DE QUERY
   */
    public function getDailyPurchases($year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db->dbprefix('purchases') . " WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = {$warehouse_id} AND ";
        }
        $myQuery .= " DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
            GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery, false);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    
    /*
     * LISTA DE GESTORES POR PROJETO
     */
    public function getListGestoresProjetos($projeto)
    {
           $this->db->select("users_gestor.users as user_id")
           // ->join('users', 'users_gestor.users = users.id', 'left')
           // ->join('setores', 'users_gestor.setor = setores.id', 'left')
           // ->join('perfil_usuario', 'users_gestor.users = perfil_usuario.user_id ', 'left')     
            ->group_by('user_id');
         $q = $this->db->get_where('users_gestor', array('users_gestor.projeto' => $projeto));
       
       if ($q->num_rows() > 0) {
             foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
         
    }

      public function getProjetoByID($id)
    {
        $q = $this->db->get_where('projetos', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

}
