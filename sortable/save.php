<?php
if (isset($_POST)) {
    include('db_connection.php');

 
    $arrayItems = $_POST['item'];
    $order = 0;


        foreach ($arrayItems as $item) {
            $sql = "UPDATE sortable SET position='$order' WHERE id='$item'";
            mysqli_query($link, $sql);
            $order++;
        }

    echo 'Сохранено!';
    mysqli_close($link);
}


