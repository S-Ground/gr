<?php
//actualizador (funciona para agregar datos y testear la aplicacion)
//introducir datos a las tablas, para hacer testing de funcionamiento. (software in the loop)
require 'db.php';

    $temperatura = rand(-5,20);
    $humedad = rand(0,100);
    $date = date('y/m/d h:i:s', time());
    $ph =rand(0,14);
    $presion = rand(100,1200);
    $uv =rand(1,11);
    $insertar = "INSERT INTO datos (fecha, temperatura, humedad, ph, presion, uv) VALUES ('$date','$temperatura','$humedad','$ph','$presion','$uv') ";
    $resultado = mysqli_query($conexion,$insertar);
    if (!$resultado){
        echo 'Error al registrar';
    }else{
        echo 'Usuario resgistrado';
    }
    mysqli_close($conexion);
?>