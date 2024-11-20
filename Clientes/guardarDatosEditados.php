<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["id"]) ||
	!isset($_POST["nombre"]) ||
	!isset($_POST["rfc"]) ||
	!isset($_POST["dir"]) ||
	!isset($_POST["obs"]) ||
	!isset($_POST["clasif"]) ||
	!isset($_POST["ruta"]) ||
	!isset($_POST["tipo_pago"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../Conexion/base_de_datos.php";
$id = $_POST["id"];
$nombre= $_POST["nombre"];
$rfc = $_POST["rfc"];
$dir = $_POST["dir"];
$obs = $_POST["obs"];
$clasif = $_POST["clasif"];
$ruta = $_POST["ruta"];
$tipo_pago = $_POST["tipo_pago"];


$sentencia = $base_de_datos->prepare("UPDATE clientes SET id_nombre = ?, nombre = ?, rfc = ?, dir = ?, obs = ?, clasif = ?, ruta = ?, tipo_pago = ? WHERE id_nombre = ?");
$resultado = $sentencia->execute([$id,$nombre, $rfc, $dir, $obs, $clasif, $ruta, $tipo_pago, $id]);
//$sentencia->execute();

if($resultado === TRUE){
	header("Location: ./muestraClientes.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>
