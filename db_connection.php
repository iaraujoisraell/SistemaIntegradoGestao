<?php
$link = mysqli_connect(
    'localhost',
    'root',
    '',
    'sistemaprojetosunimed');
/*
 *  'sig32.mysql.uhserver.com',
    'iaraujo',
    'rando.2018',
    'sig32');
 */

if (!$link) {
    printf("Erro: %s\n", mysqli_connect_error());
    exit;
}