<body class="hold-transition skin-blue layout-boxed <?php if($layout){ echo $layout; }?>  sidebar-mini">
    <div class="wrapper">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Processamentos das Análises
        <small>Registros de processamento</small>
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
      
      <Br><br>
      <div class="row">
          <div class="col-lg-6">
              <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Selecione as regras que serão aplicadas nesta análise</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" value="">
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
          </div>
          <div class="col-lg-6">
              
             
              <div style="margin-top: 20%;" class="modal-body">
            <p><?= lang('Selecione as regras que deseja aplica para esta análise.'); ?></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group company">
                        <a class="btn btn-danger btn-lg">REALIZAR NOVA ANÁLISE</a>
                    </div>
                </div>
            </div>


        </div>
     
    </div>

          </div>
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
              <h3 class="box-title">Análises Concluídas</h3>
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
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $analises = $this->AudCon_model->getAnalises();
                    foreach ($analises as $cli) {
                ?>   
                
                <tr>
                  <td><?php echo $cont++; ?></td>  
                  <td><?php echo $cli->dt_solicitacao; ?></td>
                  <td><?php echo $cli->cliente; ?></td>
                  <td><?php echo $cli->periodo_de; ?></td>
                  <td><?php echo $cli->periodo_ate; ?></td>
                  <td><?php echo $cli->carga; ?></td>
                  <td><?php echo $cli->status; ?></td>
                  <td> <button type="button" class="btn btn-block btn-success">Análise</button></td>
                                          
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
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 </div>

</body>