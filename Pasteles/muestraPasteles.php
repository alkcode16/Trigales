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
  echo '<center><a href="./index.php">Iniciar sesión</a></center>';
  die();
  //require_once("../Conexion/autorizacion.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pasteles TRIGALES DE ORO</title>
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
    border-radius: 20px;
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
<script>
  function deshabilitaRetroceso() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function() {
      window.location.hash = "no-back-button";
    }
  }
</script>
<?php include("../funciones/funciones.php"); ?>
<?php
$sentencia = $base_de_datos->query("SELECT * FROM pasteles");
$pasteles = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="mt-5">
  <header>
    <h1 class="text-center">Lista de los pasteles</h1>
  </header>
</div>


<body onload="deshabilitaRetroceso()">

  <div class="container">
    <a href="../Menu2.php"><input class="btn btn-danger" type="submit" name="" value="Volver al Menú Principal"></a>
  </div>
  <br>
  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">Id Pastel</th>
            <th class="text-center">Pastel</th>
            <th class="text-center">Linea</th>
            <th class="text-center">Precio Mayoreo</th>
            <th class="text-center">Precio Medio</th>
            <th class="text-center">Precio Eventual</th>
            <th class="text-center">Precio Temporada</th>
            <th class="text-center">Precio Menudeo</th>

            <th class="warning">Editar</th>
            <th class="danger">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pasteles as $datos) { ?>
            <tr>
              <td class="text-center"><?php echo $datos->id_producto; ?></td>
              <td><?php echo utf8_decode($datos->pastel); ?></td>
              <td><?php echo $datos->linea; ?></td>
              <td class="text-center"><?php echo $datos->p_mayoreo; ?></td>
              <td class="text-center"><?php echo $datos->p_medio; ?></td>
              <td class="text-center"><?php echo $datos->p_eventual; ?></td>
              <td class="text-center"><?php echo $datos->p_temporada; ?></td>
              <td class="text-center"><?php echo $datos->p_menudeo; ?></td>

              <td class="text-center"><a class="btn btn-warning" href="<?php echo "editarPastel.php?id=" . $datos->id_producto ?>"><i class="fa fa-edit"></i></a></td>
              <td class="text-center"><a class="btn btn-danger" onclick="borrarPastel(<?php echo $datos->id_producto; ?>)"><i class="fa fa-trash"></i></a></td>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="text-center mt-5">
    <form action="../Reportes/ListaDePrecios.php" method="post">
      <input class="btn btn-primary" type="submit" value="GENERAR REPORTE">
    </form>
  </div>

  <div class="text-center mt-3 mb-3">
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
</script>

</html>