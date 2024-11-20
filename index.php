<?php
session_start();
session_destroy();
    require_once("Conexion/conexion.php");
    if (!$conexion) {
?>
          <script type="text/javascript">
          alert("Error al realizar la conexion");
          </script>';
<?php
          exit();
      }else{
?>
          <script type="text/javascript">
          alert("¡Bienvenido!");
          </script>

<?php
      }

?>


<DOCTIPE html>
<html lang="es">
 <head>
    <meta charset="UTF-8">
    <br><br>
     <title>TRIGALES DE ORO</title>
     <link rel="icon" type="image/png" href="logo 2016.png">
     <script>
     function myFunction() {
       var x = document.getElementById("passw");
       if (x.type === "password") {
         x.type = "text";
       } else {
         x.type = "password";
       }
     }
     </script>


    <link rel="stylesheet" href="estilo_registro.css">
  </head>
    <body>
    <h1>Trigales de Oro ®</h1>
        <form action="validar.php" method="post" class="form-register">
        <h2 class="form-titulo">INICIO DE SESIÓN</h2>
        <div class="contenedor-inputs">
            <input type="text" maxlength="50" name="user" placeholder="INGRESE EL NOMBRE DE USUARIO" class=input-100 required >
          <input type="password" maxlength="100" name="passw" id="passw" placeholder="CONTRASEÑA" class=input-100 required>
          <input type="checkbox" onclick="myFunction()">MOSTRAR CONTRASEÑA
          <br>
          <input type="submit" name = "enviar" value="INICIAR SESIÓN" class="btn-registrar" required>



         </div>
         <br>
         <br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        &nbsp&nbsp
         <!--<a href="">REGISTRAR USUARIO NUEVO</a>  <br>-->
         <br>
        </form>
     </body>
</html>
