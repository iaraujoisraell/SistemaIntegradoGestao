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
    
    public function processamentos() {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
         $this->data['ativo'] = 'cliente';
         $this->data['layout'] ='';
         $this->data['menu'] = 'cadastros';
       
         $pagina = 'audcon/paginas/processamentos';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
     
     function add_analise()
    {
        $this->sma->checkPermissions(false, true);

        //$this->form_validation->set_rules('email', lang("email_address"), 'is_unique[companies.email]');
         $this->form_validation->set_rules('cliente', lang("Cliente"), 'required');
         $this->form_validation->set_rules('periodo_de', lang("Período de"), 'required');
         $this->form_validation->set_rules('periodo_ate', lang("Período até"), 'required');
         
        if ($this->form_validation->run('companies/add') == true) {
           
           /*
            * CADASTRA O CLIENTE
            */
         
            $data = array(
                'cliente' => $this->input->post('cliente'),
                'dt_solicitacao' => date('Y-m-d'),
                'carga' => $this->input->post('carga'),
                'periodo_de' => $this->input->post('periodo_de'),
                'periodo_ate' => $this->input->post('periodo_ate'),
                'status' => 0
                
              
            );
           
           
            $this->AudCon_model->addAnalise($data);
            $this->session->set_flashdata('message', lang("Análise cadastrada com sucesso!"));
            
            redirect('AudCon');
          
        }else  {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon');
        }

     
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
         $pagina = 'audcon/paginas/cadastro/regras/regras';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    function add_condicao()
    {
        $this->sma->checkPermissions(false, true);

        $id = $this->input->post('id_regra');
        $this->form_validation->set_rules('cliente', lang("Valor Cliente"), 'required');
        $this->form_validation->set_rules('valor2', lang("E-Valor Base"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           
             $data = array(
                'valor_cliente' => $this->input->post('cliente'),
                'condicao' => $this->input->post('condicao'),
                'valor_base' => $this->input->post('valor2'),
                'resultado' => $this->input->post('resultado'),
                'id_regra' => $this->input->post('id_regra')
            );
            
             $this->AudCon_model->addCondicaoRegra($data);
           //
            
          
            
            redirect('AudCon/editar_regra/'.$id);
          
        } elseif ($this->input->post('add_customer')) {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/editar_regra/'.$id);
        }

     
    }
    
    function add_valor_condicao_Cadastro()
    {
        $this->sma->checkPermissions(false, true);

        $this->form_validation->set_rules('valor', lang("Valor"), 'required');
        $this->form_validation->set_rules('descricao', lang("Descrição"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           
            $analises_total = $this->AudCon_model->getContOpcoesValoresRegra();
            $posicao = $analises_total->quantidade;
           
            $data = array(
                'valor' => $this->input->post('valor'),
                'descricao' => $this->input->post('descricao'),
                'posicao' => $posicao
            );
             $this->AudCon_model->addOpcaoValorRegra($data);
            
            redirect('AudCon/valoresRegras/');
          
        } elseif ($this->input->post('add_customer')) {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/valoresRegras/');
        }

     
    }
    
    function add_valor_condicao()
    {
        $this->sma->checkPermissions(false, true);

        $id = $this->input->post('id_regra');
        
        $this->form_validation->set_rules('valor', lang("Valor"), 'required');
        $this->form_validation->set_rules('descricao', lang("Descrição"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           $analises_total = $this->AudCon_model->getContOpcoesValoresRegra();
            $posicao = $analises_total->quantidade;
            $data = array(
                'valor' => $this->input->post('valor'),
                'descricao' => $this->input->post('descricao'),
                'posicao' => $posicao
            );
             $this->AudCon_model->addOpcaoValorRegra($data);
            
            redirect('AudCon/editar_regra/'.$id);
          
        } elseif ($this->input->post('add_customer')) {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/editar_regra/'.$id);
        }

     
    }
    
    public function add_nova_regra() {
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
        
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        //$this->form_validation->set_rules('email', lang("email_address"), 'is_unique[companies.email]');
         $this->form_validation->set_rules('numero', lang("Empresa"), 'required');
         $this->form_validation->set_rules('descricao', lang("E-mail"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           
             $data = array(
                'sessao' => $this->input->post('numero'),
                'descricao' => $this->input->post('descricao'),
                'observacao' => $this->input->post('observacao'),
                'estrutura_cliente' => $this->input->post('cliente')
            );
            //print_r($data);exit;
            $this->AudCon_model->addNovaRegra($data);
            
            $this->session->set_flashdata('message', lang("Cadastro efetuado com sucesso!"));
            redirect('AudCon/regras');
             
          } else{
           
            $this->session->set_flashdata('error', validation_errors());
            
            $this->data['ativo'] = 'regras';
            $this->data['layout'] ='';
            $this->data['menu'] = 'regras';
            $this->data['id'] = $id;
       
         $pagina = 'audcon/paginas/cadastro/regras/editar_regra';
         $this->page_construct_novo($pagina, $meta, $this->data);
        }
         
         
        
    }
    
    public function editar_regra($id) {
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
        
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        //$this->form_validation->set_rules('email', lang("email_address"), 'is_unique[companies.email]');
         $this->form_validation->set_rules('numero', lang("Empresa"), 'required');
         $this->form_validation->set_rules('descricao', lang("E-mail"), 'required');
         
         
        if ($this->form_validation->run('companies/add') == true) {
           
             $data = array(
                'sessao' => $this->input->post('numero'),
                'descricao' => $this->input->post('descricao'),
                'observacao' => $this->input->post('observacao'),
                'estrutura_cliente' => $this->input->post('cliente')
            );
             $id = $this->input->post('id');
            
             $this->AudCon_model->updateRegra($id, $data);
            
             
             $this->session->set_flashdata('message', lang("Cadastro Atualizado com Sucesso! "));
            
            $this->data['ativo'] = 'regras';
            $this->data['layout'] ='';
            $this->data['menu'] = 'regras';
            $this->data['id'] = $id;
       
         $pagina = 'audcon/paginas/cadastro/regras/editar_regra';
         $this->page_construct_novo($pagina, $meta, $this->data);
             
          } else{
           
            $this->session->set_flashdata('error', validation_errors());
            
            $this->data['ativo'] = 'regras';
            $this->data['layout'] ='';
            $this->data['menu'] = 'regras';
            $this->data['id'] = $id;
       
         $pagina = 'audcon/paginas/cadastro/regras/editar_regra';
         $this->page_construct_novo($pagina, $meta, $this->data);
        }
         
         
        
    }
    
    function inativa_regra($id = NULL)
    {
         $data = array(
                
                'status' => 0
              
            );
            
            $id_cliente = $id;
           //print_r($data);exit;
            $cid = $this->AudCon_model->updateRegra($id_cliente, $data);
            $this->session->set_flashdata('message', lang("Cadastro Inativado com Sucesso! "));
            
            redirect('AudCon/regras');
           
         
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
         $pagina = 'audcon/paginas/cadastro/cliente/cliente';
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
                'postal_code' => $this->input->post('postal_code'),
                'audcon' => 1,
                'status' => 1
              
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
         $this->form_validation->set_rules('email', lang("name"), 'required');
        

       // $company_details = $this->companies_model->getCompanyByID($id);
       // if ($this->input->post('email') != $company_details->email) {
        //    $this->form_validation->set_rules('code', lang("email_address"), 'is_unique[companies.email]');
       // }

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
                'postal_code' => $this->input->post('postal_code')
              
            );
            
            $additional_user = array(
                'first_name' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('email')
            );
            
            $id = $this->input->post('id');
           
            $cid = $this->AudCon_model->updateCliente($id, $data, $additional_user);
            
            $this->session->set_flashdata('message', lang("Cadastro Alterado com Sucesso! "));
            
            redirect('AudCon/clientes');
           
        } else {
            
        
            $this->data['ativo'] = 'cliente';
            $this->data['layout'] = '';
            $this->data['menu'] = 'cadastros';
            if ($limite) {
                $this->data['limite'] = '';
            } else {
                $this->data['limite'] = '100';
            }
            $this->data['id'] = $id;

            $pagina = 'audcon/paginas/cadastro/cliente/edit_cliente';
         $this->page_construct_novo($pagina, $meta, $this->data);
        }
    }
    
    function inativa_cliente($id = NULL)
    {
       
            /*
            * CADASTRA O CLIENTE
            */
         
            $data = array(
                
                'status' => 0
              
            );
            
            $additional_user = array(
                'active' => 0
            );
            
            $id_cliente = $id;
           
            $cid = $this->AudCon_model->updateCliente($id_cliente, $data, $additional_user);
            
            $this->session->set_flashdata('message', lang("Cadastro Inativado com Sucesso! "));
            
            redirect('AudCon/clientes');
           
         
    }
    
    function ativa_cliente($id = NULL)
    {
       
            /*
            * CADASTRA O CLIENTE
            */
         
            $data = array(
                
                'status' => 1
              
            );
            
            $additional_user = array(
                'active' => 1
            );
            
            $id_cliente = $id;
           
            $cid = $this->AudCon_model->updateCliente($id_cliente, $data, $additional_user);
            
            $this->session->set_flashdata('message', lang("Cadastro Ativado com Sucesso! "));
            
            redirect('AudCon/clientes');
           
         
    }
  
    public function estrutura_cliente($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'estrutura';
         $this->data['layout'] ='';
         $this->data['menu'] = 'cadastros';
        if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/cadastro/estrutura_cliente/estrutura';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    public  function add_estrutura_cliente()
    {
        $this->sma->checkPermissions(false, true);

        //$this->form_validation->set_rules('email', lang("email_address"), 'is_unique[companies.email]');
         $this->form_validation->set_rules('campo', lang("Nome Campo"), 'required');
         $this->form_validation->set_rules('valores', lang("Valores"), 'required');
         
         
        if ($this->form_validation->run('estrutura/add') == true) {
           
           $analises_total = $this->AudCon_model->getContEstrutura();
            $posicao = $analises_total->quantidade;
            
             $data = array(
                'nome' => $this->input->post('campo'),
                'valores' => $this->input->post('valores'),
                 'posicao' => $posicao
                );
     
            $cid = $this->AudCon_model->addEstrutura_cliente($data);
            $this->session->set_flashdata('message', lang("Cadastrado com Sucesso"));
            
            redirect('AudCon/estrutura_cliente');
          
        } else {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/estrutura_cliente');
        }

     
    }

    public function delete_estrutura($id = NULL)
    {    
            $id_cliente = $id;
           
            $cid = $this->AudCon_model->deleteEstrutura($id);
            
            $this->session->set_flashdata('message', lang("Cadastro Deletado com Sucesso! "));
            
            redirect('AudCon/estrutura_cliente');
           
         
    }
    
    
    public function delete_condicao($id, $regra)
    {    
        
            $this->AudCon_model->deleteCondicaoRegra($id);
            
            $this->session->set_flashdata('message', lang("Cadastro Deletado com Sucesso! "));
            redirect('AudCon/editar_regra/'.$regra);
           
         
    }
    
    public function valoresRegras($limite) {
       
        
        if ($this->Settings->version == '2.3') {
            $this->session->set_flashdata('warning', 'Please complete your update by synchronizing your database.');
            redirect('sync');
        }
         $this->sma->checkPermissions();
         $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
            
         $this->data['ativo'] = 'valores';
         $this->data['layout'] ='';
         $this->data['menu'] = 'cadastros';
        if($limite){
             $this->data['limite'] = '';
         }else{
            $this->data['limite'] = '100';
         }
         $pagina = 'audcon/paginas/cadastro/opcaoValor/valores';
         $this->page_construct_novo($pagina, $meta, $this->data);
    }
    
    public function delete_valores_regra($id = NULL)
    {    
            $id_cliente = $id;
           
            $cid = $this->AudCon_model->deleteOpcaoValor($id);
            
            $this->session->set_flashdata('message', lang("Cadastro Deletado com Sucesso! "));
            
            redirect('AudCon/valoresRegras');
           
         
    }
    
}
