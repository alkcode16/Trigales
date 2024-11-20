<?php

include_once "encabezado.php" ?>
<?php

require("../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT * FROM pasteles");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
					<th class="sku">CODIGO</th>
					<th>PASTEL</th>
					<th>LINEA</th>
					<th>PRECIO DE MAYOREO</th>
					<th>PRECIO MEDIO</th>
					<th>PRECIO EVENTUAL</th>
					<th>PRECIO DE MENUDEO</th>
				<!--	<th>Editar</th>
					<th>Eliminar</th>-->
				</tr>
			</thead>
			<tbody>
				<?php foreach($productos as $producto){ ?>
				<tr>
					<td class="sku"><?php echo $producto->id_producto ?></td>
					<td><?php echo $producto->pastel?></td>
					<td><?php echo $producto->linea?></td>
					<td><?php echo $producto->p_mayoreo?></td>
					<td><?php echo $producto->p_medio ?></td>
					<td><?php echo $producto->p_eventual ?></td>
					<td><?php echo $producto->p_menudeo?></td>
					<!--<td><a class="btn btn-warning" href="<?php //echo "editar.php?id=" . $producto->Sku?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php //echo "eliminar.php?id=" . $producto->Sku?>"><i class="fa fa-trash"></i></a></td>-->
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br><br>
		<center><a href="../Menu2.php">Volver al Menú Principal</a></center>
		<br><br>
<?php include_once "pie.php" ?>
