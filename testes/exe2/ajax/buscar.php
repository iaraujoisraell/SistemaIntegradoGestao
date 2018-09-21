<?php
// Conexão
require_once('../conn.php');

// Recuperando informações
$ultimo = (int) $_POST['ultimo'];

// Selecionando mais três frases, a partir da última
$query = mysql_query("SELECT * FROM frases WHERE id < {$ultimo} ORDER BY id DESC LIMIT 0,3");

// Retornando frases
while ($frase = mysql_fetch_object($query))
    echo "<p lang='{$frase->id}'>\"{$frase->texto}\" <br /> <em>{$frase->autor}</em></p>";
?>