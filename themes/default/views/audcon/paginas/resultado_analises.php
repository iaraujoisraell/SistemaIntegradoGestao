<body class="hold-transition sidebar-collapse  sidebar-mini">
    <div class="wrapper">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Diagnóstico da  Análise
        <small>Resultados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Resultado</li>
      </ol>
    </section>
    <br>
    <?php 
    $processos_analises = $this->AudCon_model->getProcessosAnalisesById($id);
    
    $analises = $this->AudCon_model->getAnaliseById($processos_analises->analise); ?>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Dados Análise </h3>
            </div>
          <div class="box-body">
              <div class="col-lg-12">
                  Data Solicitação : <?php echo $this->sma->hrld($analises->dt_solicitacao); ?>
              </div>
              <div class="col-lg-12">
                  <?php $clientes = $this->AudCon_model->getClienteById($analises->cliente); ?>
                  Cliente : <?php echo $clientes->company; ?>
              </div>
              <div class="col-lg-12">
                  Status : <?php $status = $analises->status;  if($status == 0){ ?> ABERTO  <?php }else if($status == 1){ ?> EM ANÁLISE <?php }else if($status == 2){ ?> CONCLUÍDO  <?php }  ?>
              </div>
              
          </div>
    <!-- Main content -->
    <section class="content">
         <?php if ($Settings->mmode) { ?>
                        <div class="alert alert-warning">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <?= lang('site_is_offline') ?>
                        </div>
                    <?php }
                    if ($error) { ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $error; ?></ul>
                        </div>
                    <?php }
                    if ($message) { ?>
                        <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $message; ?></ul>
                        </div>
                    <?php } ?>
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inconsistências  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Regra</th>
                  <th>Descrição</th>
                  <th>Guia</th>
                  <th>Serviço</th>
                  <th>Valor Esperado </th>
                  <th>Valor Encontrado</th>
                  <th>Quantidade Procedimento</th>
                  <th>Valor do Procedimento</th>
                 
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $processos = $this->AudCon_model->getAllInconsistenciasProcessosAnalises($id, $analises->tabela_log);
                  // print_r($processos);
                    foreach ($processos as $reg) {
                        
                        /*
                         * REGRA
                         */
                        $regras = $this->AudCon_model->getRegrasBySessao($reg->id_regra);
                        $regra = $regras->sessao;
                        $desc = $regras->descricao;
                       // $obs = $regras->observacao;
                        
                        /*
                         * DADOS BASE CLIENTE
                         */
                        $dados_cliente = $this->AudCon_model->getDadosClienteById($analises->tabela,$reg->id_base_cliente);
                        $guia = $dados_cliente->guia;
                        $cod_tuss = $dados_cliente->codigo_servico;
                        
                        $valor_total = ($reg->valor_inconsistencia * $reg->quantidade);
                      
                ?>   
                
                <tr>
                  <td><?php echo $cont++; ?></td>  
                  <td><?php echo $regra; ?></td>
                  <td><?php echo $desc; ?></td>
                  <td><?php echo $guia; ?></td>
                  <td><?php echo $cod_tuss; ?></td>
                  <td><?php echo $reg->valor_regra; ?></td>
                  <td><?php echo $reg->valor_cliente; ?></td>
                  <td><?php echo $reg->quantidade; ?></td>
                  <td><?php echo $reg->valor_inconsistencia; ?></td>    
                  
                </tr>
                <?php
                }
                ?>
               
               
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Regra</th>
                  <th>Descrição</th>
                  <th>Guia</th>
                  <th>Serviço</th>
                  <th>Valor Esperado </th>
                  <th>Valor Encontrado</th>
                  <th>Quantidade</th>
                  <th>Valor do Procedimento</th>
                
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 </div>

</body>