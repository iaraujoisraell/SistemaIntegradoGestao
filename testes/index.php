<html>
<head>
<script type='text/javascript' src='http://code.jquery.com/jquery-1.5.1.min.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
// Executa o evento CLICK em todos os links do menu
$('#menu a').live('click',function(){
 // Faz o carregamento da página de acordo com o COD da página, que vai pegar os valores da página page.php.
 $('#conteudo').load($(this).attr('href'));
 return false;

});

});
</script>
</head>
<body>
<div id='menu'>
<ul>
<li><a href='page.php?cod=1'>Home</a></li>
<li><a href='page.php?cod=2'>Serviços</a></li>
</ul>
</div>
<!-- Aqui serão mostrados os conteúdos -->
<div id='conteudo'>

</div>
</body>
</html>