
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
     
      <div class="row">
          <div class="col-lg-3">
              <a class="btn btn-block btn-success" href="<?= site_url('AudCon/modulo1/todos'); ?>" ><i class="fa  fa-retweet"></i>Carregar Todos Cadastros</a>
          </div>
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
           
            <div class="table-responsive">
                
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Módulo</th>  
                  <th>Mod. Nome</th>
                  <th>Regra</th>
                  <th>Descrição</th>
                  <th>Observação</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                                                
                   $regras = $this->AudCon_model->getRegrasModulo();
                    foreach ($regras as $reg) {
                ?>   
                
                <tr>
                  <td><?php echo $reg->id_mod; ?></td>  
                  <td><?php echo $reg->modulo; ?></td>
                  <td><?php echo $reg->sessao; ?></td>
                  <td><?php echo $reg->regra; ?></td>
                  <td><?php echo $reg->observacao; ?></td>
                  
                 
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Módulo</th>  
                  <th>Mod. Nome</th>
                  <th>Regra</th>
                  <th>Descrição</th>
                  <th>Observação</th>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        

        


        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
