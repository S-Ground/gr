<?php
//inicio conexion a base de datos
require 'db.php';
session_start();
//definicion de variables para login
$usuario=$_POST['usuario'];
$clave=md5($_POST['clave']);
//consulta a la base de datos
$q="SELECT   COUNT(*) as contar from usuarios WHERE usuario='$usuario'and clave='$clave'";
$consulta=mysqli_query($conexion,$q);
$array=mysqli_fetch_array($consulta);
if($array['contar']>0){
    //seesion de usuario
    $_SESSION['username']=$usuario;
    //dirige hacia pagina principal de usuario
    header("location: ../app/index.php");
}else{
    //vuelve a slicitar inicio de sesion 
    header("location: ../controlador/login.php?error=true");
}
?>