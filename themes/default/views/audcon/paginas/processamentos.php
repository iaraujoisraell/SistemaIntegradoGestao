<style>
    #blanket,#aguarde {
    position: fixed;
    display: none;
}

#blanket {
    left: 0;
    top: 0;
    background-color: #f0f0f0;
    filter: alpha(opacity =         65);
    height: 100%;
    width: 100%;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
    opacity: 0.65;
    z-index: 9998;
}

#aguarde {
    width: auto;
    height: 30px;
    top: 40%;
    left: 45%;
    background: url('http://i.imgur.com/SpJvla7.gif') no-repeat 0 50%; 
    line-height: 30px;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    z-index: 9999;
    padding-left: 27px;
}
</style> 
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
    <div id="blanket"></div>
                    <div id="aguarde">Aguarde...Processamento em Andamento</div>
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
      <br><br>
      <?php $analises = $this->AudCon_model->getAnaliseById($id); ?>
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
      <Br><br>
      <div class="row">
          <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
                        echo form_open_multipart("ProcessaAnalise/add_novo_processamento", $attrib); ?>
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="col-lg-12">
                      <div class="box box-primary">
                    <div class="box-header">
                      <i class="ion ion-clipboard"></i>

                      <h3 class="box-title">Selecione as regras que serão aplicadas nesta análise</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                      <ul class="todo-list">
                          <?php
                          $regras_analise = $this->AudCon_model->getProcessamentoRegraByAnalise($id);
                           // print_r($regras_analise);
                             foreach ($regras_analise as $regAnalise) {
                                $cgs_ra[$regAnalise->id_regra] = $regAnalise->id_regra;
                            //}
                          ?>
                            <li>
                          <!-- drag handle -->
                          <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                              </span>
                          <!-- checkbox -->
                          <input type="checkbox" checked="1" name="regras[]" value="<?php echo $regAnalise->id; ?>">
                          <!-- todo text -->
                          <span class="text"><?php echo $regAnalise->regra.' - '.$regAnalise->descricao; ?></span>
                          <!-- Emphasis label -->

                          <!-- General tools such as edit or delete-->

                        </li>
                        <?php
                        }
                        ?>

                      </ul>
                    </div>

                  </div>
                  </div>
                   
                    <div class="modal-footer">
                        <?php echo form_submit('add_customer', lang('PROCESSAR ANÁLISE'), 'class="btn btn-danger btn-lg" onclick="alertas();"'); ?>
                    </div>
              
            
                 
          </div>
      
        <div class="row">
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Processamentos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Data</th>
                  <th>No.Reg. Analisados</th>
                  <th>Qtde Inconsistências</th>
                  <th>Regras Analisadas</th>
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $analises_processos = $this->AudCon_model->getProcessosAnalises($id);
                    foreach ($analises_processos as $pro) {
                ?>   
                
                <tr>
                  <td><?php echo $cont++; ?></td>  
                  <td><?php echo $this->sma->hrld($pro->dt_processo); ?></td>
                  <td><?php echo $pro->num_registros; ?></td>
                  <td><?php echo $pro->num_inconsistencias; ?></td>
                  <td>
                      <?php $regras_processos = $this->AudCon_model->getRegrasProcessosAnalises($pro->id); 
                      foreach ($regras_processos as $regra) {
                      ?>
                      <table>
                          <tr>
                              <td><?php echo $regra->regras; ?></td>
                          </tr>
                      </table>
                      <?php } ?>
                  </td>
                  
                  <td> <a class="btn btn-block btn-success" href="../resultado_processamentos/<?php echo $pro->id; ?>" > VER</a> </td>
                                          
                </tr>
                <?php
                }
                ?>
               
               
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Data</th>
                  <th>No.Reg. Analisados</th>
                  <th>Qtde Inconsistências</th>
                  <th>Regras Analisadas</th>
                  <th>Opções</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        
              
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
<script>
     function alertas(){
         
    
    document.getElementById('blanket').style.display = 'block';
    document.getElementById('aguarde').style.display = 'block';
   
    
    }
    </script>
