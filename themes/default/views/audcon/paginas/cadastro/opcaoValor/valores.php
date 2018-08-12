<?php
include('db_connection.php');
?>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    
      
    var ul_sortable = $('.sortable');
    ul_sortable.sortable({
        revert: 100,
        placeholder: 'placeholder'
    });
    ul_sortable.disableSelection();
    var btn_save = $('li.save'),
        div_response = $('#response');
    btn_save.on('mouseup', function(e) {
        e.preventDefault();
        setTimeout(function(){ 
        var sortable_data = ul_sortable.sortable('serialize');
        //div_response.text('aqui teste');
        $.ajax({
            data: sortable_data,
            type: 'POST',
            url: '../../save_opcao_regras.php',
            success:function(result) {
                div_response.text(result);
            }
        });
         }, 500);
         
    });
    
  });


  </script>
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gerenciar valores das Regras
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
      <div class="row">
          <br>
          
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
             <span class="pull-right-container">
              <div class="box-footer clearfix no-border">
              <button  type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modal-insert">
                   <i class="fa fa-plus"></i>  Novo Cadastro </button>
            </div>
             
            </span>
            </div>
                 
              <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Valores Cadastrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul id="sortable" class="todo-list sortable">
                  <?php
                    $cont = 1;                           
                     
                   $analises = $this->AudCon_model->getOpcoesValores();
                    foreach ($analises as $cli) {
                ?>   
                  
                <li  class="save" id=item-<?php echo $cli->id; ?>>
                    
               
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- todo text -->
                  <span class="text"><?php echo $cli->valor; ?></span>
                  <!-- Emphasis label -->
                  <small class="label label-default">  <?php echo $cli->descricao; ?></small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                   <a href="delete_valores_regra/<?php echo $cli->id; ?>"><i class="fa fa-trash-o"></i></a>
                   
                  </div>
                </li>
                 <?php
                    }
                 ?>
               
              </ul>
            </div>
            <!-- /.box-body -->
            
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
                <button type="button" class="close" data-dismiss="modal" class="abrirModal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Cadastrar Nova Opção de Valor'); ?></h4>
            </div>
            <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
            echo form_open_multipart("AudCon/add_valor_condicao_Cadastro", $attrib);
            ?>
           
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group person">
                        <?= lang("Valor ", "name"); ?>
                        <?php echo form_input('valor', '', 'class="form-control tip" required="true" id="name"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang("Descrição ", "vat_no"); ?>
                        <?php echo form_input('descricao', '', 'class="form-control" required="true" id="vat_no"'); ?>
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


 