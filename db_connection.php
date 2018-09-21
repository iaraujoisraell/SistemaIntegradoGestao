<?php
$link = mysqli_connect(
        /*
    'sig32.mysql.uhserver.com',
    'iaraujo',
    'rando.2018',
    'sig32');
         * 
         */
'localhost',
    'root',
    '',
    'sistemaprojetosunimed');
if (!$link) {
    printf("Erro: %s\n", mysqli_connect_error());
    exit;
}