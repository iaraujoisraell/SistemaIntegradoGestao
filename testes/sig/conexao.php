<?php

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sistemaprojetosunimed';
// Conecta-se ao banco de dados MySQL
$connection = new mysqli($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error())

?>