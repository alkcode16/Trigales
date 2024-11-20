<?php

include_once "encabezado.php" ?>
<?php
require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, ventas.nombre,  ventas.pago,ventas.rfc,ventas.direccion, GROUP_CONCAT(	pasteles.id_producto, '..',  pasteles.pastel, '..', productos_vendidos.cantidad, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC LIMIT 20");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
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

<div class="mt-5">
	<h1>Ventas Trigales de Oro®</h1>
	<div class="table-response mt-3 mb-3">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="bg-success text-center text-white">No. Venta</th>
					<th class="bg-success text-center text-white">Fecha</th>
					<th class="bg-success text-center text-white">Cliente</th>
					<th class="bg-success text-center text-white">Pago</th>
					<th class="bg-success text-center text-white">Productos vendidos</th>
					<th class="bg-success text-center text-white">Total</th>
					<!--<th>Eliminar</th>-->
				</tr>
			</thead>
			<tbody>
				<?php foreach ($ventas as $venta) { ?>
					<tr>
						<td class="text-center"><?php echo $venta->id ?></td>
						<td class="text-center"><?php echo $venta->fecha ?></td>

						<td class="text-center"><?php echo $venta->nombre ?></td>
						<td class="text-center"><?php echo $venta->pago ?></td>
						<!--<td><?php echo $venta->rfc ?></td>
					<td><?php echo $venta->direcion ?></td>-->
						<td>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="bg-warning text-center">Código</th>
										<th class="bg-warning text-center">Cantidad</th>
										<th class="bg-warning text-center">Descripción</th>
										<th class="bg-warning text-center">Precio</th>
										<th class="bg-warning text-center">Subtotal</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach (explode("__", $venta->pasteles) as $productosConcatenados) {
										$producto = explode("..", $productosConcatenados)
									?>
										<tr>
											<td class="text-center"><?php echo $producto[0] ?></td>
											<td class="text-center"><?php echo $producto[2] ?></td>
											<td><?php echo $producto[1] ?></td>
											<td class="text-center"><?php echo $producto[3] ?></td>
											<td class="text-center"><?php echo $producto[4] ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
						<td class="text-center">$ <?php echo $venta->total ?>.00</td>
						<!--<td><a class="btn btn-danger" href="<?php //echo "eliminarVenta.php?id=" . $venta->id
																?>"><i class="fa fa-trash"></i></a></td>-->
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<div class="text-center mt-3 mb-3">
		<a class="btn btn-primary" href="../Menu2.php">Volver al Menú Principal</a>
	</div>

</div>
<?php include_once "pie.php" ?>