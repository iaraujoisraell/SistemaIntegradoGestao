<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<html lang="en">
<?php  $this->load->view($this->theme . 'menu_head'); ?>
<body>

    <div id="wrapper">

        <?php  $this->load->view($this->theme . 'top'); ?>

       
        <!-- end SIDE NAVIGATION -->

        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE ROW -->
               
               
                
                <!-- ATALHOS RÁPIDO -->
                <?php  $this->load->view($this->theme . 'atalhos'); ?>
                
                
                
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
                <br><br>
                <!-- /ATALHOS RÁPIDO -->
                <div class="row">
                    
                   <!-- LADO ESQUERDO -->
                    <div class="col-lg-6">
                        <!-- MEUS PROJETOS -->
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Projetos Abertos</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a href="#"><i class="fa fa-gear"></i></a>
                                    <span class="divider"></span>
                                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#buttons"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="buttons" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="social-sizes">
                                    <?php
                                    $usuario = $this->session->userdata('user_id');
                                    $projetos_user = $this->site->getAllProjetosUsers($usuario);
                                    $cont = 1;
                                    $qtde_perfis_user = 0;
                                    foreach ($projetos_user as $item) {
                                        $id_projeto = $item->projeto;
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
                                           <?php if($porc_concluido != 100){ echo  substr($porc_concluido,0,5); }else{ echo $porc_concluido; } ?> % Concluído
                                          </div>
                                          <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $porc_pendente;  ?>%">
                                           <?php if($porc_pendente != 100){ echo  substr($porc_pendente,0,5); }else{ echo $porc_pendente; } ?>% Em Andamento
                                          </div>
                                          <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php  echo $porc_atrasado;  ?>%">
                                           <?php if($porc_atrasado != 100){ echo  substr($porc_atrasado,0,5); }else{ echo $porc_atrasado; } ?>% Atrasado
                                          </div>
                                        </div>
                                          <hr>
                                        <?php
                                        $cont++;
                                    }
                                    //  }
                                    ?>   
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- /MEUS PROJETOS -->
                        <!-- MENU DE ACESSO -->
                        
                        <!-- /MENU DE ACESSO -->
                              
                      
                    </div>
                   
                   <div class="col-lg-6">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Projetos Concluídos</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a href="#"><i class="fa fa-gear"></i></a>
                                    <span class="divider"></span>
                                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#buttons"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="buttons" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="social-sizes">
                                    <?php
                                    $usuario = $this->session->userdata('user_id');
                                    $projetos_user = $this->site->getAllProjetosUsers($usuario);
                                    $cont = 1;
                                    $qtde_perfis_user = 0;
                                    foreach ($projetos_user as $item) {
                                        $id_projeto = $item->projeto;
                                        $wu3[''] = '';
                                        $projeto = $this->atas_model->getProjetoByID($id_projeto);
                                        
                                        
                                        /*
                                         * VERIFICA SE TEM AÇÕES AGUARDANDO VALIDAÇÃO
                                         */
                                        $quantidadeAvalidacao = $this->site->getAllPlanosAguardandoValidacao($id_projeto);
                         
                                        
                                        
                                         $acoes_aguardando_validacao = $quantidadeAvalidacao->quantidade;
                                         
                                        
                                        ?>
                                        
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
                                       
                                        
                                        <?php
                                        $cont++;
                                    }
                                    //  }
                                    ?>   
                                        </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   
                 
                </div>
                <!-- /.row -->

            </div>
            <!-- /.page-content -->

        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->

    </div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/popupoverlay/defaults.js"></script>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="img/profile-pic.jpg" alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href="login.html" class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    <script src="<?= $assets ?>dashboard/js/plugins/popupoverlay/logout.js"></script>
    <!-- HISRC Retina Images -->
    <script src="<?= $assets ?>dashboard/js/plugins/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->
    <script src="<?= $assets ?>dashboard/js/plugins/ladda/spin.min.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/ladda/ladda.min.js"></script>
    <script src="<?= $assets ?>dashboard/js/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>

    <!-- THEME SCRIPTS -->
    <script src="<?= $assets ?>dashboard/js/flex.js"></script>
    <script src="<?= $assets ?>dashboard/js/demo/buttons-demo.js"></script>

    <script src="<?= $assets ?>dashboard/js/demo/calendar-demo.js"></script>
        <script src="<?= $assets ?>dashboard/js/plugins/fullcalendar/fullcalendar.min.js"></script>
</body>

</html>
