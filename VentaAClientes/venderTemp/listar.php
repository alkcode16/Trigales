<?php include_once "encabezado.php" ?>
<?php
//parte donde enseña los productos
//include_once "../base_de_datos.php";
require("../../Conexion/base_de_datos.php");
$sentencia = $base_de_datos->query("SELECT id_producto,pastel,linea,p_temporada FROM pasteles");
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

				</tr>
			</thead>
			<tbody>
				<?php foreach($productos as $producto){ ?>
				<tr>
					<td class="sku"><?php echo $producto->id_producto ?></td>
					<td><?php echo $producto->pastel?></td>
					<td><?php echo $producto->linea?></td>
					<td><?php echo $producto->p_temporada?></td>

					<!--<td><a class="btn btn-warning" href="<?php //echo "editar.php?id=" . $producto->Sku?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php //echo "eliminar.php?id=" . $producto->Sku?>"><i class="fa fa-trash"></i></a></td>-->
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br><br>
		<br><br>
<?php include_once "../pie.php" ?>
