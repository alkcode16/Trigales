<?php
include_once "encabezadoVentas.php";
//session_start();
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
$piezasVen=0;
$array=$_SESSION["cliente"];
$nombre=array_column($array,'nombre');
?>
<script type="text/javascript">

window.onload = function Salida(){
  setTimeout('ejecutar()',hora());

}

function hora(){
    horaActual=new Date();
    horaProgramada=new Date();
    horaProgramada.setHours(23);
    horaProgramada.setMinutes(55);
    horaProgramada.setSeconds(0);
    return horaProgramada.getTime() - horaActual.getTime();

}

function ejecutar(){
  hora();
  if (hora()==0) {
    window.location=("../../Salida/salidaReporte.php");
    //alert('que pedo prro');
  }else {

  }
}
</script>

	<div class="col-xs-12">
		<h1>Cliente: <??><?php echo $nombre[0]; ?><?php  ?></h1>
		Bienvenido "<?php echo  $_SESSION['user']; ?>"
		<br>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok!</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
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
			<label for="codigo">Ingrese el Nombre del Pastel:</label>

		<input autocomplete="on" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el Nombre de Producto" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
			<br><input type="text" name="cantidad" value="" placeholder="Cantidad" onkeypress="return soloNumeros(event)" maxlength="03" required>
			<input type="text" name="texto" maxlength="25" placeholder="Texto (OPCIONAL)">
			<!-- El select de rellenos se rellena con la base de datos -->
			<?php
		require("../../Conexion/base_de_datos.php");
		$sentencia = $base_de_datos->prepare("SELECT * FROM rellenos");
		$sentencia->execute();
		$rellenos = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
      <select name="barquillo">
					<option disabled>--Barquillos sobre producto : --</option>
          <option >Sin barquillos</option>
					<option >13</option>
					<option >14</option>
					<option >Cubierta extra</option>
			</select>

			<input class="btn btn-info" type="submit" name="aceptar" value="Agregar">
		</form>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Cantidad</th>
					<th>Producto</th>
					<th>Precio de venta</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>

			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){
						$granTotal += $producto->total;
						$piezasVen+=$producto->cantidad;
					?>
				<tr>
					<td><?php echo $producto->cantidad; ?></td>
				  <td><?php echo $producto->pastel;?></td>

					<td><?php	echo $producto->p_mayoreo;?></td>


					<td><?php echo $producto->total; ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
<br>
<?php
/*
$array=$_SESSION["cliente"];
print_r($_SESSION["cliente"]);

echo "<br>";
$id=array_column($array,'id_nombre');
//print_r($id);
echo $id[0];
echo "<br>";
$nombre=array_column($array,'nombre');
//print_r($nombre);
echo $nombre[0];
echo "<br>";
$rfc=array_column($array,'rfc');
//print_r($rfc);
$rfc[0];
echo "<br>";
$dir=array_column($array,'dir');
//print_r($dir);
echo $dir[0];
echo "<br>";
$obs=array_column($array,'obs');
//print_r($obs);
echo $obs[0];
$direccion=$dir[0]." ".$obs[0];
echo $direccion;
echo "<br>";
$clasif=array_column($array,'clasif');
//print_r($clasif);
echo $clasif[0];
echo "<br>";
$tipo_pago=array_column($array,'tipo_pago');
//print_r($tipo_pago);
echo $tipo_pago[0];*/
 ?>
		<h3>Total: $ <?php echo $granTotal; ?></h3>
		<h3>Total piezas: <?php echo $piezasVen; ?></h3>

		<form action="./terminarVenta.php" method="POST">

			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<input name="piezasVen" type="hidden" value="<?php echo $piezasVen;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
		<br>
	</div>
	<br><br><br><br>
	<!--<center><a href="../Menu2.php">Volver al Menú Principal</a></center>-->
	<br><br>
<?php include_once "../pie.php" ?>
