  <link rel="stylesheet" href="<?= $assets ?>bi/bower_components/morris.js/morris.css">
 

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<div class="wrapper">

  <!-- Left side column. contains the logo and sidebar -->
 <?php  $processos_analises = $this->AudCon_model->getProcessosAnalisesById($id); ?>
  
<?php $analises = $this->AudCon_model->getAnaliseById($processos_analises->analise); ?>
  
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard 
        <small>Resultado Análise</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
   
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Procedimentos Analisados</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->num_registros, 0, '', '.'); ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Proced. Discrepantes</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->procedimentos_discrepantes, 0, '', '.'); ?><small> (<?php echo substr(($processos_analises->procedimentos_discrepantes * 100)/$processos_analises->num_registros, 0, 5);  ?>%)</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-thumbs-o-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inconsistências</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->num_inconsistencias, 0, '', '.'); ?><small> (<?php echo substr(($processos_analises->num_inconsistencias * 100)/$processos_analises->num_registros, 0, 5);  ?>%)</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Valor Discrepante</span>
              <span class="info-box-number">R$ <?php echo number_format($processos_analises->valor_discrepante,2,",","."); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          
          
        <!-- /.col -->
        
        <!-- /.col -->
        
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Perído Analisado</span>
              <span class="info-box-number"><?php echo $processos_analises->periodo_analisado; ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa  fa-user-md"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Prestadores</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->prestadores, 0, '', '.'); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa  fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nro. Guias</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->num_guias, 0, '', '.'); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nro. Beneficiários</span>
              <span class="info-box-number"><?php echo number_format($processos_analises->num_beneficiarios, 0, '', '.'); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->
      <div>
          <a target="_blank" class="btn btn-block btn-warning" href="../resultado_processamentos/<?php echo $id; ?>" > VER LOG DE INCONSISTÊNCIA</a> 
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Valor pago Vs Valor discrepante por período</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong><?php echo $processos_analises->periodo_analisado; ?> </strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
             
             
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
           
            <!-- /.col -->
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Prestadores 10 +</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Código</th>
                    <th>Prestador</th>
                    <th>Inconsistências</th>
                    <th>Qtde/Regra</th>
                    <th>Valor</th>
                    <th>Detalhes</th>
                  </tr>
                  </thead>
                  <tbody>
                      
                        <?php
                  $cont = 0;    
                  $analises_prestadores = $this->AudCon_model->getPrestadoresAnaliseProcessosByProcessos($id);
                   foreach ($analises_prestadores as $prestadore_analise) {
                       
                       $cont++;
                       
                       if($cont == 1){
                           $cor = "#00a65a";
                       }else if($cont == 2){
                           $cor = "#f39c12";
                       }else if($cont == 3){
                           $cor = "#f56954";
                       }else if($cont == 4){
                        $cor = "#00c0ef";
                           
                           $cont = 0;
                       }
                       
                       

                   
                  ?>
                  <tr>
                    <td><a href="pages/examples/invoice.html"><?php echo $prestadore_analise->id_prestador ?></a></td>
                    <td><?php echo $prestadore_analise->prestador ?></td>
                    <td><?php echo $prestadore_analise->inconsistencias ?></td>
                    <td>
                      <div class="sparkbar" data-color="<?php echo $cor; ?>" data-height="20">190,280,490,170,261,383,63</div>
                    </td>
                    <td><span class="label label-danger">R$ <?php echo number_format($prestadore_analise->valor_discrepante,2,",",".") ?> </span></td>
                    <td><a class="btn btn-success">ABRIR</a></td>
                  </tr>
            <?php
            }
            ?>
                  
                 
            
                
              
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Visualizar todos prestadores</a>
            </div>
            <!-- /.box-footer -->
          </div>
            
            <!-- /.col -->
          
         
          <!-- /.box -->
         
          <!-- /.row -->
        </div>
        <!-- /.col -->
     
        <!-- Left col -->
            
        <!-- /.col -->

        <!-- REGRAS -->
        <div class="col-md-4">
            REGRAS COM INCONSISTÊNCIAS
          <?php
          $analises_regras = $this->AudCon_model->getRegrasAnaliseProcessosByProcessos($id);
           foreach ($analises_regras as $regra_analise) {
                $regra = $this->AudCon_model->getRegrasBySessao($regra_analise->id_regra);
                $regra_descricao = $regra->descricao;
                $regra_cor = $regra->cor;
                $regra_icon = $regra->icon;
          ?>
          <div class="info-box <?php echo $regra_cor; ?>">
            <span class="info-box-icon"><i class="<?php echo $regra_icon; ?>"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo $regra_descricao; ?> (<?php echo number_format($regra_analise->quantidade, 0, '', '.'); ?>)</span>
              <span class="info-box-number">R$ <?php echo number_format($regra_analise->valor_referente,2,",","."); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo substr($regra_analise->porcentagem, 0, 5); ?>%"></div>
              </div>
              <span class="progress-description"><?php echo substr($regra_analise->porcentagem, 0, 5); ?>%</span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
        <?php
           }
        ?>
         
     
  
         
        </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
      

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<script src="<?= $assets ?>bi/bower_components/raphael/raphael.min.js"></script>
<script src="<?= $assets ?>bi/bower_components/morris.js/morris.min.js"></script>
<!-- page script -->
<script>
    
    
    
  $(function () {
    "use strict";
// Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas);

  var salesChartData = {
      
   <?php  
    $periodos = $this->AudCon_model->getDistinctPeriodoAnalise($analises->tabela); 
    
    ?>            
              
    labels  : [
        <?php 
        foreach ($periodos as $periodo) {
            $p_ano = $periodo->ano;
            $p_mes = $periodo->mes;
        
        ?>
        '<?php echo $p_mes.'/'.$p_ano; ?>',
        <?php } ?>
    ],
    datasets: [
      {
        label               : 'Procedimentos',
        fillColor           : 'rgb(210, 214, 222)',
        strokeColor         : 'rgb(210, 214, 222)',
        pointColor          : 'rgb(210, 214, 222)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgb(220,220,220)',
        
        data                : [
            <?php 
            foreach ($periodos as $periodo) {
            $p_ano = $periodo->ano;
            $p_mes = $periodo->mes;
            
            $periodosAnos = $this->AudCon_model->getAnaliseByAnoMes($analises->tabela, $p_ano, $p_mes );     
            $valor = substr($periodosAnos->valor, 1);
            
            ?>
           
              <?php echo '"'.$valor.'"'; ?>,
    
            <?php 
            }
        ?>
        ]
      },
      {
        label               : 'Discrepante',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : 'red',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
                <?php 
            foreach ($periodos as $periodo) {
            $p_ano = $periodo->ano;
            $p_mes = $periodo->mes;
            
            $periodosAnos = $this->AudCon_model->getQuantidadeInconsistenciaByAnoMes($analises->tabela, $analises->tabela_log, $p_ano, $p_mes, $id );     
            $valor = substr($periodosAnos->valor2, 1);
            ?>
           
              <?php echo '"'.$valor.'"'; ?>,
    
            <?php 
            }
        ?>
            ]
      }
    ]
  };

  var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    // String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666, item2: 2666},
        {y: '2011 Q2', item1: 2778, item2: 2294},
        {y: '2011 Q3', item1: 4912, item2: 1969},
        {y: '2011 Q4', item1: 3767, item2: 3597},
        {y: '2012 Q1', item1: 6810, item2: 1914},
        {y: '2012 Q2', item1: 5670, item2: 4293},
        {y: '2012 Q3', item1: 4820, item2: 3795},
        {y: '2012 Q4', item1: 15073, item2: 5967},
        {y: '2013 Q1', item1: 10687, item2: 4460},
        {y: '2013 Q2', item1: 8432, item2: 5713}
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2'],
      labels: ['Item 1', 'Item 2'],
      lineColors: ['#a0d0e0', '#3c8dbc'],
      hideHover: 'auto'
    });

    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });

    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Download Sales", value: 12},
        {label: "In-Store Sales", value: 30},
        {label: "Mail-Order Sales", value: 20}
      ],
      hideHover: 'auto'
    });
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });
  });
</script>
<!-- jQuery 3 -->
<script src="<?= $assets ?>bi/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- Sparkline -->
<!-- jvectormap  -->
<script src="<?= $assets ?>bi/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= $assets ?>bi/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?= $assets ?>bi/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?= $assets ?>bi/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $assets ?>bi/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $assets ?>bi/dist/js/demo.js"></script>



</body>