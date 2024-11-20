<?php
if(!isset($_GET["sku"])) exit();
$id = $_GET["sku"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM ventas WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./ventas.php");
	exit;
}
else echo "Algo salió mal";
?>
