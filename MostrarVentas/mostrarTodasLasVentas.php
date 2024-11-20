<?php

 include_once "encabezadoVentas.php" ?>
<?php
require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, ventas.nombre,  ventas.pago,ventas.rfc,ventas.direccion, GROUP_CONCAT(	pasteles.id_producto, '..',  pasteles.pastel, '..', productos_vendidos.cantidad, '..', productos_vendidos.precio, '..', productos_vendidos.subtotal SEPARATOR '__') AS pasteles FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN pasteles ON pasteles.id_producto = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>Ventas "Trigales de Oro®"</h1>
    <br>

		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número de Venta</th>
					<th>Fecha</th>
					<th>Cliente</th>
          <th>Pago</th>
					<th>Productos vendidos</th>
					<th>Total</th>
          <th>Generar Nota</th>
					<!--<th>Eliminar</th>-->
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>

					<td><?php echo $venta->nombre ?></td>
          <td><?php echo $venta->pago ?></td>
					<!--<td><?php echo $venta->rfc ?></td>
					<td><?php echo $venta->direcion ?></td>-->
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Cantidad</th>
									<th>Descripción</th>
									<th>Precio</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php
				 foreach(explode("__", $venta->pasteles) as $productosConcatenados){
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[2] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[3] ?></td>
									<td><?php echo $producto[4] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td>$ <?php echo $venta->total ?>.00</td>
					<td><a class="btn btn-success" href="<?php echo "notaGenerada.php?id=" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>

			</tbody>
		</table>
		<center><a href="../Menu2.php">Volver al Menú Principal</a></center>
		<br><br>
	</div>
<?php include_once "pie.php" ?>
