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
        //ini_set("max_execution_time", 12000);
         
        $this->sma->checkPermissions(false, true);

         $regras = $this->input->post('regras');
         $analise = $this->input->post('id');
         
         
        if ($regras) {
            $analises = $this->AudCon_model->getAnaliseById($analise);
            $tabela_cliente = $analises->tabela;
            $tabela_cliente_log = $analises->tabela_log;
            
            $qtde_registros = $this->AudCon_model->getMaxRegistrosCliente($tabela_cliente);
            $qtde = $qtde_registros->quantidade;
            
             
             $data_processo = array(
                'dt_processo' => date('Y-m-d H:i:s'),
                'usuario' => $usuario = $this->session->userdata('user_id'),
                'ip' => $_SERVER["REMOTE_ADDR"],
                'num_registros' => $qtde,
                'analise' => $analise
            );
               $id_processo = $this->AudCon_model->addProcessamentoAnalise($data_processo);
          
             
            foreach ($regras as $item) {
                $regra = $this->AudCon_model->getRegrasById($item);
                $sessao = $regra->sessao;
                
                $this->analisaRegra($sessao, $tabela_cliente,$tabela_cliente_log, $id_processo);
                $qtde_registros_regras = $this->AudCon_model->getQuantidadeInconsistenciaByRegra($tabela_cliente_log, $sessao, $id_processo);
                $qtde_inc_reg = $qtde_registros_regras->quantidade;
                $valor_inc_reg = $qtde_registros_regras->valor;
                $porcentagem = ($qtde_inc_reg*100)/$qtde;
                
                /*
                 * ADICIONA O RESUMO DA ANÁLISE EM UMA TABELA PARA O DASHBOARD
                  */
                 $data_processo_regra = array(
                'id_processo_analise' => $id_processo,
                'id_regra' => $sessao,
                'quantidade' => $qtde_inc_reg,
                'valor_referente' => $valor_inc_reg,
                'porcentagem' => $porcentagem
                );
               $this->AudCon_model->addProcessamentoAnaliseRegra($data_processo_regra);
               
            }
            
            
           // RETORNA O NÚMERO DE INCONSISTÊNCIAS
            $qtde_inconsistencias = $this->AudCon_model->getInconsistenciasProcessosAnalises($id_processo, $tabela_cliente_log);
            $qtde_incons = $qtde_inconsistencias->quantidade;
             
            // RETORNA O NÚMERO DE PROCEDIMENTOS DISCREPANTES
            $qtde_proc_disc = $this->AudCon_model->getProcedimentosDiscrepantesProcessoAnalise($id_processo, $tabela_cliente_log);
            $qtde_discrepante = $qtde_proc_disc->quantidade_proc_disc;
            
            // RETORNA O VALOR DISCREPANTES
            $valor_discrepante = $this->AudCon_model->getValorDiscrepantesProcessoAnalise($id_processo, $tabela_cliente_log);
            $qtde_valor = $valor_discrepante->valor;
             
            // PERÍODO ANALISADO
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            
            $periodo_de = $analises->periodo_de;
            $partes_de = explode("/", $periodo_de);
            $mes_de = $partes_de[0];
            $ano_de = $partes_de[1];
            
            $monthNum_de = $mes_de;
            $dateObj = DateTime::createFromFormat('!m', $monthNum_de);
            $monthName_de = $dateObj->format('F');
            $mes_de_form = substr($monthName_de, 0, 3);
            
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            
            $periodo_ate = $analises->periodo_ate;
            $partes_ate = explode("/", $periodo_ate);
            $mes_ate = $partes_ate[0];
            $ano_ate = $partes_ate[1];
            
            $monthNum_ate = $mes_ate;
            $dateObj = DateTime::createFromFormat('!m', $monthNum_ate);
            $monthName_ate = $dateObj->format('F');
            $mes_ate_form = substr($monthName_ate, 0, 3);
            
            $periodo = $mes_de_form.'/'.$ano_de.' - '.$mes_ate_form.'/'.$ano_ate;
      
            
            // RETORNA O NÚMERO DE PRESTADORES
            $qtde_pretadores = $this->AudCon_model->getPrestadoresProcessoAnalise($tabela_cliente);
            $qtde_prestador = $qtde_pretadores->codigo_prestador;
            
            // RETORNA O NÚMERO DE GUIAS
            $qtde_guias = $this->AudCon_model->getQuantidadeGuiasAnalises($tabela_cliente);
            $qtde_guia = $qtde_guias->guia;
            
            // RETORNA O NÚMERO DE BENEFICIÁRIOS
            $qtde_benef = $this->AudCon_model->getQuantidadeBeneficiariosGuiasAnalises($tabela_cliente);
            $qtde_beneficiario = $qtde_benef->beneficioario;
            
            /*
             * REGISTRA O NÚMERO DE INCONSISTÊNCIA
             */
             
            $data_update = array(
                'num_inconsistencias' => $qtde_incons,
                'procedimentos_discrepantes' => $qtde_discrepante,
                'valor_discrepante' => $qtde_valor,
                'periodo_analisado' => $periodo,
                'prestadores' => $qtde_prestador,
                'num_guias' => $qtde_guia,
                'num_beneficiarios' => $qtde_beneficiario
            );
            
           // print_r($data_update); exit;
               $this->AudCon_model->updateProcessamentoAnalise($id_processo, $data_update);
             
               /*
                * SALVA OS DADOS SOBRE OS PRESTADORES
                */
               
              
            $prestadores =  $this->AudCon_model->getPrestadoresDistinctAnalise($tabela_cliente);
           foreach ($prestadores as $prestador) {
               $codigo_prestador = $prestador->codigo_prestador;
               $prestador_nome = $prestador->prestador;
               $rede = $prestador->rede;
                
               $dados_prestador = $this->AudCon_model->getNumeroProcedimentosPrestadorByCodigo($codigo_prestador, $tabela_cliente);
               $numero_procedimento = $dados_prestador->quantidade;
               $guia = $dados_prestador->guia;
               $num_beneficiarios = $dados_prestador->beneficiarios;
              
               $dados_inconsistencia_prestador = $this->AudCon_model->getNumeroInconsistenciasPrestadorByCodigo($codigo_prestador, $tabela_cliente_log, $id_processo);
               $numero_inconsistencia = $dados_inconsistencia_prestador->quantidade;
               
               if($numero_inconsistencia == 0){
                   $valor_discrepante_prestador = 0;
               }else{
                   $valor_discrepante_prestador = $dados_inconsistencia_prestador->valor;
               }
               $dados_prestador_procedimentos_discrepantes = $this->AudCon_model->getNumeroProcedimentosDiscrepantesPrestadorByCodigo($codigo_prestador, $tabela_cliente_log);
               $numero_procedimento_discrepante = $dados_prestador_procedimentos_discrepantes->quantidade;
               
               
               $data_prestador = array(
                'id_processo_analise' => $id_processo,
                'id_prestador' => $codigo_prestador,
                'prestador' => $prestador_nome,
                'rede_prestador' => $rede,
                'inconsistencias' => $numero_inconsistencia,
                'valor_discrepante' => $valor_discrepante_prestador,
                'num_procedimentos' => $numero_procedimento,
                'procedimentos_discrepantes' => $numero_procedimento_discrepante,
                'num_guias' => $guia,
                'num_beneficiarios' => $num_beneficiarios
            );
              
           $prestador_processo_analise =  $this->AudCon_model->addProcessamentoAnalisePrestador($data_prestador);   
           //  $regra = $this->AudCon_model->getRegrasById($item);
             //   $sessao = $regra->sessao;
               
            }  
               
               
            
            $this->session->set_flashdata('message', lang("Processo Realizado com sucesso!"));
             redirect('AudCon/processamentos/'.$analise);
          
        }else  {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('AudCon/processamentos/'.$analise);
        }

     
    }
    
    
     function analisaRegra($regra, $tabela, $tabela_log, $processo)
    {
         
         
         $qtde_registros = $this->AudCon_model->getTabelaClienteByRegra($tabela);
          foreach ($qtde_registros as $regAnalise) {
               $id = $regAnalise->id;
               $guia = $regAnalise->guia;
               $cod_servico = $regAnalise->codigo_servico;  //TUSS
               $qtde = $regAnalise->quantidade;
               $vl_procedimento = $regAnalise->valor_procedimento;
               $competencia = $regAnalise->competencia;
               $codigo_prestador = $regAnalise->codigo_prestador;
               
               //BENEFICIÁRIO
               $tipo_procedimento_cliente = $regAnalise->carater_atendimento; //34 - TIPO/CARATER PROCEDIMENTO
               $regime_atendimento = $regAnalise->regime_atendimento; //35 - REGIME_ATENDIMENTO
               $cirurgico_cliente = $regAnalise->cirurgico; //38 - CIRURGICO
               $sexo_beneficiario = $regAnalise->sexo_beneficiario; //45 - SEXO
               $idade_beneficiario = $regAnalise->dt_nascimento; //47 - IDADE MÍNIMA  /   48 - IDADE MÁXIMA
               $quantidade_procedimento = $regAnalise->quantidade; //51 - QUANTIDADE
               
               
               
               //TUSS
               $dados_tuss = $this->AudCon_model->getRegitroTabelaTuss($cod_servico);
               $rol = $dados_tuss->rol; //23 - ROL
               $tipo_procedimento = $dados_tuss->tipo_procedimento; //34 - TIPO/CARATER PROCEDIMENTO
               $cirurgico = $dados_tuss->cirurgico; //38 - CIRURGICO
               $sexo = $dados_tuss->sexo; //45 - SEXO
               $idade_minima = $dados_tuss->idade_min; //47 - IDADE MÍNIMA
               $idade_maxima = $dados_tuss->idade_max; //48 - IDADE MÁXIMA
               $quantidade = $dados_tuss->quantidade; //51 - QUANTIDADE
               
               
          /*
          * INÍCIO REGRA 23 - CONSTA NO ROL
          */
        if($regra == 23){
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
                        'codigo_prestador' => $codigo_prestador,
                        'valor_cliente' => "SIM",
                        'valor_regra' => $rol,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log,$data_inconsistencia);
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
             
               /*
                * verifica o tipo de procedimento
                */
               if($tipo_procedimento == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $tipo_procedimento_cliente,
                        'valor_regra' => $tipo_procedimento,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                   }
                    
               }else if($tipo_procedimento == "A"){
                 //ACEITA TIPO E,U
                   
                   
                }else if($tipo_procedimento == "E"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "E", COMPARA COM A BASE DO CLIENTE SE É 'U OU A'
                   
                    if($tipo_procedimento_cliente == "U"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'codigo_prestador' => $codigo_prestador,   
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                           }
                    }
                }else if($tipo_procedimento == "U"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "U", COMPARA COM A BASE DO CLIENTE SE É 'E OU A'
                   
                    if($tipo_procedimento_cliente == "E"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'codigo_prestador' => $codigo_prestador,   
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                           }
                    }
                }
                  
         /*
          * FIM REGRA 34 - TIPO PROCEDIMENTO
          */
        }else
            
            
          /*
           * 
           * CLINICO
           * CIRURGICO
           * OBSTÉTRICO
           * PEDIÁTRICO
           * PSIQUIÁTRICO
           * 
           * 
          * INÍCIO REGRA 35 - REGIME DE ATENDIMENTO
           * 1 = AMBULATORIAL
           * 2 = INTERNACAO
           * 3 = AMBOS
           * 4 = HOSPITAL DIA
           * NC = NÃO COBERTO
          */
         if($regra == 35){
             /*
            
               
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
             
               /*
                * verifica o tipo de procedimento
                */
               if($cirurgico == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                   }
                    
               }else if($cirurgico == "S"){
                 //SE A REGRA DIZ SIM E NA BASE DO CLIENTE DIZER NÃO, REGISTRA A INCONSISÊNCIA
                   if($cirurgico_cliente == "N"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
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
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $cirurgico_cliente,
                        'valor_regra' => $cirurgico,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   }
                    
                }
            
             
             // FIM REGRA 38 - CIRURGICO
         }else
          /*
          * INÍCIO REGRA 45 - SEXO
           * M = MASCULINO
           * F = FEMININO
           * A = AMBOS 
           * NC = NÃO COBERTO PELO ROL
          */
         if($regra == 45){
             
             /*
                * verifica o tipo de procedimento
                */
               if($sexo == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $sexo_beneficiario,
                        'valor_regra' => $sexo,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log,$data_inconsistencia);
                   }
                    
               }else if($sexo == "M"){
                 //SE A REGRA DIZ M E NA BASE DO CLIENTE DIZ F, REGISTRA A INCONSISÊNCIA
                   if($sexo_beneficiario == "F"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $sexo_beneficiario,
                        'valor_regra' => $sexo,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   }
                   
                }else if($sexo == "F"){
                  //SE A REGRA DIZ F E NA BASE DO CLIENTE DIZ M, REGISTRA A INCONSISÊNCIA
                   
                    if($sexo_beneficiario == "M"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $sexo_beneficiario,
                        'valor_regra' => $sexo,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   }
                    
                }
            
             
             // FIM REGRA 45 - SEXO
         
            
             
             
         }else 
             
          /*
          * INÍCIO REGRA 47 - IDADE MÍNIMA
          */
             
         if($regra == 47){
             
             /*
                * verifica o tipo de procedimento
                */
               if($sexo == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $idade_beneficiario,
                        'valor_regra' => $idade_minima,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                   }
                    
               }else if($idade_beneficiario < $idade_minima  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'codigo_prestador' => $codigo_prestador,   
                        'valor_cliente' => $idade_beneficiario,
                        'valor_regra' => $idade_minima,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 47 - IDADE MÍNIMA
         }
               
         /*
          * INÍCIO REGRA 48 - IDADE MÁXIMA
          */
             
         if($regra == 48){
             
             /*
                * verifica o tipo de procedimento
                */
               if($sexo == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                         'codigo_prestador' => $codigo_prestador,  
                        'valor_cliente' => $idade_beneficiario,
                        'valor_regra' => $idade_minima,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                   }
                    
               }else if($idade_beneficiario > $idade_maxima  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                         'codigo_prestador' => $codigo_prestador,  
                        'valor_cliente' => $idade_beneficiario,
                        'valor_regra' => $idade_minima,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 48 - IDADE MÁXIMA
         }
         
         /*
          * INÍCIO REGRA 51 - QUANTIDADE
          */
             
         if($regra == 51){
             
             /*
                * verifica o tipo de procedimento
                */
               if($quantidade == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                         'codigo_prestador' => $codigo_prestador,  
                        'valor_cliente' => $quantidade_procedimento,
                        'valor_regra' => $quantidade,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                   }
                    
               }else if($quantidade_procedimento > $quantidade  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                         'codigo_prestador' => $codigo_prestador,  
                        'valor_cliente' => $quantidade_procedimento,
                        'valor_regra' => $quantidade,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($tabela_log, $data_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 51 - QUANTIDADE
         }
         
          }
        
     }
    
    
}
