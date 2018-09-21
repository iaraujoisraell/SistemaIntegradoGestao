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
  <?php
 
 function encrypt($str, $key)
        {
           
            for ($return = $str, $x = 0, $y = 0; $x < strlen($return); $x++)
            {
                $return{$x} = chr(ord($return{$x}) ^ ord($key{$y}));
                $y = ($y >= (strlen($key) - 1)) ? 0 : ++$y;
            }

            return $return;
        }
 ?>
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
              <h3 class="box-title">Análises </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Data Análise</th>
                  <th>Cliente</th>
                  <th>Perído de </th>
                  <th>Perído Até</th>
                  <th>Carga Via</th>
                  
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                 $login = $this->session->userdata('username');
                 $Clientes = $this->AudCon_model->getClienteByEmail($login);
                 
                    $cont = 1;                            
                   $analises = $this->AudCon_model->getAnalisesClientes($Clientes->id);
                    foreach ($analises as $cli) {
                        //
                        $cliente = $this->companies_model->getCompanyByID($cli->cliente);
                        $status = $cli->status;
                        
                        $analises_processos = $this->AudCon_model->getProcessosConcluidoAnalises($cli->id);
                        
                        $id_processo_riptografado =  encrypt($analises_processos->id,'ISRAEL');
                ?>   
                
                <tr>
                  <td><?php echo $cont++; ?></td>  
                  <td><?php echo date("d/m/Y", strtotime($cli->dt_solicitacao)); ?></td>
                  <td><?php echo $cliente->company; ?></td>
                  <td><?php echo $cli->periodo_de; ?></td>
                  <td><?php echo $cli->periodo_ate; ?></td>
                  <td><?php echo $cli->carga; ?></td>
                  
                  <td>
                      
                      <a href="audcon_cli/dashboardResultado/<?php echo $id_processo_riptografado; ?>" class="btn btn-block btn-success"><i class="fa fa-dashboard"></i> Dashboard</a>
                  </td>
                                          
                </tr>
                <?php
                }
                ?>
               
               
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Data Análise</th>
                  <th>Cliente</th>
                  <th>Perído de </th>
                  <th>Perído Até</th>
                  <th>Carga Via</th>
                  
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