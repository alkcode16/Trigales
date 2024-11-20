<?php
error_reporting(0);
include_once "encabezado.php";
session_start();

//if(!isset($_SESSION["cliente"])) $_SESSION["cliente"] = [];

$array = $_SESSION["cliente"];
//print_r($_SESSION["cliente"]);

//echo "<br>";
$clasif = array_column($array, 'clasif');
//print_r($id);
//	echo $clasif[0];
//	echo "<br>";

if ($clasif[0] == "1") {
	$ruta = "venderMa/vender.php";
} elseif ($clasif[0] == "2") {
	$ruta = "venderMe/vender.php";
} elseif ($clasif[0] == "3") {
	$ruta = "venderEv/vender.php";
} elseif ($clasif[0] == "4") {
	$ruta = "venderTemp/vender.php";
} elseif ($clasif[0] == "5") {
	$ruta = "venderMen/vender.php";
} elseif ($clasif[0] == NULL) {
	$ruta = "./elegir.php";

?>
	<!--<script type="text/javascript">
		alert("Seleccione a un Cliente Registrado");
</script>-->

<?php
} else if ($clasif[0] == "") {
}
if (!isset($_SESSION["cliente"])) $_SESSION["cliente"] = [];


?>
<style>
	.sku {
		background: #F45671;
	}
</style>

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
	<h1>Elegir Cliente "Trigales de Oro"</h1>
	<?php
	if (isset($_GET["status"])) {
		if ($_GET["status"] === "1") {
	?>
			<div class="alert alert-danger">
				<strong>Cliente No Encontrado</strong>
			</div>
		<?php
		} else {
		?>
			<div class="alert alert-success">
				<strong>Cliente Encontrado</strong>
			</div>
	<?php
		}
	}
	?>

	<div class="row mt-5">
		<form method="post" action="buscarCliente.php">
			<div class="col-md-12 mb-3">
				<label for="codigo">Ingrese el Nombre del Cliente:</label>
			</div>
			<div class="col-md-12 mb-3">
				<input autocomplete="on" autofocus class="form-control" name="nombre" required type="text" id="codigo" placeholder="Escribe el Nombre" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
			</div>
			<div class="col-md-12 mb-5">
				<input class="btn btn-primary" type="submit" name="aceptar" value="Buscar Cliente">
			</div>
		</form>
	</div>

	<div class="table-responsive mb-3">
		<table class="table table-bordered">
			<thead class="bg-warning text-center">
				<tr>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>RFC</th>
					<th>DIRECCIÓN</th>
					<th>OBSERVACIONES</th>
					<th>CLASIFICACION</th>
					<th>RUTA</th>
					<th>TIPO DE PAGO</th>
				</tr>

			</thead>
			<tbody>
				<?php foreach ($_SESSION["cliente"] as $cliente) {
					//$granTotal += $producto->total;
				?>
					<tr>
						<td><?php echo $cliente->id_nombre; ?></td>
						<td><?php echo $cliente->nombre; ?></td>
						<td><?php echo $cliente->rfc; ?></td>
						<td><?php echo $cliente->dir; ?></td>
						<td><?php echo $cliente->obs; ?></td>
						<td><?php echo $cliente->clasif; ?></td>
						<td><?php echo $cliente->ruta; ?></td>
						<td><?php echo $cliente->tipo_pago; ?></td>
						<!--<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>-->
					</tr>
				<?php }

				?>

			</tbody>
		</table>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<form action=<?php echo $ruta; ?> method="POST">
				<input class="btn btn-success" type="submit" name="" value="Aceptar">
			</form>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-md-12 text-center">
			<a class="btn btn-danger" onclick="myFunctionClientes()">Volver al Menú Principal</a>
			<!-- <center><a onclick="myFunctionClientes()"><input class="btn btn-info" type="submit" name="" value="Volver al Menú Principal"></a></center> -->
		</div>
	</div>

</div>
<script src="../js/busquedaClientes.js"></script>

<br><br>
<?php include_once "pie.php";  ?>