<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProcessaAnalise extends MY_Controller
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


    
     function add_novo_processamento()
    {
        $this->sma->checkPermissions(false, true);

         $regras = $this->input->post('regras');
         $analise = $this->input->post('id');
         
         
        if ($regras) {
            $analises = $this->AudCon_model->getAnaliseById($analise);
            $tabela_cliente = $analises->tabela;
            
            $qtde_registros = $this->AudCon_model->getMaxRegistrosCliente($tabela_cliente);
            $qtde = $qtde_registros->quantidade;
            
             
             $data_processo = array(
                'dt_processo' => date('Y-m-d H:i:s'),
                'usuario' => $usuario = $this->session->userdata('user_id'),
                'ip' => $_SERVER["REMOTE_ADDR"],
                'num_registros' => $qtde,
                'analise' => $analise
            );
               $id_processo =  $this->AudCon_model->addProcessamentoAnalise($data_processo);
          
               
            foreach ($regras as $item) {
                $regra = $this->AudCon_model->getRegrasById($item);
                $sessao = $regra->sessao;
                
                $this->analisaRegra($sessao, $tabela_cliente, $id_processo);
               
            }
           
            $qtde_inconsistencias = $this->AudCon_model->getInconsistenciasProcessoAnalise($id_processo);
            $qtde_incons = $qtde_inconsistencias->quantidade;
            
            /*
             * REGISTRA O NÚMERO DE INCONSISTÊNCIA
             */
             
            $data_update = array(
                'num_inconsistencias' => $qtde_incons
            );
               $this->AudCon_model->updateProcessamentoAnalise($id_processo, $data_update);
             
            
            $this->session->set_flashdata('message', lang("Processo Realizado com sucesso!"));
             redirect('AudCon/processamentos/'.$analise);
          
        }else  {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/processamentos/'.$analise);
        }

     
    }
    
    
     function analisaRegra($regra, $tabela, $processo)
    {
         /*
          * INÍCIO REGRA 23 - CONSTA NO ROL
          */
        if($regra == 23){
             
             $qtde_registros = $this->AudCon_model->getTabelaClienteByRegra($tabela);
             $cont = 0;
             foreach ($qtde_registros as $regAnalise) {
               $id = $regAnalise->id;
               $guia = $regAnalise->guia;
               $cod_servico = $regAnalise->codigo_servico;  //TUSS
               $qtde = $regAnalise->quantidade;
               $vl_procedimento = $regAnalise->valor_procedimento;
               $competencia = $regAnalise->competencia;
               
              
               $dados_tuss = $this->AudCon_model->getRegitroTabelaTuss($cod_servico);
               $rol = $dados_tuss->rol;
               
               /*
                * verifica se consta no ROL
                */
               if($rol == "SIM"){
                    $cont++;
               }else if($rol == "NÃO"){
                 //CASO NÃO CONSTE, VERIFICA A QUANTIDADE REALIZADA
                   
                   if($qtde > 0){
                       //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $qtde,
                        'valor_regra' => $rol,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                   }
                }
            }        
            /*
          * FIM REGRA 23 - CONSTA NO ROL
          */
        }else
          /*
          * INÍCIO REGRA 34 - TIPO/CARATER PROCEDIMENTO
           * U = URGENTE
           * E = ELETIVO
           * A = AMBOS
           * NC = NÃO COBERTO
          */
         if($regra == 34){
             
             $qtde_registros = $this->AudCon_model->getTabelaClienteByRegra($tabela);
             
             foreach ($qtde_registros as $regAnalise) {
               $id = $regAnalise->id;
               $guia = $regAnalise->guia;
               $tipo_procedimento_cliente = $regAnalise->carater_atendimento;
               $cod_servico = $regAnalise->codigo_servico;  //TUSS
               $qtde = $regAnalise->quantidade;
               $vl_procedimento = $regAnalise->valor_procedimento;
               $competencia = $regAnalise->competencia;
               
              
               $dados_tuss = $this->AudCon_model->getRegitroTabelaTuss($cod_servico);
               $tipo_procedimento = $dados_tuss->tipo_procedimento;
               
               /*
                * verifica o tipo de procedimento
                */
               if($tipo_procedimento == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $tipo_procedimento_cliente,
                        'valor_regra' => $tipo_procedimento,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                   }
                    
               }else if($tipo_procedimento == "A"){
                 //ACEITA TIPO E,U
                   
                   
                }else if($tipo_procedimento == "E"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "E", COMPARA COM A BASE DO CLIENTE SE É 'U OU A'
                   
                    if(($tipo_procedimento_cliente == "U")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                }else if($tipo_procedimento == "U"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "U", COMPARA COM A BASE DO CLIENTE SE É 'E OU A'
                   
                    if(($tipo_procedimento_cliente == "E")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                }
            }        
         /*
          * FIM REGRA 34 - TIPO PROCEDIMENTO
          */
        }else
          /*
          * INÍCIO REGRA 35 - REGIME DE ATENDIMENTO
           * 1 = AMBULATORIAL
           * 2 = INTERNACAO
           * 3 = AMBOS
           * 4 = HOSPITAL DIA
           * NC = NÃO COBERTO
          */
         if($regra == 35){
             /*
             $qtde_registros = $this->AudCon_model->getTabelaClienteByRegra($tabela);
             
             foreach ($qtde_registros as $regAnalise) {
               $id = $regAnalise->id;
               $guia = $regAnalise->guia;
               $tipo_procedimento_cliente = $regAnalise->carater_atendimento;
               $cod_servico = $regAnalise->codigo_servico;  //TUSS
               $qtde = $regAnalise->quantidade;
               $vl_procedimento = $regAnalise->valor_procedimento;
               $competencia = $regAnalise->competencia;
               
              
               $dados_tuss = $this->AudCon_model->getRegitroTabelaTuss($cod_servico);
               $tipo_procedimento = $dados_tuss->tipo_procedimento;
               
               /*
                * verifica o tipo de procedimento
                
               if($tipo_procedimento == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $tipo_procedimento_cliente,
                        'valor_regra' => $tipo_procedimento,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                   }
                    
               }else if($tipo_procedimento == "A"){
                 //ACEITA TIPO E,U
                   
                   
                }else if($tipo_procedimento == "E"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "E", COMPARA COM A BASE DO CLIENTE SE É 'U OU A'
                   
                    if(($tipo_procedimento_cliente == "U")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                }else if($tipo_procedimento == "U"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "U", COMPARA COM A BASE DO CLIENTE SE É 'E OU A'
                   
                    if(($tipo_procedimento_cliente == "E")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                }
            }   
              * FIM DA REGRA 35 - REGIME DE ATENDIMENTO
              */      
        }else
          /*
          * INÍCIO REGRA 38 - CIRURGICO
           * S = SIM
           * N = NÃO
           * NC = NÃO COBERTO
          */
         if($regra == 38){
             
              $qtde_registros = $this->AudCon_model->getTabelaClienteByRegra($tabela);
             
             foreach ($qtde_registros as $regAnalise) {
               $id = $regAnalise->id;
               $guia = $regAnalise->guia;
               $cod_servico = $regAnalise->codigo_servico;  //TUSS
               $qtde = $regAnalise->quantidade;
               $vl_procedimento = $regAnalise->valor_procedimento;
               $competencia = $regAnalise->competencia;
               $cirurgico_cliente = $regAnalise->cirurgico;
              
               $dados_tuss = $this->AudCon_model->getRegitroTabelaTuss($cod_servico);
               $cirurgico = $dados_tuss->cirurgico;
               
               /*
                * verifica o tipo de procedimento
                */
               if($cirurgico == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                   }
                    
               }else if($cirurgico == "S"){
                 //SE A REGRA DIZ SIM E NA BASE DO CLIENTE DIZER NÃO, REGISTRA A INCONSISÊNCIA
                   if($cirurgico_cliente == "N"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                    }
                   }
                   
                }else if($cirurgico == "N"){
                  //SE NÃO FOR UM PROCEDIMENTO CIRÚRGICO MAS NA BASE DO CLIENTE DIZ QUE SIM, REGISTRA A INCONSISÊNCIA
                   
                    if($cirurgico_cliente == "S"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                    }
                   }
                    
                }
            }
             
             // FIM REGRA 38 - CIRURGICO
         }
        
        
        
        
     }
    
    
}
