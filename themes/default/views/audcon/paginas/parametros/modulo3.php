<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabela SIP
        <small>ANS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">SIP</li>
      </ol>
    </section>

    <div class="div-ajax-carregamento-pagina">
        <div class="col-md-12">
          <div class="box box-danger box-solid">
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
          <div class="col-lg-2">
              <a class="btn btn-block btn-success" href="<?= site_url('AudCon/modulo3/todos'); ?>"><i class="fa  fa-retweet"></i> Todos</a>
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
                <tr style="background-color: firebrick; color: #ffffff;">
                  <th>Id Termo</th>
                  <th>ROL</th>
                  <th>Item Assist.</th>
                  <th>Grupos</th>
                  <th>Restrição Sexo</th>
                  <th>Restrição Idade Mín.</th>
                  <th>Restrição Idade Máx.</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                                            
                   $modulo3 = $this->AudCon_model->getModulo3($limite);
                    foreach ($modulo3 as $mod) {
                        
                        
                        
                    
                ?>   
                
                <tr>
                  <td><?php echo $mod->id_termo; ?></td>
                  <td><?php echo $mod->rol; ?></td>
                  <td><?php echo $mod->item_assistencial; ?></td>
                  <td><?php echo $mod->grupos; ?></td>
                  <td><?php echo $mod->restricao_sexo; ?></td>
                  <td><?php echo $mod->restricao_idade_min; ?></td>
                  <td><?php echo $mod->restricao_idade_max; ?></td>
                  
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id Termo</th>
                  <th>ROL</th>
                  <th>Item Assist.</th>
                  <th>Grupos</th>
                  <th>Restrição Sexo</th>
                  <th>Restrição Idade Mín.</th>
                  <th>Restrição Idade Máx.</th>
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
