<?php
//TRIGALES DE ORO
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Ventas TRIGALES DE ORO</title>
  <link rel="icon" type="image/png" href="../../logo 2016.png">
	<link rel="stylesheet" href="../css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../css/2.css">
	<link rel="stylesheet" href="../css/estilo.css">
	<script>
			 function soloNumeros(e){
					 key=e.keyCode || e.which;
					 teclado=String.fromCharCode(key);
					 numeros="1234567890";
					 especiales="8-37-38-46";//array
					 teclado_especial=false;

					 for(var i in especiales){
							 if(key==especiales[i]){
									 teclado_especial=true;
							 }
					 }

					 if(numeros.indexOf(teclado)==-1 && !teclado_especial){
							 return false;

					 }
			 }
		</script>
		<style >
				th{
					background: yellow;
				}
				.nav navbar-nav{
					background: green;
				}
		</style>

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">TRIGALES DE ORO</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="../listar.php">Elegir Cliente</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
