<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Coberturas Contratuais
        <small>Vs Plano Regulamentado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tabelas</li>
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
              <a class="btn btn-block btn-success" href="<?= site_url('AudCon/modulo2/todos'); ?>"><i class="fa  fa-retweet"></i> Todos</a>
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
                  <th>Relação</th>
                  <th>Rol</th>
                  <th>Subgrupo</th>
                  <th>Grupo</th>
                  <th>Capitulo</th>
                  <th>OD.</th>
                  <th>AMB.</th>
                  <th>HCO</th>
                  <th>HSO</th>
                  <th>PAC</th>
                  <th>DUT</th>
                  <th>Nro.</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                                
                   $modulo2 = $this->AudCon_model->getModulo2($limite);
                    foreach ($modulo2 as $mod) {
                        
                        
                        
                    
                ?>   
                
                <tr>
                  <td><?php echo $mod->id_termo; ?></td>
                  <td><?php echo $mod->correlacao; ?></td>
                  <td><?php echo $mod->rol; ?></td>
                  <td><?php echo $mod->subgrupo; ?></td>
                  <td><?php echo $mod->grupo; ?></td>
                  <td><?php echo $mod->capitulo; ?></td>
                  <td><?php echo $mod->od; ?></td>
                  <td><?php echo $mod->amb; ?></td>
                  <td><?php echo $mod->hco; ?></td>
                  <td><?php echo $mod->hso; ?></td>
                  <td><?php echo $mod->pac; ?></td>
                  <td><?php echo $mod->dut; ?></td>
                  <td><?php echo $mod->dut_numero; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id Termo</th>
                  <th>Relação</th>
                  <th>Rol</th>
                  <th>Subgrupo</th>
                  <th>Grupo</th>
                  <th>Capitulo</th>
                  <th>OD.</th>
                  <th>AMB.</th>
                  <th>HCO</th>
                  <th>HSO</th>
                  <th>PAC</th>
                  <th>DUT</th>
                  <th>Nro.</th>
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
