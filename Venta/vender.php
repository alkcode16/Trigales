<?php

include_once "encabezado.php";
require("../Conexion/base_de_datos.php");
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
$piezasVen = 0;
?>
<script type="text/javascript">
	window.onload = function Salida() {
		setTimeout('ejecutar()', hora());

	}

	function hora() {
		horaActual = new Date();
		horaProgramada = new Date();
		horaProgramada.setHours(23);
		horaProgramada.setMinutes(55);
		horaProgramada.setSeconds(0);
		return horaProgramada.getTime() - horaActual.getTime();

	}

	function ejecutar() {
		hora();
		if (hora() == 0) {
			window.location = ("../Salida/salidaReporte.php");
			//alert('que pedo prro');
		} else {

		}
	}
</script>

<div class="col-xs-12">
	<h1>Vender "TRIGALES DE ORO"</h1>
	Bienvenido "<?php echo   $_SESSION['user']; ?>"
	<br>
	<?php
	if (isset($_GET["status"])) {
		if ($_GET["status"] === "1") {
	?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong> Venta realizada correctamente
			</div>
		<?php
		} else if ($_GET["status"] === "2") {
		?>
			<div class="alert alert-info">
				<strong>Venta cancelada</strong>
			</div>
		<?php
		} else if ($_GET["status"] === "3") {
		?>
			<div class="alert alert-info">
				<strong>Ok!</strong> Producto quitado de la lista
			</div>
		<?php
		} else if ($_GET["status"] === "4") {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> El producto que buscas no existe
			</div>
		<?php
		} else if ($_GET["status"] === "5") {
		?>
			<div class="alert alert-danger">
				<strong>Error: </strong>El producto está agotado
			</div>
		<?php
		} else {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
			</div>
	<?php
		}
	}
	?>
	<br>


	<form method="post" action="agregarAlCarrito.php">
		<div class="nombre-pastel mb-4">
			<label for="codigo">Ingrese el Nombre del Pastel:</label>
			<input autocomplete="on" autofocus class="form-control mt-2" name="codigo" required type="text" id="codigo" placeholder="Escribe el Nombre de Producto" class='pastel' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
		<div class="opciones">
			<div class="row">
				<div class="col-lg-2 mt-2">
					<input type="text" name="cantidad" id="cantidad" value="" placeholder="Cantidad" onkeypress="return soloNumeros(event)" onkeypress="return validar(event)" maxlength="03" required>
				</div>
				<div class="col-md-2 mt-2">
					<input type="text" name="texto" maxlength="25" placeholder="Texto (OPCIONAL)">
				</div>
				<div class="col-md-3 mt-2">
					<label>Rellenos/cubiertos:</label>
					<!-- El select de rellenos se rellena con la base de datos -->
					<?php

					$sentencia = $base_de_datos->prepare("SELECT * FROM rellenos");
					$sentencia->execute();
					$rellenos = $sentencia->fetchAll(PDO::FETCH_OBJ);
					$i = 0;
					?>
					<select name="relleno">
						<option disabled>--Relleno de : --</option>
						<option value="0">Sin relleno</option>
						<?php foreach ($rellenos as $relleno) {	?>
							<option value="<?php echo $relleno->id; ?>"><?php echo $relleno->nombreRelleno; ?></option>

						<?php
						}
						?>
					</select>
				</div>
				<div class="col-md-3 mt-2">
					<label>Cant. barq:</label>
					<select name="barquillo">
						<option disabled>--Escoja una opcion: --</option>
						<option>Sin barquillos</option>
						<option>13</option>
						<option>14</option>
					</select>
				</div>
				<div class="col-md-2 mt-2">
					<input class="btn btn-success" type="submit" name="aceptar" value="Agregar">
				</div>
			</div>
		</div>

	</form>
	<hr>

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="bg-warning text-center">Cantidad</th>
					<th class="bg-warning text-center">Producto vendido</th>
					<th class="bg-warning text-center">Precio venta</th>
					<th class="bg-warning text-center">Total</th>
					<th class="bg-warning text-center">Quitar</th>
				</tr>

			</thead>
			<tbody>
				<?php foreach ($_SESSION["carrito"] as $indice => $producto) {
					$granTotal += $producto->total;
					$piezasVen += $producto->cantidad;
				?>
					<tr>
						<td class="text-center"><?php echo $producto->cantidad; ?></td>
						<td><?php echo $producto->pastel; ?></td>
						<td class="text-center"><?php echo $producto->p_menudeo; ?></td>
						<td class="text-center"><?php echo $producto->total; ?></td>
						<td class="text-center"><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<br>
	<h3>Total: $ <?php echo $granTotal; ?></h3>
	<h3>Total piezas: <?php echo $piezasVen; ?></h3>

	<hr>
	<form action="./terminarVenta.php" method="POST">
		<label class="mt-3 mb-3"><h4>Ingrese los datos de la nota: </h4></label>
		<input class="form-control" type="text" name="cliente" placeholder="Ingrese el nombre del Cliente" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
		<br>
		<input class="form-control" maxlength="13" type="text" name="rfc" placeholder="Ingrese el RFC del Cliente" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
		<br>
		<input class="form-control" type="text" name="dir" placeholder="Ingrese la Dirección del Cliente" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
		<br>
		<input class="form-control" maxlength="30" type="text" name="obs" placeholder="Observaciones" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
		<br>
		<select class="form-control" name="pago">
			<option>CONTADO</option>
			<option>CREDITO</option>
		</select>
		<!--	<br>
			<input type="date" name="" value="">-->
		<br><br>
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<input name="piezasVen" type="hidden" value="<?php echo $piezasVen; ?>">
		<button type="submit" class="btn btn-success">Terminar venta</button>
		<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
	</form>
</div>

<div class="text-center mt-3 mb-3">
<a class="btn btn-primary" onclick="myFunction()">Volver al Menú Principal</a>
</div>

<!-- <script src="../js/busquedaPasteles.js"></script> -->

<br><br>
<?php include_once "pie.php" ?>