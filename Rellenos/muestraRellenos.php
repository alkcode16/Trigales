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
  <title>Rellenos TRIGALES DE ORO</title>
  <link rel="icon" type="image/png" href="../logo 2016.png">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<script type="text/javascript">
  function deshabilitarRetroceso() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function() {
      window.location.hash = "no-back-button";
    }
  }
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
$sentencia = $base_de_datos->query("SELECT * FROM rellenos");
$rellenos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="mt-5">
  <header>
    <h1 class="text-center">Lista de rellenos</h1>
  </header>
</div>
<body onload="deshabilitarRetroceso()">
  <div class="container">
    <a href="../Menu2.php"><input class="btn btn-danger" type="submit" name="" value="Volver al Menú Principal"></a>
    <br><br>
  </div>

  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Relleno</th>
          <th>Precio</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($rellenos as $datos) { ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $datos->nombreRelleno ?></td>
            <td><?php echo $datos->precio ?></td>
            <td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $datos->id ?>"><i class="fa fa-trash"></i></a></td>
          <?php
          $i++;
        }   ?>
      </tbody>
    </table>
  </div>

  <br><br>
  <div>
    <center><a href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a> </center>
  </div>
  <br><br>


</body>

</html>