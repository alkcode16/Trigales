<?php
//require_once("../Conexion/autorizacion.php");
session_start();
require_once("../Conexion/base_de_datos.php");

if ($_SESSION['user'] == null || $_SESSION['user'] == '') {
  echo '<br>';
  echo '<br>';
  echo '<center> Usted no tiene autorización </center>';
  echo '<br>';
  echo '<br>';
  echo '<center> Inicie sesión de forma correcta </center>';
  echo '<br>';
  echo '<br>';
  echo '<center><a href="../index.php">Iniciar sesión</a></center>';
  die();
  //require_once("../Conexion/autorizacion.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Clientes TRIGALES DE ORO</title>
  <link rel="icon" type="image/png" href="../logo 2016.png">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
  body {
    background: #0fc712;
  }

  h1 {
    background: yellow;
    border-radius: 15px;
  }

  table {
    background: white;
  }

  thead {
    background: #0097FF;

  }

  a {
    color: black;
    font-size: 20px;
    text-decoration: none;
  }
</style>

<?php include("../funciones/funciones.php"); ?>

<?php
$sentencia = $base_de_datos->query("SELECT * FROM clientes");
$clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="mt-5">
  <header>
    <h1 class="text-center">Lista de los clientes</h1>
  </header>
</div>


<body onload="deshabilitarRetroceso()">
  <div class="container">
    <a href="../Menu2.php"><input class="btn btn-danger" type="submit" name="" value="Volver al Menú Principal"></a>
    <br><br>


    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="text-center">
            <tr>
              <th>No. de Cliente</th>
              <th>Nombre</th>
              <th>RFC</th>
              <th>Dirección</th>
              <th>Observaciones</th>
              <th>Clasificación</th>
              <th>Ruta</th>
              <th>Tipo de Pago</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($clientes as $datos) { ?>
              <tr>
                <td class="text-center"><?php echo $i ?></td>
                <td><?php echo $datos->nombre ?></td>
                <td><?php echo $datos->rfc ?></td>
                <td><?php echo $datos->dir ?></td>
                <td><?php echo $datos->obs ?></td>
                <td class="text-center"><?php echo $datos->clasif ?></td>
                <td class="text-center"><?php echo $datos->ruta ?></td>
                <td class="text-center"><?php echo $datos->tipo_pago ?></td>
                <td class="text-center"><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $datos->id_nombre ?>"><i class="fa fa-edit"></i></a></td>
                <td class="text-center"><a class="btn btn-danger" onclick="borrarClientes(<?php echo $datos->id_nombre; ?>)"><i class="fa fa-trash"></i></a></td>

              <?php
              $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="mt-5 text-center">
    <form action="../Reportes/ListaClientes.php" method="post">
      <input class="btn btn-primary" type="submit" name="" value="GENERAR REPORTE">
    </form>
  </div>

  <div class="text-center mt-3">
    <a href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a>
  </div>

</body>
<script src="js/bootstrap.min.js"></script>
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

  function deshabilitarRetroceso() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function() {
      window.location.hash = "no-back-button";
    }
  }

  function alerta() {
    var mensaje;
    var opcion = confirm("Clicka en Aceptar o Cancelar");
    if (opcion == true) {
      mensaje = "Has clickado OK";
    } else {
      mensaje = "Has clickado Cancelar";
    }
    document.getElementById("ejemplo").innerHTML = mensaje;
  }
</script>


</html>