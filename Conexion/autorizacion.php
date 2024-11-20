<?php
if($_SESSION['user']==null || $_SESSION['user']==''){
      echo '<br>';
      echo '<br>';
      echo '<center> Usted no tiene autorización </center>';
      echo '<br>';
      echo '<br>';
      echo '<center> Inicie sesión de forma correcta </center>';
      echo '<br>';
      echo '<br>';
      echo '<center><a href="../Login/login.php">Iniciar sesión</a></center>';
      die();
}

 ?>
