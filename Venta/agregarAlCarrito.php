<?php
if(!isset($_POST["codigo"]) || !isset($_POST["cantidad"]) || !isset($_POST["aceptar"])) return;
$codigo = addslashes($_POST["codigo"]);
$cantidad= $_POST["cantidad"];
$texto=addslashes($_POST["texto"]);
$relleno=$_POST['relleno'];
$barquillos=$_POST['barquillo'];


if ($cantidad==0) {
		$cantidad=1;
}

require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->prepare("SELECT id_producto,pastel,p_menudeo FROM pasteles WHERE pastel= ? LIMIT 1");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto){

	session_start();
	$indice = false;
	for ($i=0; $i < count($_SESSION["carrito"]); $i++) {
		if($_SESSION["carrito"][$i]->id_producto === $codigo){
			$indice = $i;
			break;
		}
	}
	if($indice === FALSE){
		$producto->cantidad = $cantidad;
		//agregar por si natcasesort
			if ($texto!="") {
				$producto->pastel=	$producto->pastel.' "'.$texto.'"';
			}

			//AGREGAMOS LOS RELLENOS PRIMERO
			//AGREGAMOS LOS RELLENOS PRIMERO

			$sentencia2=$base_de_datos->prepare("SELECT * FROM rellenos WHERE id='$relleno'");
			$sentencia2->execute();
			$rellenoValor= $sentencia2->fetch(PDO::FETCH_OBJ);
		
		
		
					//El relleno con la base de datos
						if($relleno==0){
							$producto->p_menudeo= $producto->p_menudeo;
		
						}else{
							$producto->p_menudeo = $producto->p_menudeo+$rellenoValor->precio;
							if($relleno == 4 || $relleno == 5){
								$producto->pastel=	$producto->pastel." ".$rellenoValor->nombreRelleno;
							}else{
								$producto->pastel=	$producto->pastel." RELLENO DE ".$rellenoValor->nombreRelleno;
							}
		
						}
		
				switch ($barquillos) {
						case 'Sin barquillos':
								$producto->p_menudeo= $producto->p_menudeo;
							break;
							case '13':
								$producto->p_menudeo= $producto->p_menudeo+5;
								$producto->pastel=	$producto->pastel." CON 13 BARQ.";
								break;
							case '14':
								$producto->p_menudeo= $producto->p_menudeo+10;
								$producto->pastel=	$producto->pastel." CON 14 BARQ.";
								break;

						default:
							$producto->p_menudeo= $producto->p_menudeo;
							break;
					}



		$producto->total = $producto->p_menudeo * $cantidad;
		array_push($_SESSION["carrito"], $producto);
	}else{
		//stock
		$_SESSION["carrito"][$indice]->cantidad++;
		$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->$cantidad * $_SESSION["carrito"][$indice]->p_menudeo;
	}
	header("Location: ./vender.php");
}else header("Location: ./vender.php?status=4");

?>
