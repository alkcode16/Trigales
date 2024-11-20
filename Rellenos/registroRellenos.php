<?php
session_start();

if($_SESSION['user']==null || $_SESSION['user']==''){
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



<html lang="es">
 <head>
    <meta charset="UTF-8">
     <title>TRIGALES DE ORO</title>

     <?php include("../funciones/funciones.php"); ?>


     <link rel="stylesheet" href="estilo_registro.css">
     <link rel="icon" type="image/png" href="../logo 2016.png">
  </head>

    <body>
      <br>
    <h1>Registrar Relleno</h1>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Conectado: <?php echo ' "'. $_SESSION['user'].'"'; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-register">
        <h2 class="form-titulo">Registre algun relleno</h2>


        <div class="contenedor-inputs">
            <input type="text" maxlength="100" name="relleno" placeholder="NOMBRE DEL RELLENO" class=input-100 required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"><br><br>

            <input type="text" maxlength="50" name="precio" onkeypress="return soloNumeros(event)" onpaste="return false" placeholder="PRECIO" class=input-100 required>

        <input type="submit" name="enviar" style="margin: 40px" value="REGISTRAR" class="btn-terminar" required>

         </div>
        </form>
        <br>
        <br>

    </body>
    <center>  <a href="../Menu2.php">VOLVER AL MENÚ PRINCIPAL</a>  </center>
</html>

<?php
     require_once("../Conexion/base_de_datos.php");

     if(isset($_POST['enviar'])){
        $relleno=addslashes($_POST['relleno']);
        $precio=addslashes($_POST['precio']);
    

     try {
        $sql="INSERT INTO rellenos(nombreRelleno,precio) VALUES (:rell, :pre)";
        $resultado=$base_de_datos->prepare($sql);
        $resultado->execute(array(':rell'=>$relleno, ':pre'=>$precio));
        echo '<script> alert("Se insertaron correctamente los datos");</script>';
        $resultado->closeCursor();
  } catch (Exception $e) {
        echo "Linea del error".$e->getLine();
  }finally{
    $base_de_datos=null;
  }
}
?>