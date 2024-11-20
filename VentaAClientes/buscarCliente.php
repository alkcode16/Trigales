<?php
session_start();
unset($_SESSION["cliente"]);
$_SESSION["cliente"] = [];


if(!isset($_POST["nombre"])) return;
$nombre = addslashes($_POST["nombre"]);

//include_once "base_de_datos.php";
require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->prepare("SELECT * FROM clientes WHERE nombre= ? LIMIT 1");
$sentencia->execute([$nombre]);
$cliente = $sentencia->fetch(PDO::FETCH_OBJ);
//array_push($_SESSION["cliente"], $cliente);

if($cliente){

	$indice = false;
	for ($i=0; $i < count($_SESSION["cliente"]); $i++) {
		if($_SESSION["cliente"][$i]->id_nombre === $nombre){
			$indice = $i;

			break;
		}
	}

	array_push($_SESSION["cliente"], $cliente);

	if ($cliente->clasif=="1") {
				$va="./vender.php";
			//  echo $_SESSION['precio'];
		}else if ($cliente->clasif=="2") {
				$va="./vender.php";  //  echo $_SESSION['precio'];
		}else if ($cliente->clasif=="3") {
					$va="./vender.php";   //  echo $_SESSION['precio'];
		}else if ($cliente->clasif=="4") {
				 $va="./vender.php";    //  echo $_SESSION['precio'];
		}else if($cliente->clasif==NULL){

		}
		header("Location: ./elegir.php?status=2");

}else header("Location: ./elegir.php?status=1");
//header("Location: ./elegir.php");
?>
