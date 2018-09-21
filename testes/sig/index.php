<?php
//if (isset($_POST)) {
    
//include('conexao.php');

$connection = mysqli_connect(
    'localhost',
    'root',
    '',
    'sistemaprojetosunimed');

          $sql_qtde_registro = mysqli_query($connection, "CALL sp_qtde_reg_tabela_cliente(@total)");
          $reg               = mysqli_query($connection, "select @total");
          $quantidade_reg        = mysqli_fetch_array($reg);
          $quantidade_tota_regra =  $quantidade_reg[0].'<br>';
    
          echo $quantidade_tota_regra;
         
            /*
             * RETORNA OS DADOS DA TABELA DO CLIENTE
             */
         
         $sql = mysqli_query($connection, "CALL sp_colatina()");
        
          while ($row = mysqli_fetch_array($sql)){
               $row[0];
               $codigo_servico = $row[1];
               $quantidade = $row[2];
              
              
             
              //executa o store procedure
          //$result = mysqli_query($connection, "CALL sp_verifica_regra('$codigo_servico', '$quantidade')") or die("Erro na query da procedure: " . mysqli_error());

              
              echo ' CALL sp_verifica_regra('.$codigo_servico.' , '.$quantidade.' )  <br>';
              
          }   
          
          
          
/*


     $sql = "CALL sma_processa_regra()";
     $query =  mysqli_query($link, $sql);
    
    $quantidade = mysqli_fetch_array($link,$query);
    echo $quantidade[0];
 /*
    $arrayItems = $_POST['item'];
    print_r($arrayItems);
    $order = 0;


    /*
        foreach ($arrayItems as $item) {
            $sql = "UPDATE sma_risk_estrutura_regras_cliente SET posicao='$order' WHERE id='$item'";
            mysqli_query($link, $sql);
            $order++;
        }
     * 
     */

   // echo 'Salvo!';
    mysqli_close($connection);
//}
