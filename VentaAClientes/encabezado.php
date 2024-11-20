<?php
//TRIGALES DE ORO
session_start();
error_reporting(0);
if ($_SESSION['user'] == null || $_SESSION['user'] == '') {
	echo '<br>';
	echo '<br>';
	echo '<center> Usted no tiene autorización </center>';
	echo '<br>';
	echo '<br>';
	echo '<center> Inicie sesión de forma correcta </center>';
	echo '<br>';
	echo '<br>';
	echo '<center><a href="../../index.php">Iniciar sesión</a></center>';
	die();
	//require_once("../Conexion/autorizacion.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Ventas TRIGALES DE ORO</title>
	<link rel="icon" type="image/png" href="../logo 2016.png">
	<!-- <link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/2.css">
	<link rel="stylesheet" href="./css/estilo.css"> -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

	<script>
		function soloNumeros(e) {
			key = e.keyCode || e.which;
			teclado = String.fromCharCode(key);
			numeros = "1234567890";
			especiales = "8-37-38-46"; //array
			teclado_especial = false;

			for (var i in especiales) {
				if (key == especiales[i]) {
					teclado_especial = true;
				}
			}

			if (numeros.indexOf(teclado) == -1 && !teclado_especial) {
				return false;

			}
		}
	</script>

	<style>
		th {
			background: yellow;
		}

		.nav navbar-nav {
			background: green;
		}
	</style>

</head>
	<?php include("../funciones/funciones.php"); ?>
<body>
	<nav class="navbar navbar-dark bg-success">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">TRIGALES DE ORO®</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="./listar.php">Productos</a></li>
					<li><a href="venderMa/vender.php">Vender</a></li>
					<li><a href="./ventas.php">Ventas</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container mt-3">
		<div class="row">