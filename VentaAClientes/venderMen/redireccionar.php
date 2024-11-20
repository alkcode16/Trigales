<?php
session_start();

unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
unset($_SESSION["cliente"]);
$_SESSION["cliente"] = [];
header("Location: ../elegir.php");
?>
