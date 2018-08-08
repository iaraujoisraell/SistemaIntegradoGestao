<?php include 'conexao_oracle.php'; ?>
<?php include 'querys_tasy_oracle/query_saldo_estoque.php'; ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Saldo Estoque
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Saldo Estoque</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php
/*
 * SALDO DEVEDOR HMU
 */

    $saldo_estoque_hmu = oci_parse($ora_conexao,$query_saldo_estoque_hmu);
    oci_execute($saldo_estoque_hmu, OCI_NO_AUTO_COMMIT);

    // $emprestimo_entrada = array();
    $soma_qt_material = 0;
    $soma_custo_medio = 0;
    
        ?>
      <div class="box-footer">
           <h3>HMU</h3>
              <div class="row">
                  <?php
                  $cont = 1;
                   while (($row_sd_hmu = oci_fetch_array($saldo_estoque_hmu, OCI_BOTH)) != false)
                    {
                    $saldo = $row_sd_hmu[0];  
                    $cd_local_estoque = $row_sd_hmu[1];

                    if($cd_local_estoque == 93){
                        $ds_local = "ALMOXARIFADO";
                        $cor = "aqua";
                        $fa = "th";
                    }else if($cd_local_estoque == 69){
                        $ds_local = "NUTRIÇÃO";
                        $cor = "yellow";
                        $fa = "apple";
                    }else if($cd_local_estoque == 65){
                        $ds_local = "FARMÁCIA";
                        $cor = "green";
                        $fa = "plus-square";
                    }else if($cd_local_estoque == 157){
                        $ds_local = "HOTELARIA";
                        $cor = "red";
                        $fa = "h-square";
                    }
                    
                    ?>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-<?php echo $cor; ?>"><i class="fa fa-<?php echo $fa; ?>"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text"><?php echo $ds_local; ?></span>
                          <span class="info-box-number">R$ <?php echo number_format($saldo, 2, ',', '.');; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    
                
                <?php
                $cont++;
                   }
                  ?>     
                
              </div>
              <!-- /.row -->
            </div>
      <!-- /.row -->
      <!-- /.DIV EXIBE OS SALDOS DEVEDOR E A RECEBER MAIS DETALHADO -->
       
      <br>
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
           <div class="box box-success">
           <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#saida_hmu" data-toggle="tab">HMU</a></li>
            <!--  <li><a href="#saida_hupl" data-toggle="tab">HUPL</a></li>-->
              <li class="pull-left header"><i class="fa fa-inbox"></i> Saldo Estoque</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body chart-responsive tab-pane active" id="saida_hmu" style="position: relative; height: 300px;">
                  <div class="chart" id="saida_hmu" style="height: 300px;"></div>
              </div>
             <!--  <div class="box-body chart-responsive tab-pane " id="saida_hupl" style="position: relative; height: 300px;">
                  <div class="chart" id="saida_hupl" style="height: 300px;"></div>
              </div>-->
             
            </div>
          </div>
          </div>
          
          
          <?php
          
          ?>
         
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
         
          <!-- /.box (chat box) -->

         

        
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

           
            
          <!-- Map box -->
          
          <!-- /.box -->

        
          
          
         
          <!-- /.box -->

          <!-- Calendar -->
          
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

