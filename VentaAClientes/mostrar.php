<?php include_once "encabezado2.php" ?>
<?php
//parte donde enseña los productos
require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT * FROM clientes");
$clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<style>
		.sku{
			background:  #F45671;
		}
</style>
	<div class="col-xs-12">
		<h1>Productos "Trigales de Oro"</h1>
		<!--<div>
			<a class="btn btn-success" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>-->
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="sku">ID</th>
					<th>CLIENTE</th>
					<th>RFC</th>
					<th>DIRECCIÓN</th>
					<th>OBSERVACIONES</th>
					<th>CLASIFICACION</th>
					<th>RUTA</th>
					<th>TIPO DE PAGO</th>
				<!--	<th>Editar</th>
					<th>Eliminar</th>-->
				</tr>
			</thead>
			<tbody>
				<?php foreach($clientes as $cliente){ ?>
				<tr>
					<td class="sku"><?php echo $cliente->id_nombre ?></td>
					<td><?php echo $cliente->nombre?></td>
					<td><?php echo $cliente->rfc?></td>
					<td><?php echo $cliente->dir?></td>
					<td><?php echo $cliente->obs ?></td>
					<td><?php echo $cliente->clasif ?></td>
					<td><?php echo $cliente->ruta ?></td>
					<td><?php echo $cliente->tipo_pago?></td>
					<!--<td><a class="btn btn-warning" href="<?php //echo "editar.php?id=" . $producto->Sku?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php //echo "eliminar.php?id=" . $producto->Sku?>"><i class="fa fa-trash"></i></a></td>-->
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br><br>
	<center><a onclick="myFunction()"><input class="btn btn-info" type="submit" name="" value="Volver al Menú Principal"></a></center>
		<br><br>
<?php include_once "pie.php" ?>
