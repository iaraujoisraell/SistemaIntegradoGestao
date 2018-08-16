<body class="hold-transition skin-blue layout-boxed <?php if($layout){ echo $layout; }?>  sidebar-mini">
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
      <div class="row">
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $processos_analises->num_registros; ?></h3>

              <p>Registros Analisadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          <?php
           $Guias_cliente = $this->AudCon_model->getQuantidadeDistintasGuiasAnalises($analises->tabela);
           ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $Guias_cliente->guia; ?><sup style="font-size: 20px"></sup></h3>

              <p>Número de Guias</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $processos_analises->num_inconsistencias; ?></h3>

              <p>Inconsistências Encontradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        <!-- ./col -->
        
        <!-- ./col -->
        <?php
            $cont = 1;                            
           $processos = $this->AudCon_model->getInconsistenciasProcessosAnalises($id);
           $soma_valor_total = 0;
            foreach ($processos as $reg) {
                $valor_total = ($reg->valor_inconsistencia * $reg->quantidade);
                $soma_valor_total += $valor_total;
            }
        ?>   
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $soma_valor_total; ?></h3>

              <p>Valor Total Indevido</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inconsistências </h3>
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
                  <th>Valor Total</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $processos = $this->AudCon_model->getInconsistenciasProcessosAnalises($id);
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
                  <td><?php echo $valor_total; ?></td>
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
                  <th>Valor Total</th>
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