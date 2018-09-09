<body class="hold-transition ">
    <div class="wrapper">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Análises
        <small>Painel de Controle</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Análise</li>
      </ol>
    </section>

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
        <div class="col-lg-3">
            <button style="margin-bottom: 20px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-insert">
                Nova Análise
            </button>
          </div>
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Análises </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Data</th>
                  <th>Cliente</th>
                  <th>Perído de </th>
                  <th>Perído Até</th>
                  <th>Carga Via</th>
                  <th>Status</th>
                  <th>Editar</th>
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $analises = $this->AudCon_model->getAnalises();
                    foreach ($analises as $cli) {
                        //
                        $cliente = $this->companies_model->getCompanyByID($cli->cliente);
                        
                        $status = $cli->status;
                ?>   
                
                <tr>
                  <td><?php echo $cont++; ?></td>  
                  <td><?php echo date("d/m/Y", strtotime($cli->dt_solicitacao)); ?></td>
                  <td><?php echo $cliente->company; ?></td>
                  <td><?php echo $cli->periodo_de; ?></td>
                  <td><?php echo $cli->periodo_ate; ?></td>
                  <td><?php echo $cli->carga; ?></td>
                  <td style="background-color: <?php if($status == 0){ ?> gray <?php }else if($status == 1){ ?> orange <?php }else if($status == 2){ ?> green  <?php }  ?>"><?php if($status == 0){ ?> ABERTO  <?php }else if($status == 1){ ?> EM ANÁLISE <?php }else if($status == 2){ ?> CONCLUÍDO  <?php }  ?></td>
                  <td>
                      <a href="audcon/edit_analise/<?php echo $cli->id; ?>" ><i class="fa fa-edit"></i> Editar</a>
                                          
                </td>
                  <td>
                      <a href="audcon/processamentos/<?php echo $cli->id; ?>" class="btn btn-block btn-danger"><i class="fa fa-gears"></i> Análises</a>
                    
                  </td>
                                          
                </tr>
                <?php
                }
                ?>
               
               
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Data</th>
                  <th>Cliente</th>
                  <th>Perído de </th>
                  <th>Perído Até</th>
                  <th>Carga Via</th>
                  <th>Status</th>
                  <th>Editar</th>
                  <th>Opções</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <div class="modal fade" id="modal-insert">
          <div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Cadastrar nova Análise'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
        echo form_open_multipart("AudCon/add_analise", $attrib); ?>
        <div class="modal-body">
         
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group company">
                        <?= lang("Cliente", "company"); ?>
                        <div class="controls"> <?php
                            $clientes = $this->AudCon_model->getClientesAtivos();
                            foreach ($clientes as $cli) {
                                $cgs[$cli->id] = $cli->company;
                            }
                            echo form_dropdown('cliente', $cgs, $this->Settings->customer_group, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group person">
                        <?= lang("Período de : ", "name"); ?>
                        <?php echo form_input('periodo_de', '', 'class="form-control tip" id="name"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("período até : ", "vat_no"); ?>
                        <?php echo form_input('periodo_ate', '', 'class="form-control" id="vat_no"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("Carga Via", "email_address"); ?>
                        <input type="text" name="carga" class="form-control" required="true"  id="email_address"/>
                    </div>
                    
                    

                </div>
                
            </div>


        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_customer', lang('Cadastrar'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
            <!-- /.modal-content -->
          </div>
        </div>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 </div>

</body>