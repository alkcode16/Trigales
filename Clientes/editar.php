<?php
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../Conexion/base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM clientes WHERE id_nombre = ?");
$sentencia->execute([$id]);
$cliente = $sentencia->fetch(PDO::FETCH_OBJ);
if ($cliente === FALSE) {
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>

<div class="container mt-5">
	<h1>Editar cliente: <?php echo $cliente->nombre; ?></h1>
	<div class="mt-5">
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $cliente->id_nombre; ?>">

			<label for="descripcion">Nombre del Cliente:</label>
			<input required name="nombre" cols="30" rows="5" class="form-control" value="<?php echo $cliente->nombre; ?>">

			<label for="codigo">RFC:</label>
			<input value="<?php echo $cliente->rfc; ?>" class="form-control" name="rfc" required type="text" placeholder="RFC del cliente">

			<label for="existencia">Dirección:</label>
			<input value="<?php echo $cliente->dir; ?>" class="form-control" name="dir" required type="text" placeholder="Dirección">

			<label for="precioVenta">Observaciones:</label>
			<input value="<?php echo $cliente->obs; ?>" class="form-control" name="obs" type="text" placeholder="Observaciones">

			<label for="precioCompra">Clasificación:</label>
			<input value="<?php echo $cliente->clasif; ?>" class="form-control" onkeypress="return soloNumeros(event)" name="clasif" required type="text" placeholder="Clasificación">

			<label for="precioCompra">Ruta:</label>
			<input value="<?php echo $cliente->ruta; ?>" class="form-control" onkeypress="return soloNumeros(event)" name="ruta" required type="text" placeholder="Ruta">

			<label for="precioCompra">Tipo de Pago:</label>
			<input value="<?php echo $cliente->tipo_pago; ?>" class="form-control" onkeypress="return soloNumeros(event)" name="tipo_pago" required type="text" placeholder="Tipo de pago">

			<br><br><input class="btn btn-primary" type="submit" value="Guardar">
			<a class="btn btn-danger" href="./muestraClientes.php">Cancelar</a>
		</form>
	</div>
</div>
<?php include_once "pie.php" ?>