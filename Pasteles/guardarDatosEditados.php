<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["id_producto"]) ||
	!isset($_POST["pastel"]) ||
	!isset($_POST["linea"]) ||
	!isset($_POST["p_mayoreo"]) ||
	!isset($_POST["p_medio"]) ||
	!isset($_POST["p_eventual"]) ||
	!isset($_POST["p_temporada"]) ||
	!isset($_POST["p_menudeo"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "../Conexion/base_de_datos.php";
//include("../Conexion/conexion.php");
$id_producto = $_POST['id_producto'];
$pastel= $_POST['pastel'];
$linea = $_POST['linea'];
$p_mayoreo = $_POST['p_mayoreo'];
$p_medio = $_POST['p_medio'];
$p_eventual = $_POST['p_eventual'];
$p_temporada = $_POST['p_temporada'];
$p_menudeo = $_POST['p_menudeo'];

$sentencia = $base_de_datos->prepare("UPDATE pasteles SET pastel = ?, linea = ?, p_mayoreo = ?, p_medio = ?, p_eventual = ?, p_temporada= ?, p_menudeo = ? WHERE id_producto = ?");
$sentencia2=$base_de_datos->prepare("UPDATE pastelesstock SET pastel = ? WHERE id_producto=?;");
$resultado = $sentencia->execute([$pastel, $linea, $p_mayoreo, $p_medio, $p_eventual, $p_temporada, $p_menudeo, $id_producto]);
$resultado2=$sentencia2->execute([$pastel,$id_producto]);
if ($resultado===TRUE) {
		echo "exito";
		header("Location: ./muestraPasteles.php");
		//$conexion->close();
}else {
	?>
	<script type="text/javascript">
			alert("Error al actualizar datos");
	</script>

<?php

}

?>
