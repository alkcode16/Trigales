<?php

session_start();

unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

header("Location: ./vender.php?status=2");
header("Location: ../elegir.php");
?>
