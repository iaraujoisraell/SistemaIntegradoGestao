
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de Clientes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Cadastros</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>

   
    <div class="div-ajax-carregamento-pagina">
        <div class="col-md-12">
          <div class="box  box-solid">
            <div class="box-header">
              <h3 class="box-title">Aguarde</h3>
            </div>
            <div class="box-body">
              Carregando
            </div>
            <!-- /.box-body -->
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    

    
    <!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-lg-3">
              <button style="margin-bottom: 20px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-insert">
                            Novo Cadastro
                        </button>
          </div>
          
           
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
           
            <div >
                
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>  
                  <th>Empresa</th>  
                  <th>Cidade</th>
                  <th>Telefone</th>
                  <th>Email</th>
                  <th>EDITAR</th>
                  <th>EXCLUIR</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                                
                   $clientes = $this->AudCon_model->getClientes();
                    foreach ($clientes as $cli) {
                ?>   
                
                <tr>
                  <td><?php echo $cli->id; ?></td>  
                  <td><?php echo $cli->company; ?></td>
              
                  <td><?php echo $cli->city; ?></td>
                  <td><?php echo $cli->phone; ?></td>
                  <td><?php echo $cli->email; ?></td>
                     <td><a href="editarPaciente.php?cpf=<?php echo $row['CPF'] ?>"><i class="fa fa-edit"></i></a></td>
                                               <td><a href="app/processaPacientes.php?tipo=delete&cpf=<?php echo $row['CPF'] ?>"><i class="fa fa-trash-o"></i></a></td>
                                          
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>  
                  <th>Empresa</th>  
                  <th>Cidade</th>
                  <th>Telefone</th>
                  <th>Email</th>
                  <th>EDITAR</th>
                  <th>EXCLUIR</th>
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
<div class="modal fade" id="modal-insert">
          <div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Cadastro de Cliente'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
        echo form_open_multipart("AudCon/add_cliente", $attrib); ?>
        <div class="modal-body">
           

         

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group company">
                        <?= lang("Empresa *", "company"); ?>
                        <?php echo form_input('company', '', 'class="form-control tip" id="company" required="true" data-bv-notempty="true"'); ?>
                    </div>
                    <div class="form-group person">
                        <?= lang("Nome Contato", "name"); ?>
                        <?php echo form_input('name', '', 'class="form-control tip" id="name" data-bv-notempty="true"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("vat_no", "vat_no"); ?>
                        <?php echo form_input('vat_no', '', 'class="form-control" id="vat_no"'); ?>
                    </div>
                    <!--<div class="form-group company">
                    <?= lang("contact_person", "contact_person"); ?>
                    <?php echo form_input('contact_person', '', 'class="form-control" id="contact_person" data-bv-notempty="true"'); ?>
                </div>-->
                    <div class="form-group">
                        <?= lang("E-mail *", "email_address"); ?>
                        <input type="email" name="email" class="form-control" required="true"  id="email_address"/>
                    </div>
                    <div class="form-group">
                        <?= lang("phone", "phone"); ?>
                        <input type="tel" name="phone" class="form-control"  id="phone"/>
                    </div>
                    

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= lang("address", "address"); ?>
                        <?php echo form_input('address', '', 'class="form-control" id="address" '); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("city", "city"); ?>
                        <?php echo form_input('city', '', 'class="form-control" id="city" '); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("state", "state"); ?>
                        <?php echo form_input('state', '', 'class="form-control" id="state"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("postal_code", "postal_code"); ?>
                        <?php echo form_input('postal_code', '', 'class="form-control" id="postal_code"'); ?>
                    </div>
                  
                    
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_customer', lang('add_customer'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
            <!-- /.modal-content -->
          </div>
        </div>

 