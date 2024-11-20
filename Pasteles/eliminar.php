<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../Conexion/base_de_datos.php";

$sentencia = $base_de_datos->prepare("DELETE FROM pasteles WHERE id_producto=?");
$sentencia->execute([$id]);

header("Location: muestraPasteles.php");


?>