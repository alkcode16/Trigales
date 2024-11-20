<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["id"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["precio"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../Conexion/base_de_datos.php";
$id = $_POST["id"];
$nombre= $_POST["nombre"];
$precio = $_POST["precio"];

$sentencia = $base_de_datos->prepare("UPDATE rellenos SET nombreRelleno = ?, precio = ? WHERE id = ?");
$resultado = $sentencia->execute([$nombre, $precio, $id]);
//nueva liena
//$resultado->closeCursor();

if($resultado === TRUE){
	header("Location: ./muestraRellenos.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>
