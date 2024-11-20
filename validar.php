<?php
session_start();
require_once("Conexion/conexion.php");
    $usuario=addslashes($_POST['user']);
    $clave=addslashes($_POST['passw']);


        $consulta="SELECT * FROM users WHERE usuario='$usuario' AND contrasena='$clave'";
        $resultado=mysqli_query($conexion,$consulta);
        $filas=mysqli_num_rows($resultado);

      $_SESSION['user']=$usuario;

      if($usuario==null){
      /*  echo '<br>';
        echo '<br>';
        echo '<center> Usted no tiene autorización </center>';
        echo '<br>';
        echo '<br>';
        echo '<center> Inicie sesión de forma correcta </center>';
        echo '<br>';
        echo '<br>';
        echo '<center><a href="http://localhost/php/Trigales/Login/login.php">Iniciar sesión</a></center>';
        die();*/
        require_once("../Conexion/autorizacion.php");

      }else {
          if($filas>0){
            echo "bienvenido";
            header("Location:./Menu2.php");

          }else{
            echo "<br><br><center>Error al introducir los datos</center> <br><br>";
            echo "<center>El usuario $usuario o la contraseña son incorrectos</center>";
            echo '<br><br><center><a href="./index.php">Vuelva a internarlo</a></center>';
          }
          mysqli_free_result($resultado);
          mysqli_close($conexion);
   }
?>
