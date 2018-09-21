<?php
// Informações para conexão
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistemaprojetosunimed";
// Realizando conexão e selecioando banco de dados
$conn = mysql_connect($host, $usuario, $senha) or die(mysql_error());
$db = mysql_select_db($banco, $conn) or die(mysql_error());
// Definindo o charset como utf8 para evitar problemas com acentuação
$charset = mysql_set_charset("utf8");
?>