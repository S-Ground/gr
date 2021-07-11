<?php
require "db.php";
ob_start();
//inicio de sesion 
session_start();

//inicio de sesion 
$usuario = $_SESSION['username'];
//introducir md5 antes del dato capturado para convertir en md5
$clave = md5($_POST['contraseña']);

//entregamos a travez de boton la id update que nos sirve para reconocer 
if (isset($_POST['update'])){
  //consulta sql que nos permite actualizar los datos
    $sql = ("UPDATE usuarios
    SET nombreOrg ='$_POST[nombreOrg]', clave = '$clave'
    WHERE usuario = '$usuario'");
    header("location: ../app/conf.php");
    echo $sql;
    
}  else {
    echo "No funciona";
    }
    //ejecucion en motor de sql 
    if (mysqli_query($conexion, $sql)) {
    } else {
    }
    
?>