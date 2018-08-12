<?php
$link = mysqli_connect(
    'localhost',
    'root',
    '',
    'sistemaprojetosunimed');

if (!$link) {
    printf("Erro: %s\n", mysqli_connect_error());
    exit;
}