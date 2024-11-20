<?php
    //require_once("../Conexion/autorizacion.php");
    session_start();
     require_once("../Conexion/base_de_datos.php");

        if($_SESSION['user']==null || $_SESSION['user']==''){
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
    <title>Detalle De Registro TRIGALES DE ORO</title>
    <link rel="icon" type="image/png" href="../logo 2016.png">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/2.css">
    <link rel="stylesheet" href="../css/estilo.css">
  </head>
<style>
body{
 background: #0fc712;
}
h1{
  background: yellow;
  border-radius: 20px;

}
table{
  background: white;
}
thead{
  background: #0097FF;

}

a{
  color: black;
  font-size: 20px;
  text-decoration: none;
}

</style>

<?php
$sentencia = $base_de_datos->query("SELECT * FROM detallepasteles");
$detalle= $sentencia->fetchAll(PDO::FETCH_OBJ);
 ?>
<center><div class="container">
  <h1>Detalle De Registro De Productos Trigales de Oro®</h1>
</div></center>
<br>

<div class="container">

  <body>
    <table class="table table-bordered">
      <thead>
        <tr>

          <th>Pastel</th>
          <th>Linea</th>
          <th>Precio Mayoreo</th>
          <th>Precio Medio</th>
          <th>Precio Eventual</th>
          <th>Precio Menudeo</th>
          <th>Fecha de Registro</th>

          <!--<th>Eliminar</th>-->
        </tr>
      </thead>
      <tbody>
        <?php foreach($detalle as $datos){ ?>
        <tr>

          <td><?php echo $datos->nombre ?></td>
          <td><?php echo $datos->linea ?></td>
          <td><?php echo $datos->may ?></td>
          <td><?php echo $datos->med ?></td>
          <td><?php echo $datos->even ?></td>
          <td><?php echo $datos->men ?></td>
          <td><?php echo $datos->fechaReg ?></td>

  <?php } ?>
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
    window.location=("../Salida/salidaReporte.php");
    //alert('que pedo prro');
  }else {

  }
}
</script>
