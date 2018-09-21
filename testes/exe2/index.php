<?php require_once('conn.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>Carregamento dinâmico de registros</title>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

<style type="text/css">
body {
    font-family: Georgia, Arial, Verdana, Tahoma, sans-serif;
	font-size: 16px;
}

#frases em {
    color: #C57E38;
}

a {
    color: #005CB9;
    text-decoration: none;
}
</style>

<script type="text/javascript" language="javascript">
    $(function($) {
        // Quando clicando em "Mais frases"
        $("#mais").click(function() {
            // Recuperamos o ID da última frase selecionada
            var ultimo = $("#frases p:last").attr("lang");
            // Mensagem de carregando
            $("#status").html("<img src='image/loader.gif' alt='Enviando' />");
            // Faz requisição ajax e envia o ID da última frase via método POST
            $.post("ajax/buscar.php", {ultimo: ultimo}, function(resposta) {
               // Limpa a mensagem de carregamento
               $("#status").empty();
               // Coloca as frases na DIV
               $("#frases").append(resposta);
            });
        });
    });
</script>
</head>

<body>

<div id="frases">
    <?php
    // Selecionando as três últimas frases cadastradas
    $query = mysql_query("SELECT * FROM frases ORDER BY id DESC LIMIT 0,3");
    // Exibindo frases selecionadas
    while ($frase = mysql_fetch_object($query))
        echo "<p lang='{$frase->id}'>\"{$frase->texto}\" <br /> <em>{$frase->autor}</em></p>";
    ?>
</div>

<span id="status"></span> <a href="javascript:func()" id="mais">Mais frases »</a>

</body>
</html>