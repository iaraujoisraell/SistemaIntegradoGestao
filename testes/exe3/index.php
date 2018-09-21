<html>
	<head>
		<title>Carregando</title>
		<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>
		<style>
		<!--
		#carregando {
			border: 2px solid #585858;
			background: #ffffff;
			font-size: 10px;
			font-family: verdana;
			position: absolute;
			margin: 20%;
			padding: 10px;
			text-align: center;
		}
		#img {
			display: none;
		}
		-->
		</style>
	</head>
	<body style="margin:0px;padding: 0px;">
		<div id="carregando"><img src="http://www.plugmasters.com.br/downloads/icones/banco-de-icones/ajax/progressbar_microsoft.gif"><br>Carregando...</div>
		<img src="http://shaidbraga.files.wordpress.com/2008/12/bxk13777_paisagem_1800.jpg" id="img">
		<script>
			window.onload=function(){
				$("#img").fadeIn("slow");
				$("#carregando").fadeOut("slow");
			}
		</script>
	</body>
</html>