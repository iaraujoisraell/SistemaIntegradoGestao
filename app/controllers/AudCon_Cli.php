<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AudCon_cli extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            redirect('login');
        }
        
        $this->load->model('db_model');
        $this->lang->load('auth', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('auth_model');
        $this->load->library('ion_auth');
        $this->load->model('AudCon_model');
        $this->load->model('companies_model');
        $this->load->model('site');
        $this->digital_upload_path = 'assets/uploads/atas';
        $this->upload_path = 'assets/uploads/atas';
        $this->thumbs_path = 'assets/uploads/thumbs/atas';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
    }

    public function index()
    {
        
        //$this->sma->checkPermissions();
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
         
        $pagina = 'audcon/paginas_cliente/analises';
        
       $this->page_construct_cliente($pagina, $meta, $this->data);
    }
   
 
        function encrypt($str, $key)
        {
           
            for ($return = $str, $x = 0, $y = 0; $x < strlen($return); $x++)
            {
                $return{$x} = chr(ord($return{$x}) ^ ord($key{$y}));
                $y = ($y >= (strlen($key) - 1)) ? 0 : ++$y;
            }

            return $return;
        }

        public function banco_regras($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
      //      redirect('sync');
        }
        // $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
        
            
         $this->data['ativo'] = 'modulo4';
         $this->data['layout'] ='sidebar-collapse';
         $this->data['menu'] = 'parametrizacao';
         if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/parametros/modulo4';
         $this->page_construct_cliente($pagina, $meta, $this->data);
    }
        
    public function processamentos($id) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         //$this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
         $id_descriptografado =  $this->encrypt($id,'ISRAEL');
         
         $this->data['ativo'] = 'analise';
         $this->data['layout'] ='';
         $this->data['menu'] = 'analise';
       $this->data['id'] = $id_descriptografado;
       
         $pagina = 'audcon/paginas/processamentos';
         $this->page_construct_cliente($pagina, $meta, $this->data);
    }
    
    
        public function dashboardResultado($id) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         //$this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
         $id_descriptografado =  $this->encrypt($id,'ISRAEL');
         
         $this->data['ativo'] = 'analise';
         $this->data['layout'] ='';
         $this->data['menu'] = 'analise';
         $this->data['id'] = $id_descriptografado;
       
         $pagina = 'audcon/paginas_cliente/dashboard_resultados';
         $this->page_construct_cliente($pagina, $meta, $this->data);
    }
    
    public function dashboard_resultado($id) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
         $this->data['ativo'] = 'analise';
         $this->data['layout'] ='';
         $this->data['menu'] = 'analise';
         $this->data['id'] = $id;
       
         $pagina = 'audcon/paginas/dashboard_resultados';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    public function resultado_processamentos($id) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
        // $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
         $this->data['ativo'] = 'analise';
         $this->data['layout'] ='';
         $this->data['menu'] = 'analise';
         $this->data['id'] = $id;
       
         $pagina = 'audcon/paginas_cliente/resultado_analises';
         $this->page_construct_cliente($pagina, $meta, $this->data);
    }
    
   
    
}
