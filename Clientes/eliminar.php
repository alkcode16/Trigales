<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../Conexion/base_de_datos.php";

$sentencia = $base_de_datos->prepare("DELETE FROM clientes WHERE id_nombre=?");
$sentencia->execute([$id]);

header("Location: muestraClientes.php");

// if($sentencia === TRUE){

//     // echo "<h1>El usuario se elimino correctamente</h1>";
//     // echo '<center><a href="./muestraClientes.php">Volver a la lista de clientes </a><center>';
//     header("Location: muestraClientes.php");

// }else{
//     //  echo "Hola";
//      header("Location: muestraClientes.php");
// }

?>