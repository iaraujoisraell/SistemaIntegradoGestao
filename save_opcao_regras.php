<?php
if (isset($_POST)) {
    include('db_connection.php');

  
 
    $arrayItems = $_POST['item'];
    print_r($arrayItems);
    $order = 0;


        foreach ($arrayItems as $item) {
            $sql = "UPDATE sma_risk_opcoes_valor SET posicao='$order' WHERE id='$item'";
            mysqli_query($link, $sql);
            $order++;
        }

   // echo 'Salvo!';
    mysqli_close($link);
}


