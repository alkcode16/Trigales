<?php
//require_once("../Conexion/autorizacion.php");
session_start();
error_reporting(0);
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
  <title>Salida TRIGALES DE ORO</title>
  <link rel="icon" type="image/png" href="../logo 2016.png">
  <!-- <link rel="stylesheet" href="../css/fontawesome-all.min.css">
     <link rel="stylesheet" href="../css/2.css">
     <link rel="stylesheet" href="../css/estilo.css"> -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<style>
  body {
    background: #0fc712;
  }

  h1 {
    background: yellow;
    border-radius: 25px;
  }

  table {
    background: white;
  }

  thead {
    background: #0097FF;

  }

  .ruta1 {
    background: #FFD500;
  }

  .ruta2 {
    background: #D55DFC;
  }

  a {
    color: black;
    font-size: 20px;
    text-decoration: none;
  }
</style>
<script>
  function deshabilitaRetroceso() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function() {
      window.location.hash = "no-back-button";
    }
  }
</script>

<?php

$sentencia = $base_de_datos->query("SELECT * FROM pastelesstock");
$salida = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia2 = $base_de_datos->query("SELECT SUM(stockRuta1) as total FROM pastelesstock");
$salida2 = $sentencia2->fetchAll(PDO::FETCH_OBJ);

$sentencia3 = $base_de_datos->query("SELECT SUM(stockRuta2) as total2 FROM pastelesstock");
$salida3 = $sentencia3->fetchAll(PDO::FETCH_OBJ);

?>
<div class="mt-5">
  <header>
    <h1 class="text-center">Salida de Pasteles Trigales de Oro®</h1>
  </header>
</div>

<br>
<div class="container">

  <body onload="deshabilitaRetroceso()">
    <div class="opciones">
      <div class="row">
        <div class="col-md-4">
          <a href="../Menu2.php"><input class="btn btn-danger" type="submit" name="" value="Volver al Menú Principal"></a>
        </div>
        <div class="col-md-4 text-center">
          <a href="./salidaReporte.php"><input class="btn btn-warning" type="submit" name="" value="GENERAR REPORTE"></a>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>


    <div class="table-response mt-3">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">Id Pastel</th>
            <th class="text-center">Pastel</th>
            <th class="text-center">Ruta 1</th>
            <th class="text-center">Ruta 2</th>
            <th class="text-center">Total de Pastel</th>

            <!--<th>Eliminar</th>-->
          </tr>
        </thead>
        <tbody>
          <?php foreach ($salida as $datos) { ?>
            <tr>
              <td class="text-center"><?php echo $datos->id_producto ?></td>
              <td><?php echo $datos->pastel ?></td>
              <?php
              if ($datos->stockRuta1 == 0) {
                $datos->stockRuta1 = "-";
              }
              if ($datos->stockRuta2 == 0) {
                $datos->stockRuta2 = "-";
              }
              ?>

              <td class="text-center ruta1">
                <?php echo $datos->stockRuta1 ?>
              </td>
              <td class="text-center ruta2">
                <?php echo $datos->stockRuta2 ?>
              </td>
              <td class="text-center">
                <?php echo $datos->stockRuta1 + $datos->stockRuta2 ?>
              </td>
            <?php } ?>

        </tbody>
        <td>

        </td>
        <td class="text-end">
          Total de pasteles por ruta
        </td>
        <!--Aqui imprimimos la cantidad de pasteles de la ruta 1-->
        <?php foreach ($salida2 as $datos2) { ?>
          <td class="text-center">
            <?php echo $datos2->total ?>
          </td>
        <?php } ?>
        <!--Aqui imprimimos la cantidad de pasteles de la ruta 2-->
        <?php foreach ($salida3 as $datos3) { ?>
          <td class="text-center">
            <?php echo $datos3->total2 ?>
          </td>
          <td class="text-center">
            <?php echo $datos2->total + $datos3->total2 ?>
          </td>
        <?php } ?>
      </table>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
        <form action="reset.php" method="post">
          <input class="btn btn-danger" type="submit" name="" value="Terminar dia">
        </form>
      </div>
      <div class="col-md-4"></div>

    </div>

    <br><br>

    <div class="row mb-5">
    <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
      <form action="salidaReporte.php" method="post">
        <input class="btn btn-warning" type="submit" name="" value="GENERAR REPORTE">
      </form>
      </div>
      <div class="col-md-4"></div>
    
    </div>
</div>

<!-- <div class="text-center mt-3">
  <a class="btn btn-primary" href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a>
</div>
<br><br> -->


</body>

</html>