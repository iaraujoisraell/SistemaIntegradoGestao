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
        Editar Dados Análise
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
              <?php $analises = $this->AudCon_model->getAnaliseById($id); ?>
              
              <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
                        echo form_open_multipart("AudCon/edit_analise", $attrib); ?>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                             <?= lang("Cliente", "company"); ?>
                                <div class="form-group person">
                                    <?php
                                    $clientes = $this->AudCon_model->getClientesAtivos();
                                    foreach ($clientes as $cli) {
                                        $cgs[$cli->id] = $cli->company;
                                    }
                                    echo form_dropdown('cliente', $cgs, $this->Settings->customer_group, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                                    ?>
                                </div>
                            <div class="form-group person">
                                <?= lang("Período de", "name"); ?>
                                <?php echo form_input('periodo_de', $analises->periodo_de, 'class="form-control tip" id="name" '); ?>
                            </div>
                            <div class="form-group">
                                <?= lang("Período até", "vat_no"); ?>
                                <?php echo form_input('periodo_ate', $analises->periodo_ate, 'class="form-control" id="vat_no"'); ?>
                            </div>

                            <div class="form-group">
                                <?= lang("Carga via", "email_address"); ?>
                                <input type="text" name="carga" value="<?php echo $analises->carga; ?>" class="form-control" />
                            </div>
                            <div class="form-group">
                                <?= lang("tabela BD", "phone"); ?>
                                <input  type="text" name="tabela" value="<?php echo $analises->tabela; ?>"  class="form-control" required="required"  id="tabela"/>
                            </div>


                        </div>
                        <div  class="col-md-6">
                            <div class="form-group">
                                <?= lang("Regras que serão aplicadas para esta análise", "address"); ?>
                                <?php
                                    
                                    $regras_analise = $this->AudCon_model->getAnaliseRegraByAnalise($id);
                                   // print_r($regras_analise);
                                     foreach ($regras_analise as $regAnalise) {
                                        $cgs_ra[$regAnalise->id_regra] = $regAnalise->id_regra;
                                    }
                                    //
                                    $regras = $this->AudCon_model->getRegrasModulo();
                                    foreach ($regras as $cli2) {
                                        $cgs2[$cli2->id_regra] = $cli2->sessao.' - '. $cli2->regra;
                                    }
                                   
                                    echo form_dropdown('regras[]', $cgs2, (isset($_POST['regras[]']) ? $_POST['regras[]'] : $cgs_ra), 'class="form-control tip select" multiple id="customer_group" style="width:100%; height:350px; " required="required"');
                                    ?>
                            </div>
                           
                   <?php //echo 'aqqquuuiii'; print_($regras_analise); ?>
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



 