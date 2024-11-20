<?php
session_start();
require("../../Conexion/base_de_datos.php");
//include("../base_de_datos.php");
if(!isset($_POST["total"])) exit;
if ($_SESSION["carrito"] == []) {
	header("Location: ./vender.php");
	exit;
}

$array=$_SESSION["cliente"];
print_r($_SESSION["cliente"]);

echo "<br>";
$id=array_column($array,'id_nombre');
//print_r($id);
echo $id[0];
echo "<br>";
$nombre=array_column($array,'nombre');
//print_r($nombre);
echo $nombre[0];
echo "<br>";
$rfc=array_column($array,'rfc');
//print_r($rfc);
$rfc[0];
echo "<br>";
$dir=array_column($array,'dir');
//print_r($dir);
echo "<br>";
$obs=array_column($array,'obs');
//print_r($obs);
echo $obs[0];
$direccion=$dir[0];
echo "<br>";
$clasif=array_column($array,'clasif');
//print_r($clasif);
echo $clasif[0];
echo "<br>";
$ruta=array_column($array,'ruta');
//print_r($clasif);
echo $ruta[0];
echo "<br>";
$tipo_pago=array_column($array,'tipo_pago');
//print_r($tipo_pago);
echo $tipo_pago[0];

if ($ruta[0]=="1") {
		$stock="stockRuta1";
}else if ($ruta[0]=="2") {
			$stock="stockRuta2";
}


$total = $_POST["total"];
$piezasTot = $_POST["piezasVen"];
$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT IGNORE INTO ventas(nombre, rfc, direccion, obs, fecha, piezasVen, pago, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
$sentencia->execute([$nombre[0], $rfc[0], $direccion, $obs[0], $ahora, $piezasTot, $tipo_pago[0], $total]);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, cantidad, precio, subtotal, id_venta) VALUES (?, ?, ?, ?, ?);");
//ejemplo
$sentenciaExistencia = $base_de_datos->prepare("UPDATE pastelesstock SET $stock = $stock + ? WHERE id_producto = ?");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id_producto, $producto->cantidad, $producto->p_menudeo, $producto->total, $idVenta]);
	//ejemplo
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id_producto]);
}
$base_de_datos->commit();

$sql = "SELECT * FROM ventas WHERE id='$idVenta'";
$query = $base_de_datos -> prepare($sql);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if ($query -> rowCount() > 0) {
	header("Location: ventas.php");
}else{
	header("Location: redireccionar.php");
}

?>
