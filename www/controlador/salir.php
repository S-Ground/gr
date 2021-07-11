<?php
//Cerrar sesion 
session_start();
session_destroy();
header("location:login.php");
?>

