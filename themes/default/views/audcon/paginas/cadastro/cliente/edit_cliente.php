<script>
$( "#success-btn" ).click(function() {
  $( "div.success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
});

$( "#failure-btn" ).click(function() {
  $( "div.failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
});

$( "#warning-btn" ).click(function() {
  $( "div.warning" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
  
});

</script>

<style>
    .alert-box {
	padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;  
}

.success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    display: none;
}

.failure {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    display: none;
}

.warning {
    color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
    display: none;
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Cadastro de Clientes 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Cadastros</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>

   
    
    

    
    <!-- Main content -->
    <section class="content">
     
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
             
            </div>
              <?php $clientes = $this->AudCon_model->getClienteById($id_cliente); ?>
              
              <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
                        echo form_open_multipart("AudCon/edit_cliente", $attrib); ?>
              <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
        <div class="modal-body">
           

           
         
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group company">
                        <?= lang("Empresa *", "company"); ?>
                        <?php echo form_input('company', $clientes->company, 'class="form-control tip" value="" id="company" required="true" data-bv-notempty="true"'); ?>
                    </div>
                    <div class="form-group person">
                        <?= lang("Nome Contato", "name"); ?>
                        <?php echo form_input('name', $clientes->name, 'class="form-control tip" id="name" data-bv-notempty="true"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("vat_no", "vat_no"); ?>
                        <?php echo form_input('vat_no', $clientes->vat_no, 'class="form-control" id="vat_no"'); ?>
                    </div>
                    
                    <div class="form-group">
                        <?= lang("E-mail *", "email_address"); ?>
                        <input type="email" name="email" value="<?php echo $clientes->email; ?>" class="form-control" required="true"  id="email_address"/>
                    </div>
                    <div class="form-group">
                        <?= lang("phone", "phone"); ?>
                        <input type="tel" name="phone" value="<?php echo $clientes->phone; ?>" value="<?php echo $clientes->phone; ?>" class="form-control"  id="phone"/>
                    </div>
                    

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= lang("address", "address"); ?>
                        <?php echo form_input('address', $clientes->address, 'class="form-control" id="address" '); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("city", "city"); ?>
                        <?php echo form_input('city', $clientes->city, 'class="form-control" id="city" '); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("state", "state"); ?>
                        <?php echo form_input('state', $clientes->state, 'class="form-control" id="state"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("postal_code", "postal_code"); ?>
                        <?php echo form_input('postal_code', $clientes->postal_code, 'class="form-control" id="postal_code"'); ?>
                    </div>
                  
                    
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_customer', lang('Atualizar Cadastro'), 'class="btn btn-primary"'); ?>
        </div>
              
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



 