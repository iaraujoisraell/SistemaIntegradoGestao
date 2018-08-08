<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AudCon extends MY_Controller
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
        $this->load->model('projetos_model');
        $this->load->model('site');
        $this->digital_upload_path = 'assets/uploads/atas';
        $this->upload_path = 'assets/uploads/atas';
        $this->thumbs_path = 'assets/uploads/thumbs/atas';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
    }

    public function index()
    {
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
        $this->sma->checkPermissions();
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
         
        $pagina = 'audcon/paginas/analises';
        
       $this->page_construct_novo($pagina, $meta, $this->data);
        
        
        
    }
    
      public function modulo1($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'modulo1';
         $this->data['layout'] ='sidebar-collapse';
         $this->data['menu'] = 'parametrizacao';
        if($limite){
             $this->data['limite'] = '2000';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/parametros/modulo1';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    public function modulo2($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'modulo2';
         $this->data['layout'] ='sidebar-collapse';
         $this->data['menu'] = 'parametrizacao';
        if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/parametros/modulo2';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    
    public function modulo3($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
        
            
         $this->data['ativo'] = 'modulo3';
         $this->data['layout'] ='sidebar-collapse';
         $this->data['menu'] = 'parametrizacao';
         if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/parametros/modulo3';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
     public function modulo4($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
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
         $this->page_construct_novo($pagina, $meta, $this->data);
    }

     public function regras($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'regras';
         $this->data['layout'] ='sidebar-collapse';
         $this->data['menu'] = 'cadastros';
        if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/cadastro/regras';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    
}
