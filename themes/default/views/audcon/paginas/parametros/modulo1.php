
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabelas
        <small>TUSS</small>
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
              <a class="btn btn-block btn-success" href="<?= site_url('AudCon/modulo1/todos'); ?>" ><i class="fa  fa-retweet"></i> Todos </a>
          </div>
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela TUSS De/Para</h3>
            </div>
            <!-- /.box-header -->
           
            <div class="table-responsive">
                
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: firebrick; color: #ffffff;">
                  <th>Id Termo</th>
                  <th>Dt Inicio</th>
                  <th>Dt Implantação</th>
                 
                  <th>Cod. CBHPM 2010</th>
                  <th>Cod. CBHPM 5a.</th>
                  <th>Cod. CBHPM 4a.</th>
                  <th>Cod. CBHPM 3a.</th>
                  <th>Cod. LPM 1999.</th>
                  <th>Cod. LPM 1996</th>
                  <th>Cod. AMP 92</th>
                  <th>Cod. AMP 90</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                                
                   $modulo1 = $this->AudCon_model->getModulo1($limite);
                    foreach ($modulo1 as $mod) {
                ?>   
                
                <tr>
                  <td><?php echo $mod->id_termo; ?></td>
                  <td><?php echo $mod->dt_inicio_vigencia; ?></td>
                  <td><?php echo $mod->dt_fim_implantacao; ?></td>
                 
                  <td><?php echo $mod->cmhpm_2010; ?></td>
                  <td><?php echo $mod->cbhpm_5; ?></td>
                  <td><?php echo $mod->cbhpm_4; ?></td>
                  <td><?php echo $mod->cbhpm_3; ?></td>
                  
                  <td><?php echo $mod->lpm_1999; ?></td>
                  <td><?php echo $mod->lpm_1996; ?></td>
                  <td><?php echo $mod->amp_92; ?></td>
                  <td><?php echo $mod->amp_90; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id Termo</th>
                  <th>Dt Inicio</th>
                  <th>Dt Implantação</th>
                 
                  <th>Cod. CBHPM 2010</th>
                  <th>Cod. CBHPM 5a.</th>
                  <th>Cod. CBHPM 4a.</th>
                  <th>Cod. CBHPM 3a.</th>
                  <th>Cod. LPM 1999.</th>
                  <th>Cod. LPM 1996</th>
                  <th>Cod. AMP 92</th>
                  <th>Cod. AMP 90</th>
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
