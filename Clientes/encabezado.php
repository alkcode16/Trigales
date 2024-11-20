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
	echo '<center><a href="../index.php">Iniciar sesión</a></center>';
	die();
	//require_once("../Conexion/autorizacion.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Editar TRIGALES DE ORO</title>
	<link rel="icon" type="image/png" href="../../logo 2016.png">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">

	<?php include("../funciones/funciones.php"); ?>

	<style>
		th {
			background: yellow;
		}

		.nav navbar-nav {
			background: green;
		}
	</style>

</head>

<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">TRIGALES DE ORO</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">