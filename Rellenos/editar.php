<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../Conexion/base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM rellenos WHERE id = ?");
$sentencia->execute([$id]);
$relleno = $sentencia->fetch(PDO::FETCH_OBJ);
if($relleno === FALSE){
	echo "¡No existe algún relleno con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
	<div class="col-xs-12">
		<h1>Editar relleno de: <?php echo $relleno->nombreRelleno; ?></h1>
		<br>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $relleno->id; ?>">
			
			<label for="nombre">Descripcion del relleno:</label>
			<input name="nombre" class="form-control" value="<?php echo $relleno->nombreRelleno; ?>" required>

			<label for="precio">Precio:</label>
			<input value="<?php echo $relleno->precio; ?>" maxlength="5" class="form-control" onkeypress="return soloNumeros(event)" name="precio" required type="text" placeholder="Precio" required>

		  <br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./muestraRellenos.php">Cancelar</a>
		</form>
		<br>
	</div>
<?php include_once "pie.php" ?>
