<script src="<?= $assets ?>bi/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $assets ?>bi/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= $assets ?>bi/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= $assets ?>bi/bower_components/raphael/raphael.min.js"></script>
<script src="<?= $assets ?>bi/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= $assets ?>bi/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= $assets ?>bi/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= $assets ?>bi/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= $assets ?>bi/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= $assets ?>bi/bower_components/moment/min/moment.min.js"></script>
<script src="<?= $assets ?>bi/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= $assets ?>bi/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= $assets ?>bi/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= $assets ?>bi/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= $assets ?>bi/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $assets ?>bi/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $assets ?>bi/dist/js/pages/dashboard.js"></script>



<!-- DataTables -->
<script src="<?= $assets ?>bi/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= $assets ?>bi/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<?php include 'conexao_oracle.php'; ?>
 

<script>
  $(function () {
    "use strict";
    
     //BAR CHART - SAÍDA DE EMPRÉSTIMOS HMU
    var bar = new Morris.Bar({
      element: 'saida_hmu',
      resize: true,
      data: [
      <?php
      $periodo_de = '01/08/2017';
      $periodo_ate = '01/08/2018';
      
    $query_periodo = "select distinct(s.dt_mesano_referencia) from saldo_estoque s 
    where s.cd_estabelecimento = 1
    and S.DT_MESANO_REFERENCIA BETWEEN '$periodo_de' AND '$periodo_ate'";
    $periodo_saldo = oci_parse($ora_conexao,$query_periodo);
    oci_execute($periodo_saldo, OCI_NO_AUTO_COMMIT);


while (($row_periodo_se = oci_fetch_array($periodo_saldo, OCI_BOTH)) != false){
    $periodo = $row_periodo_se[0];    
    $primeira_parte = substr($periodo, 0, 6);   
    $segunda_parte = substr($periodo, 6);
    $periodo = $primeira_parte.'20'.$segunda_parte;
    
    $query_almoxarifado_saldo_periodo = "
       SELECT ROUND(SUM(S.VL_CUSTO_MEDIO * S.QT_ESTOQUE), 2) SALDO, S.CD_LOCAL_ESTOQUE,
       (SELECT L.DS_LOCAL_ESTOQUE
          FROM LOCAL_ESTOQUE L
         WHERE L.CD_LOCAL_ESTOQUE = S.CD_LOCAL_ESTOQUE
           AND L.CD_ESTABELECIMENTO = 1) LOCAL
              FROM SALDO_ESTOQUE S
             WHERE S.DT_MESANO_REFERENCIA = '$periodo'
               AND S.CD_ESTABELECIMENTO = 1
               AND S.CD_LOCAL_ESTOQUE = 93 -- ALMOXARIFADO
               AND S.CD_LOCAL_ESTOQUE IN
                   (SELECT L.CD_LOCAL_ESTOQUE
                      FROM LOCAL_ESTOQUE L
                     WHERE L.IE_SITUACAO = 'A'
                       AND L.CD_ESTABELECIMENTO = 1)
             GROUP BY S.CD_LOCAL_ESTOQUE";
    
    $query_nutricao_saldo_periodo = "
       SELECT ROUND(SUM(S.VL_CUSTO_MEDIO * S.QT_ESTOQUE), 2) SALDO, S.CD_LOCAL_ESTOQUE,
       (SELECT L.DS_LOCAL_ESTOQUE
          FROM LOCAL_ESTOQUE L
         WHERE L.CD_LOCAL_ESTOQUE = S.CD_LOCAL_ESTOQUE
           AND L.CD_ESTABELECIMENTO = 1) LOCAL
              FROM SALDO_ESTOQUE S
             WHERE S.DT_MESANO_REFERENCIA = '$periodo'
               AND S.CD_ESTABELECIMENTO = 1
               AND S.CD_LOCAL_ESTOQUE = 69 --NUTRIÇÃO
               AND S.CD_LOCAL_ESTOQUE IN
                   (SELECT L.CD_LOCAL_ESTOQUE
                      FROM LOCAL_ESTOQUE L
                     WHERE L.IE_SITUACAO = 'A'
                       AND L.CD_ESTABELECIMENTO = 1)
             GROUP BY S.CD_LOCAL_ESTOQUE";
    
    $query_hotelaria_saldo_periodo = "
       SELECT ROUND(SUM(S.VL_CUSTO_MEDIO * S.QT_ESTOQUE), 2) SALDO, S.CD_LOCAL_ESTOQUE,
       (SELECT L.DS_LOCAL_ESTOQUE
          FROM LOCAL_ESTOQUE L
         WHERE L.CD_LOCAL_ESTOQUE = S.CD_LOCAL_ESTOQUE
           AND L.CD_ESTABELECIMENTO = 1) LOCAL
              FROM SALDO_ESTOQUE S
             WHERE S.DT_MESANO_REFERENCIA = '$periodo'
               AND S.CD_ESTABELECIMENTO = 1
               AND S.CD_LOCAL_ESTOQUE = 157 -- HOTELARIA
               AND S.CD_LOCAL_ESTOQUE IN
                   (SELECT L.CD_LOCAL_ESTOQUE
                      FROM LOCAL_ESTOQUE L
                     WHERE L.IE_SITUACAO = 'A'
                       AND L.CD_ESTABELECIMENTO = 1)
             GROUP BY S.CD_LOCAL_ESTOQUE";
    
    $query_farmacia_saldo_periodo = "SELECT ROUND(SUM(S.VL_CUSTO_MEDIO * S.QT_ESTOQUE), 2) SALDO_FARMACIA, 65,
                   'HMU - Farmácia'
              FROM SALDO_ESTOQUE S
             WHERE S.DT_MESANO_REFERENCIA = '$periodo'
               AND S.CD_ESTABELECIMENTO = 1
               AND S.CD_LOCAL_ESTOQUE NOT IN (93,69,157)
               AND S.CD_LOCAL_ESTOQUE IN
       (SELECT L.CD_LOCAL_ESTOQUE
          FROM LOCAL_ESTOQUE L
         WHERE L.IE_SITUACAO = 'A'
           AND L.CD_ESTABELECIMENTO = 1)";
  
    /*
     * ALMOXARIFADO
     */
        $saldo_por_periodo = oci_parse($ora_conexao,$query_almoxarifado_saldo_periodo);
        oci_execute($saldo_por_periodo, OCI_NO_AUTO_COMMIT);
        $row_periodo_saldo = oci_fetch_array($saldo_por_periodo, OCI_BOTH);
        $saldo_almoxarifado2 = $row_periodo_saldo[0];  
        $saldo_almoxarifado2 = str_replace(',', '.', $saldo_almoxarifado2);
       
    /*
     * NUTRIÇÃO
     */
        $saldo_por_periodo_nutricao = oci_parse($ora_conexao,$query_nutricao_saldo_periodo);
        oci_execute($saldo_por_periodo_nutricao, OCI_NO_AUTO_COMMIT);
        $row_periodo_saldo_nutri = oci_fetch_array($saldo_por_periodo_nutricao, OCI_BOTH);
        $saldo_nutricao = $row_periodo_saldo_nutri[0];  
        $saldo_nutricao = str_replace(',', '.', $saldo_nutricao);   
     
    /*
     * HOTELARIA
     */
        $saldo_por_periodo_hotelaria= oci_parse($ora_conexao,$query_hotelaria_saldo_periodo);
        oci_execute($saldo_por_periodo_hotelaria, OCI_NO_AUTO_COMMIT);
        $row_periodo_saldo_hotelaria = oci_fetch_array($saldo_por_periodo_hotelaria, OCI_BOTH);
        $saldo_hotelaria = $row_periodo_saldo_hotelaria[0];  
        $saldo_hotelaria = str_replace(',', '.', $saldo_hotelaria);    
        if($saldo_hotelaria == null){
            $saldo_hotelaria = 0;
        }
        
    /*
     * FARMÁCIA
     */
        $saldo_por_periodo_farmacia = oci_parse($ora_conexao,$query_farmacia_saldo_periodo);
        oci_execute($saldo_por_periodo_farmacia, OCI_NO_AUTO_COMMIT);
        $row_periodo_saldo_farmacia = oci_fetch_array($saldo_por_periodo_farmacia, OCI_BOTH);
        $saldo_farmacia = $row_periodo_saldo_farmacia[0];  
        $saldo_farmacia = str_replace(',', '.', $saldo_farmacia);       
        
    
  ?>     
    {y: '<?php echo $periodo; ?>', a: <?php echo $saldo_almoxarifado2; ?>, b: <?php echo $saldo_nutricao; ?>, c: <?php echo $saldo_hotelaria; ?>, d: <?php echo $saldo_farmacia; ?>},
 <?php   
}
?>
      ],
      barColors: ['#00BFFF', 'orange', 'red', 'green'],
      xkey: 'y',
      ykeys: ['a', 'b', 'c', 'd'],
      labels: ['Almoxarifado', 'Nutrição', 'Hotelaria', 'Farmácia'],
      hideHover: 'auto'
    });
    
  });
</script>

<?php 

?>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>