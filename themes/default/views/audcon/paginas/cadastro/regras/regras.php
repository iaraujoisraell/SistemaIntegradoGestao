
<script type='text/javascript'>

//data-toggle="modal" data-target="#modal-insert_condicao"
//"../../themes/default/views/audcon/paginas/cadastro/regras/modal_nova_condicao.php?id=",
    function adicionaCondicao(id) {
        var regra_id = id;
  $.ajax({
    type: "POST",
    url: "../../themes/default/views/audcon/modals/modal_nova_condicao.php?id="+regra_id,
    data: {
      valor_parcela: $('#input_id_valor_parcela').val(),
      data_vencimento: $('#input_id_data_vencimento').val()
    },
    success: function(data) {
      $('#conteudo_insert_condicao').html(data);
    }
  });
}




</script>



<!-- Aqui serão mostrados os conteúdos -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Regras de Verificação
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Regras</li>
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
            <!-- /.box-header -->
           
            <div class="table-responsive">
                
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th style="width: 5%;">Regra</th>
                  <th style="width: 10%;">Descrição</th>
                  <th style="width: 10%;">Relacionamento Estrutura Cliente</th>
                  <th style="width: 5%;">Observação</th>
                  <th style=" width: 50%;" >
                      <table style="width: 100%;" id="example1" class="table table-bordered table-striped">
                          <tr style="background-color: orange">
                              <td style="width: 25%;"> valor cliente </td>
                              <td style="width: 25%;"> Condição </td>
                              <td style="width: 25%;"> valor Esperado </td>
                              <td style="width: 25%;"> resultado </td>
                          </tr>
                      </table>
                  </th>
                  <th style="width: 10%;">Editar</th>  
                  <th style="width: 10%;">Inativar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                                
                   $regras = $this->AudCon_model->getRegrasModulo();
                    foreach ($regras as $reg) {
                ?>   
                
                <tr>
                  
                  <td style="width: 5%;"><?php echo $reg->sessao; ?></td>
                  <td style="width: 10%;"><?php echo $reg->regra; ?></td>
                  <td style="width: 10%;"><?php echo $reg->regra; ?></td>
                  <td style="width: 5%;"><a href="edit_cliente/<?php echo $cli->id; ?>"><i class="fa fa-info"></i></a></td>
                  <td style="width: 50%;">
                      <table style="width: 100%;" id="example1" class="table table-bordered table-striped " >
                         
                          <tbody>
                
                <?php
                    $cont = 1;                            
                   $analises = $this->AudCon_model->getCondicaoRegraByRegra($reg->id_regra);
                    foreach ($analises as $cli) {
                     
                     $resultado = $cli->resultado;
                     if($resultado == 1){
                         $resul = "CONSISTENTE";
                     }else if($resultado == 0){
                         $resul = "INCONSISTENTE";
                     }
                     $valor1 = $this->AudCon_model->getOpcoesValorById($cli->valor_cliente);
                     $valor2 = $this->AudCon_model->getOpcoesValorById($cli->valor_base);
                ?>   
                
                <tr>
                 
                  <td style="width: 25%;"><?php echo $valor1->valor; ?></td>
                  <td style="width: 25%;"><?php echo $cli->condicao; ?></td>
                  <td style="width: 25%;"><?php echo $valor2->valor; ?></td>
                  <td style="width: 25%;"><?php echo $resul; ?></td>
                                             
                </tr>
                <?php
                }
                ?>
               
               
                
                </tbody>
                        
                      </table>
                      
                  </td>
                  <td style="width: 10%;"><a href="editar_regra/<?php echo $reg->id_regra; ?>"><i class="fa fa-edit"></i></a></td>
                   <td style="width: 10%;"><a href="inativa_regra/<?php echo $reg->id_regra; ?>"><i class="fa fa-close"></i></a></td>
                 
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  
                  <th style="width: 5%;">Regra</th>
                  <th style="width: 10%;">Descrição</th>
                  <th style="width: 10%;">Campo Cliente</th>
                  <th style="width: 5%;">Observação</th>
                  <th style="width: 50%;">
                      Condições de regras
                  </th>
                  <th style="width: 10%;">Editar</th>  
                  <th style="width: 10%;">Inativar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
      
      </div>
     

    </section>
    <!-- /.content -->
  </div>


<div class="modal fade" id="modal-insert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true"><i class="fa fa-2x">&times;</i>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Cadastrar Nova Regra'); ?></h4>
            </div>
           
            <div class="box-body">
                <div class="col-md-12">
                    <?php
                    $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
                    echo form_open_multipart("AudCon/add_nova_regra", $attrib);
                    ?>
                    <input name="id" type="hidden" value="<?php echo $id; ?>">
                    <div class="form-group person">
                        <?= lang("Numero da Regra : ", "name"); ?>
                        <?php echo form_input('numero', $regra, 'class="form-control tip" id="name"'); ?>
                    </div>
                    <div class="form-group person">
                        <?= lang("Regra : ", "name"); ?>
                        <?php echo form_input('descricao', $desc, 'class="form-control tip" id="name"'); ?>
                    </div>
                    <div class="form-group person">
                        <?= lang("Observação : ", "name"); ?>
                        <?php echo form_textarea('observacao', $obs, 'class="form-control tip" id="name"'); ?>
                    </div>
                    <div class="form-group company">
                            <?= lang("Relação coluna estrutura cliente", "company"); ?>
                        <div class="controls"> <?php
                            $clientes = $this->AudCon_model->getEstrutura();
                            $cgs[""]= "Selecione";
                            foreach ($clientes as $cli) {
                                $cgs[$cli->id] = $cli->nome;
                            }
                            echo form_dropdown('cliente', $cgs, $cliente, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                            ?>
                        </div>
                    </div>
                    
                 

                    <div class="modal-footer">
                    <?php echo form_submit('add_customer', lang('Atualizar'), 'class="btn btn-primary"'); ?>
                    </div>
                <?php echo form_close(); ?>

                </div>
              
            </div>
            
        </div>
<?php echo form_close(); ?>
        <!-- /.modal-content -->
    </div>
</div>
