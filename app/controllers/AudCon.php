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
    
     public function clientes($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'cliente';
         $this->data['layout'] ='';
         $this->data['menu'] = 'cadastros';
        if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/cadastro/cliente';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
     function add_cliente()
    {
        $this->sma->checkPermissions(false, true);

        //$this->form_validation->set_rules('email', lang("email_address"), 'is_unique[companies.email]');
         $this->form_validation->set_rules('company', lang("Empresa"), 'required');
         $this->form_validation->set_rules('email', lang("E-mail"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           
           /*
            * CADASTRA O CLIENTE
            */
         
            $data = array(
                'company' => $this->input->post('company'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'group_id' => '3',
                'group_name' => 'customer',
                'vat_no' => $this->input->post('vat_no'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'phone' => $this->input->post('phone'),
                'audcon' => 1
              
            );
           $cid = $this->companies_model->addCompany($data);
            
            
           
           /*
             * CADASTRA O USUÁRIO DO CLIENTE
             */
            $active = 1;
            $notify = 0;
           
            $email = strtolower($this->input->post('email'));
            $password = 'Acesso*2018';
            $additional_data = array(
                'first_name' => $this->input->post('company'),
                //'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                //'gender' => $this->input->post('gender'),
                'company_id' => $cid,
               // 'company' => $company->company,
                'group_id' => 5
            );
            $this->load->library('ion_auth');
            $id_user =  $this->ion_auth->register($email, $password, $email, $additional_data, $active, $notify);
          
            /*
             * ADICIONA O USUÁRIO AO SISTEMA QUE ELE TERÁ ACESSO
             */
            $data_user_sis = array(
                'usuario' => $id_user,
                'sistema' => 3
            );
            $this->AudCon_model->addUserSistema($data_user_sis);
           
            $this->session->set_flashdata('message', lang("customer_added"));
            $ref = isset($_SERVER["HTTP_REFERER"]) ? explode('?', $_SERVER["HTTP_REFERER"]) : NULL;
            redirect('AudCon/clientes');
          
        } elseif ($this->input->post('add_customer')) {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/clientes');
        }

     
    }

    function edit_cliente($id = NULL)
    {
        $this->sma->checkPermissions(false, true);
        $this->form_validation->set_rules('company', lang("company"), 'required');
         $this->form_validation->set_rules('name', lang("name"), 'required');
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $company_details = $this->companies_model->getCompanyByID($id);
        if ($this->input->post('email') != $company_details->email) {
            $this->form_validation->set_rules('code', lang("email_address"), 'is_unique[companies.email]');
        }

        if ($this->form_validation->run('companies/add') == true) {
            $cg = $this->site->getCustomerGroupByID($this->input->post('customer_group'));
               $ie = $this->input->post('cf1');
            
            if($ie){
                $indicacaoCliente = '1';
            }else{
                $indicacaoCliente = '9';
            }
            $data = array('name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'group_id' => '3',
                'group_name' => 'customer',
                'customer_group_id' => $this->input->post('customer_group'),
                'customer_group_name' => $cg->name,
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'vat_no' => $this->input->post('vat_no'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'postal_code' => $this->input->post('postal_code'),
                'country' => $this->input->post('country'),
                'phone' => $this->input->post('phone'),
                'cf1' => $this->input->post('cf1'),
                'cf2' => $this->input->post('cf2'),
                'cf3' => $this->input->post('cf3'),
                'cf4' => $this->input->post('cf4'),
                'cf5' => $this->input->post('cf5'),
                'cf6' => $this->input->post('cf6'),
                'award_points' => $this->input->post('award_points'),
                'indicacaoCliente' => $indicacaoCliente,
                'codigoMunicipio' => '1302603',
            );
        } elseif ($this->input->post('edit_customer')) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
        }

        if ($this->form_validation->run() == true && $this->companies_model->updateCompany($id, $data)) {
            $this->session->set_flashdata('message', lang("customer_updated"));
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->data['customer'] = $company_details;
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['customer_groups'] = $this->companies_model->getAllCustomerGroups();
            $this->load->view($this->theme . 'sig/customers/edit', $this->data);
        }
    }
    
    
  
}
