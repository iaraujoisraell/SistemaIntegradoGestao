<html>
  <head>
      <?php
        include './conexao.php';
        
        $query_pizza = "select distinct CD_PESSOA_JURIDICA,PJ.DS_RAZAO_SOCIAL, 
                  (select count(*) as emprestimo from emprestimo ep
                  where ep.cd_pessoa_juridica = e.cd_pessoa_juridica
                  and ep.dt_emprestimo between '01/06/2018' and '30/06/2018'
                  and ep.cd_local_estoque = 65
                  and ep.ie_tipo = 'E'
                  ) as quantidade_emprestimo,

                    (select sum(qt_emprestimo) as quantidade_emprestimo from emprestimo ep
                    inner join emprestimo_material em on em.nr_emprestimo = ep.nr_emprestimo
                    where ep.cd_pessoa_juridica = e.cd_pessoa_juridica
                    and ep.dt_emprestimo between '01/06/2018' and '30/06/2018'
                    and ep.cd_local_estoque = 65
                    and ep.ie_tipo = 'E'
                    ) as quantidade_material

                    from emprestimo e
                    inner join pessoa_juridica pj on pj.cd_cgc = e.cd_pessoa_juridica
                    where e.dt_emprestimo between '01/06/2018' and '30/06/2018'
                    and e.cd_local_estoque = 65
                    and e.ie_tipo = 'E'";
        $stid = oci_parse($ora_conexao,$query_pizza);
        oci_execute($stid, OCI_NO_AUTO_COMMIT);
        
      // $emprestimo_entrada = array();
        $total_emprestimo = 0;
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)
        {
        $cd_pj = $row[0];  
        $pj_desc = $row[1];
        $numero_emprestimo = $row[2];
        $qtde_itens = $row[3];
       
        $total_emprestimo = $numero_emprestimo;
        
        $emprestimo_entrada[] = array("empresa" => $pj_desc, "quantidade" => $qtde_itens );
       
        
        }
        echo '<br>';
     //   print_r($emprestimo_entrada);
        
      ?>
    
      
        
     
      
   
                                    
                                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                                google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
    
                                        function drawChart() {

                                            var data = google.visualization.arrayToDataTable([
                                            ['Hospital', 'Quantidade'],
                                                <?php
                                                foreach ($emprestimo_entrada as $pj_emp) {

                                                    $empresa = $pj_emp['empresa'];
                                                    $qtde_emprestada = $pj_emp['quantidade'];
                                                    ?>
                                                             ['<?php echo $empresa; ?>', <?php echo $qtde_emprestada; ?>],
                                                                                            
                                                    <?php
                                                }
                                                ?>
                             ]);
                                       var options = {
                                                title: 'ENTRADA DE EMRPESTIMO - HMU'
                                        };
    
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
                                        chart.draw(data, options);
                                        }
                                        </script>


                                        <div id="piechart" style="width: 100%; height: 100%;"></div>
                                   
    
    
    <?php 
    /*
     * GRÉFICO DE COLUNAS
     */
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Entrada', 'Saida', 'Profit'],
          ['<?php echo "Março"; ?>', 1000, 400, 200],
          ['<?php echo "Abril"; ?>', 1170, 460, 250],
          ['<?php echo "Maio"; ?>', 660, 1120, 300],
          ['<?php echo "Junho"; ?>', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    
    
  </head>
 
  
  
  
 
</html>
       
    <?php
        //include './conexao.php';
        
        $query = "select NR_EMPRESTIMO,CD_LOCAL_ESTOQUE,E.IE_TIPO,DT_EMPRESTIMO,CD_PESSOA_JURIDICA,PJ.DS_RAZAO_SOCIAL from emprestimo e
        inner join pessoa_juridica pj on pj.cd_cgc = e.cd_pessoa_juridica
        where e.dt_emprestimo between '01/06/2018' and '30/06/2018'
        and e.cd_local_estoque = 65
        and e.ie_tipo = 'E'";
      
        $stid = oci_parse($ora_conexao,$query);
        oci_execute($stid, OCI_NO_AUTO_COMMIT);
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)
        {
        $nr_emprestimo = $row[0];  
        $tipo = $row[2];
        $data_emp = $row[3];
        $cd_pj = $row[4];
        $pj_desc = $row[5];
        
       // echo $nr_emprestimo.'-'.$tipo.' '.$data_emp.' '.$cd_pj.'-'.$pj_desc.''.'<br>';
        }
    ?>
    
