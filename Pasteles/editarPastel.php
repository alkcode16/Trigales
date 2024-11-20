<?php
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../Conexion/conexion.php";
$sql = "SELECT * FROM pasteles WHERE id_producto='$id'";
$resultado = $conexion->query($sql);


?>
<?php include_once "encabezado.php" ?>
<div class="mt-5">

	<?php while ($row = mysqli_fetch_array($resultado)) { ?>

		<h1>Editar pastel: <?php $row['pastel'] ?></h1>
		<br>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id_producto" value="<?php echo $row['id_producto'] ?>">

			<label for="descripcion">Nombre del Pastel:</label>
			<input required name="pastel" type="text" cols="30" rows="5" class="form-control" value="<?php echo $row['pastel'] ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

			<label for="codigo">Linea:</label>
			<input type="text" name="linea" value="<?php echo $row['linea'] ?>" class="form-control" required placeholder="Linea" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

			<label for="existencia">Precio de Mayoreo:</label>
			<input type="text" name="p_mayoreo" value="<?php echo $row['p_mayoreo'] ?>" class="form-control" required placeholder="Precio Mayoreo" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

			<label for="precioVenta">Precio Medio:</label>
			<input type="text" name="p_medio" value="<?php echo $row['p_medio'] ?>" class="form-control" required placeholder="Precio Medio" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

			<label for="precioCompra">Precio Eventual:</label>
			<input type="text" name="p_eventual" value="<?php echo $row['p_eventual'] ?>" class="form-control" onkeypress="return soloNumeros(event)" required placeholder="Precio Eventual">

			<label for="precioCompra">Precio Temporada:</label>
			<input type="text" name="p_temporada" value="<?php echo $row['p_temporada'] ?>" class="form-control" onkeypress="return soloNumeros(event)" required placeholder="Precio de Temporada">

			<label for="precioCompra">Precio Menudeo:</label>
			<input type="text" name="p_menudeo" value="<?php echo $row['p_menudeo'] ?>" class="form-control" onkeypress="return soloNumeros(event)" required placeholder="Precio Menudeo">
		<?php } ?>
		<br><br><input class="btn btn-primary" type="submit" value="Guardar">
		<a class="btn btn-danger" href="./muestraPasteles.php">Cancelar</a>
		</form>
		<br>
</div>
<?php include_once "pie.php" ?>