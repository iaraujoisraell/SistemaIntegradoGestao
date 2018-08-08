<?php
                    $usuario = $this->session->userdata('user_id');
                    $projetos = $this->site->getProjetoAtualByID_completo($usuario);
                    $perfil_atual = $projetos->group_id;
                    $perfis_user = $this->site->getUserGroupAtual($perfil_atual);

                   $perfis_user = $this->site->getPerfilusuarioByID($usuario);
                   $qtde_perfis_user = 0;
                       foreach ($perfis_user as $item) {
                           $qtde_perfis_user++;
                       }
                    ?> 
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <br><br>
                              <div style="width: 70%;" >
                                    <?php
                                    $usuario = $this->session->userdata('user_id');
                                    $projetos_user = $this->site->getAllProjetosUsers($usuario);
                                    $cont = 1;
                                    $qtde_perfis_user = 0;
                                 //   foreach ($projetos_user as $item) {
                                        $id_projeto = $projetos->projeto_atual;
                                        $wu3[''] = '';
                                        $projeto = $this->atas_model->getProjetoByID($id_projeto);
                                        
                                        
                                        /*
                                         * VERIFICA SE TEM AÇÕES AGUARDANDO VALIDAÇÃO
                                         */
                                        $quantidadeAvalidacao = $this->site->getAllPlanosAguardandoValidacao($id_projeto);
                         
                                        
                                        
                                         $acoes_aguardando_validacao = $quantidadeAvalidacao->quantidade;
                                         
                                        
                                        ?>
                                        <a href="<?= site_url('Sig/projeto_ata/'.$projeto->id); ?>" class="btn btn-block btn-social btn-lg " style="background-color: <?php echo $projeto->botao; ?>">
                                            <i style="color:#ffffff;" class="fa fa-tasks fa-fw fa-3x"></i>
                                            <font style="color:#ffffff; font-weight:bold;">  <?php echo $projeto->projeto; ?>  </font>  
                                    <?php if($acoes_aguardando_validacao > 0){  ?>  <font style="color:#ffffff; font-size: 14px; margin-left: 15px;"><?php if($acoes_aguardando_validacao > 1){ ?>  <?php echo $acoes_aguardando_validacao; ?> Ações A.Validação <?php }else{ ?>  <?php echo $acoes_aguardando_validacao; ?> Ação A. Validação <?php } ?></font>  <?php } ?>
                                        </a>
                                      <?php
                                       //Qtde de AÇÕES
                                        $total_acoes =  $this->projetos_model->getQtdeAcoesByProjeto($id_projeto);
                                        $total_acoes = $total_acoes->total_acoes;
                                        //Qtde de Ações concluídas
                                        $concluido = $this->projetos_model->getStatusAcoesByProjeto($id_projeto, 'CONCLUÍDO');
                                        $concluido =  $concluido->status;
                                        //Qtde de ações Pendentes
                                        $pendente = $this->projetos_model->getAcoesPendentesByProjeto($id_projeto, 'PENDENTE');
                                        $avalidacao = $this->projetos_model->getAcoesAguardandoValidacaoByProjeto($id_projeto, 'AGUARDANDO VALIDAÇÃO');
                                        $pendente =  $pendente->pendente + $avalidacao->avalidacao;
                                        //Qtde de Ações Atrasadas
                                        $atrasadas = $this->projetos_model->getAcoesAtrasadasByProjeto($id_projeto, 'PENDENTE');
                                        $atrasadas =  $atrasadas->atrasadas;
                                        
                                        if($concluido){
                                            $porc_concluido = ($concluido * 100)/$total_acoes;
                                        }else{
                                            $porc_concluido = 0;
                                        }
                                        if($pendente){
                                            $porc_pendente = ($pendente * 100)/$total_acoes;
                                        }else{
                                            $porc_pendente = 0;
                                        }
                                        
                                        if($atrasadas){
                                            $porc_atrasado = ($atrasadas * 100)/$total_acoes;
                                        }else{
                                            $porc_atrasado = 0;
                                        }
                                      ?>
                                        <div class="progress">
                                          <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $porc_concluido;  ?>%">
                                           <?php if($porc_concluido != 100){ echo  substr($porc_concluido,0,2); }else{ echo $porc_concluido; } ?> % Concluído
                                          </div>
                                          <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $porc_pendente;  ?>%">
                                           <?php if($porc_pendente != 100){ echo  substr($porc_pendente,0,2); }else{ echo $porc_pendente; } ?>% Em Andamento
                                          </div>
                                          <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php  echo $porc_atrasado;  ?>%">
                                           <?php if($porc_atrasado != 100){ echo  substr($porc_atrasado,0,2); }else{ echo $porc_atrasado; } ?>% Atrasado
                                          </div>
                                        </div>
                                         
                                        <?php
                                        $cont++;
                                   // }
                                    //  }
                                    ?>   
                                          <?php
                    $usuario = $this->session->userdata('user_id');
                    $projetos = $this->site->getProjetoAtualByID_completo($usuario);
                    $perfil_atual = $projetos->group_id;
                    $perfis_user = $this->site->getUserGroupAtual($perfil_atual);

                   $perfis_user = $this->site->getPerfilusuarioByID($usuario);
                   $qtde_perfis_user = 0;
                       foreach ($perfis_user as $item) {
                           $qtde_perfis_user++;
                       }
                       
                       if($qtde_perfis_user > 1){
                    ?>
                                          
                                          <a href="<?= site_url('Sig/menu_projetos/'); ?>" class="btn btn-block btn-social btn-bitbucket">
                          <i class="fa fa-refresh"></i> Selecionar outro Projeto
                          </a>
                                  <div class="portlet portlet-default">
                            
                        </div>
                       <?php } ?>         
                         
                                        </div>   
                            
                           
                         
                        </center>
                        <div class="page-title">
                            
                            <ol class="breadcrumb">
                                <li><i class="fa fa-user"></i>  Gestor do Projeto:    <?php echo $projetos->gerente_area; ?>
                                </li>
                                <li class="active"><i class="fa fa-calendar"></i>Início do Projeto: <?php echo date("d/m/Y", strtotime($projetos->dt_inicio)); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <?php
                     $usuario = $this->session->userdata('user_id');
                     $projetos = $this->site->getProjetoAtualByID_completo($usuario);
                    
                     /*
                      * VERIFICA SE O USUÁRIO TEM PERMISSAO PARA ACESSAR O MENU EXIBIDO
                      */
                     $permissoes           = $this->projetos_model->getPermissoesByPerfil($projetos->group_id);   
                     $permissao_projetos   = $permissoes->projetos_index;
                     $permissao_atas       = $permissoes->atas_index;
                     $permissao_participantes   = $permissoes->participantes_index;
                     $permissao_eventos    = $permissoes->eventos_index;
                     
                     $permissao_acoes      = $permissoes->acoes_index;
                     $permissao_avalidacao = $permissoes->acoes_aguardando_validacao_index;
                     $permissao_apendentes = $permissoes->acoes_pendentes_index;
                     
                     
                     $permissao_dashboard   = $permissoes->dashboard_index;
                     
                     /*
                      * CADASTRO
                      */
                     $permissao_cadastro              = $permissoes->cadastro;
                     $permissao_pesquisa_satisfacao   = $permissoes->pesquisa_satisfacao_index;
                     $permissao_categoria_financeira  = $permissoes->categoria_financeira_index	;
                     $permissao_setores               = $permissoes->setores_index;
                     $permissao_perfil_acesso         = $permissoes->perfil_acesso;
                     /*
                      * RELATÓRIO
                      */
                     $permissao_relatorios             = $permissoes->relatorios;
                     $permissao_status_report          = $permissoes->status_report;
                     $permissao_users_acoes_atrasadas  = $permissoes->users_acoes_atrasadas;
                     /*
                      * PESSOAS
                      */
                     $permissao_cadastro_pessoas    = $permissoes->cadastro_pessoas;
                     $permissao_usuarios            = $permissoes->users_index;
                     $permissao_gestores            = $permissoes->lista_gestores;
                     $permissao_suporintendentes    = $permissoes->lista_superintendente;
                     $permissao_fornecedor          = $permissoes->fornecedores_index;
                     $lista_participantes          = $permissoes->lista_participantes;
                     
                     
                     /*
                      * GESTAO DE CUSTO
                      */
                     $permissao_gestao_custo          = $permissoes->gestao_custo;
                     $permissao_contas_pagar          = $permissoes->contas_pagar;
                     
                     /*
                      * CALENDÁRIO
                      */
                     $permissao_calendario          = $permissoes->calendario;
                    ?>
                            <?php if ($permissao_dashboard) { ?>    
                                <a title="MENU" href="<?= site_url('Sig/menu') ?>" class="btn btn-social-icon orange"><i class="fa fa-qrcode"></i></a>
                            <?php } ?>
                            <?php if ($permissao_dashboard) { ?>    
                                <a title="DASHBOARD" href="<?= site_url('projetos/dashboard/' . $projetos->projeto_atual) ?>" class="btn btn-social-icon btn-google-plus"><i class="fa fa-dashboard"></i></a>
                            <?php } ?> 
                            <?php if ($permissao_atas) { ?>
                                <a title="LISTA DE ATAS" href="<?= site_url('atas/add') ?>" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-book"></i></a>
                            <?php } ?>
                            <?php if ($permissao_avalidacao) { ?> 
                                <a title="AÇÕES AGUARDANDO VALIDAÇÃO"  href="<?= site_url('planos/planosAguardandoValidacao') ?>" class="btn btn-social-icon btn-pinterest"><i class="fa fa-clock-o"></i></a>
                            <?php } ?>     
                            <?php if ($permissao_acoes) { ?>     
                                <a title="LISTA DE AÇÕES" href="<?= site_url('planos') ?>" class="btn btn-social-icon btn-dropbox"><i class="fa fa-list"></i></a>
                            <?php } ?>
                            <?php if ($permissao_apendentes) { ?>     
                                <a title="AÇÕES PENDENTES" href="<?= site_url('Planos/planosPendentes') ?>" class="btn btn-social-icon btn-orange"><i class="fa fa-exclamation"></i></a>
                            <?php } ?>
                            <?php if ($permissao_projetos) { ?>
                                <a title="LISTA DE PROJETOS" href="<?= site_url('projetos/add') ?>" class="btn btn-social-icon btn-tumblr"><i class="fa fa-folder"></i></a>
                            <?php } ?>     
                             <?php if ($permissao_eventos) { ?>
                                <a title="LISTA DE EVENTOS" href="<?= site_url('projetos/add_evento') ?>" class="btn btn-social-icon btn-facebook"><i class="fa fa-calendar-o"></i></a>
                            <?php } ?>
                            <?php if ($permissao_participantes) { ?>    
                                <a title="LISTA DE PARTICIPANTES" href="<?= site_url('Atas/index_participantes') ?>" class="btn btn-social-icon btn-github"><i class="fa fa-users"></i></a>
                            <?php } ?>  
                            <?php if ($permissao_usuarios) { ?>     
                                <a title="LISTA DE USUÁRIOS" href="<?= site_url('users') ?>" class="btn btn-social-icon btn-vk"><i class="fa fa-user"></i></a>
                            <?php } ?>
                            <?php if ($permissao_calendario) { ?>    
                                <a title="CALENDÁRIO" href="<?= site_url('calendar') ?>" class="btn btn-social-icon btn-instagram"><i class="fa fa-calendar"></i></a>
                            <?php } ?>
                            <?php if ($permissao_contas_pagar) { ?>    
                                <a title="CUSTOS" href="<?= site_url('financeiro') ?>" class="btn btn-social-icon btn-green"><i class="fa fa-money"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>