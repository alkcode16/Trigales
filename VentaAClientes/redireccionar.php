<?php
session_start();

unset($_SESSION["cliente"]);
$_SESSION["cliente"] = [];
header("Location: ../Menu2.php");
?>
