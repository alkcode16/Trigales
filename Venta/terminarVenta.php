<?php
if(!isset($_POST["total"]) || !isset($_POST["cliente"]) || !isset($_POST["rfc"]) || !isset($_POST["dir"])) exit;

session_start();

if ($_SESSION["carrito"] == []) {
	header("Location: ./vender.php");
	exit;
}

$total =addslashes($_POST["total"]);
$piezasTot = addslashes($_POST["piezasVen"]);
$cliente=addslashes($_POST['cliente']);
$rfc=addslashes($_POST['rfc']);
$direccion=addslashes($_POST['dir']);
$obs=addslashes($_POST['obs']);
$tipo_pago=addslashes($_POST['pago']);
//$vendedor=$_POST['ven'];
require("../Conexion/base_de_datos.php");

$ahora =substr(date("Y-m-d H:i:s"),0,-9);


$sentencia = $base_de_datos->prepare("INSERT INTO ventas(nombre, rfc, direccion, obs, fecha, piezasVen, pago, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
$sentencia->execute([$cliente, $rfc, $direccion, $obs, $ahora, $piezasTot, $tipo_pago, $total]);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, cantidad, precio, subtotal, id_venta) VALUES (?, ?, ?, ?, ?);");
//$sentenciaExistencia = $base_de_datos->prepare("UPDATE articulos SET Stock = Stock - ? WHERE Sku = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;

	$sentencia->execute([$producto->id_producto, $producto->cantidad, $producto->p_menudeo, $producto->total, $idVenta]);
	//$sentenciaExistencia->execute([$producto->cantidad, $producto->Sku]);
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
