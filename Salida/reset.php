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
      <title>Salida TRIGALES DE ORO</title>
      <link rel="icon" type="image/png" href="../logo 2016.png">
      <link rel="stylesheet" href="../css/fontawesome-all.min.css">
      <link rel="stylesheet" href="../css/2.css">
      <link rel="stylesheet" href="../css/estilo.css">
    </head>
  <style>
      body{
       background: #0fc712;
      }

      .preg{
        background: yellow;
      }

      .btn{
        padding: 20px 150px;
        size:50px;
        font-size: 30px;
        border-radius: 24px;
        background: #FBBC35;
      }
  </style>

  <div class="preg">
    <center><h1>¿ESTA SEGURO(A) DE QUE QUIERE TERMINAR EL DIA?</h1></center>
    <center><h4>(SI LE DA "SÍ" SE REINICIARAN VALORES A 0 PARA PODER HACER LAS VENTAS DE NUEVO)</h4></center>
  </div>

  <br><br><br><br><br><br><br>

<center><div class="">
    <form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input class="btn" type="submit" name="si" value="SÍ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn" type="submit" name="no" value="NO">
    </form>

</div></center>

    </body>
  </html>

<?php
if (isset($_POST['si'])) {
  require_once("../Conexion/conexion.php");
  $conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);
  $query ="UPDATE pastelesstock SET stockRuta1=0, stockRuta2=0";
  $resultado = mysqli_query($conexion, $query);
  if ($resultado) {
?>
    <script type="text/javascript">
      alert("Se actualizaron correctamente los datos");
    </script>;
<?php

  }else {
?>
      <script type="text/javascript">alert("Error al reiniciar los valores");</script>;
<?php
  }
header("Location: ./salida.php");

}elseif (isset($_POST['no'])) {
    header("Location: ./salida.php");
}


 ?>
